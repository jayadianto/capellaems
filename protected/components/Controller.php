<?php
class Controller extends CController
{
	public $layout='//layouts/column1';
	public $menu=array();
	public $breadcrumbs=array();
	protected $iswrite = 'iswrite';
	protected $isread = 'isread';
	protected $ispost = 'ispost';
	protected $isreject = 'isreject';
	protected $isupload = 'isupload';
	protected $isdownload = 'isdownload';
	protected $ispurge = 'ispurge';
	protected $txt = '_help';
	protected $lockedby = "";
	protected $lockeddate = "";
	protected $messages = '';
	protected $connection;
	protected $pdf;
	protected $wfprint = '';
	protected $menuname = '';
	protected $folder = '';
	protected $filename = '';

	public function ValidateData($datavalidate)
	{
		$messages = '';
		for ($row = 0; $row <  count($datavalidate); $row++)
		{
			if ($datavalidate[$row][2] == 'emptystring') {
				if ($datavalidate[$row][0] == '')
				{
					$message = Catalogsys::model()->findbysql("select a.*
		from catalogsys a
		inner join language c on c.languageid = a.languageid 
		inner join useraccess d on d.languageid = c.languageid 
		where lower(a.catalogname) = lower('". $datavalidate[$row][1]."') and d.username = '". Yii::app()->user->id . "'");
					if ($message != null) {
						$messages = $message->catalogval;
					} else {
						$messages = $datavalidate[$row][1];
					}
				}
			}
			if ($messages !== '') {
				$this->GetMessage('failure',$messages);
			}
		}
	}
	
	public function GetMessage($status='success',$catalogname='')
	{
		if (Yii::app()->request->isAjaxRequest)
		{
			echo CJSON::encode(array(
							'status'=>$status,
							'div'=> Catalogsys::model()->getcatalog($catalogname)
							));
					Yii::app()->end();
		}	
	}
	
	protected function CheckDataLock($menuname,$idvalue)
	{
		if((Yii::app()->user->id == null) || (Yii::app()->user->id == 'Guest'))
		{
			$this->redirect(array('/admin/login'));
		} else
		{
			$connection=Yii::app()->db;
			$baccess = false;
			$sql = "select lockedby,lockeddate ".
				"from translock ".
				"where upper(menuname) = upper('".$menuname."') and tableid = ".$idvalue." and upper(lockedby) <> upper('".Yii::app()->user->name."')";
			$command=$connection->createCommand($sql);
			$dataReader=$command->queryAll();
			foreach($dataReader as $row)
			{
				$this->lockedby = $row['lockedby'];
				if (($this->lockedby != null) || ($lockedby != ""))
				{
					$baccess = true;
					$this->lockeddate = $row['lockeddate'];
				}
			}
			if ($baccess == true)
			{
				$this->GetMessage('datalock',$this->lockedby);
			} else
			{
				$baccess = false;
			}
			return $baccess;
		}
	}

	protected function InsertLock($menuname,$idvalue)
	{
		$connection=Yii::app()->db;
		$sql = "insert into translock (menuname,tableid,lockedby) ".
				"values ('".$menuname."',".$idvalue.",'".Yii::app()->user->name."')";
		$command=$connection->createCommand($sql);
		$command->execute();
	}

	protected function DeleteLock($menuname,$idvalue)
	{
		if ((int)$idvalue > 0)
		{
			$connection=Yii::app()->db;
			$sql = "delete from translock where upper(menuname) = '".$menuname.
				"' and tableid = ".$idvalue;
			$command=$connection->createCommand($sql);
			$command->execute();
		}
	}

	protected function DeleteLockCloseForm($menuname,$postvalue,$idvalue)
	{
		if(isset($postvalue))
		{
			if ((int)$idvalue > 0)
			{
				$this->DeleteLock($menuname, $idvalue);
			}
		}
		echo CJSON::encode(array(
				'status'=>'success',
				));
		Yii::app()->end();
	}
	
	protected function CheckAccess($menuname,$menuaction)
	{
	  $baccess=false;
		$connection=Yii::app()->db;
		$sql = "select ".$menuaction.
		" from useraccess a ".
		" inner join usergroup b on b.useraccessid = a.useraccessid ".
		" inner join groupmenu c on c.groupaccessid = b.groupaccessid ".
		" inner join menuaccess d on d.menuaccessid = c.menuaccessid ".
		" where lower(username) = '".Yii::app()->user->id."' and lower(menuname) = '".$menuname."' limit 1";
		$command=$connection->createCommand($sql);
		$dataReader=$command->queryAll();
		$access=0;
		foreach($dataReader as $row) {
			if ($access < (int) $row[$menuaction]) {
				$access = (int)$row[$menuaction];
			}
		}
		if ($access == 0) {
		$baccess = false;
				$this->GetMessage('success','youarenotauthorized');
		} else {
		$baccess = true;
		}
		return $baccess;
	}
		
	public function actionIndex()
	{
	  if ($this->CheckAccess($this->menuname, $this->isread) == false) {
			$this->redirect(array('/admin/login'));
	  }
	  else
	  {
			$user = Useraccess::model()->findbyattributes(array('username'=>Yii::app()->user->id));
		  if ($user !== null)
		  {
				Yii::app()->theme = $user->theme->themename;
		  }
			require_once("pdf.php");
			$this->connection=Yii::app()->db;    
			$this->pdf = new PDF();
	  }
	}
	public function actionCreate()
	{
	  if ($this->CheckAccess($this->menuname, $this->iswrite) == false) {
			$this->redirect(array('/admin/login'));
	  }
	}

	public function actionUpdate()
	{
	  if ($this->CheckAccess($this->menuname, $this->iswrite) == false) {
			$this->redirect(array('/admin/login'));
	  }
	}

	public function actionWrite()
	{
	  if ($this->CheckAccess($this->menuname, $this->iswrite) == false) {
			$this->redirect(array('/admin/login'));
	  }
	}

	public function actionDelete()
	{
	  if ($this->CheckAccess($this->menuname, $this->isreject) == false) {
			$this->redirect(array('/admin/login'));
	  }
	}

	public function actionApprove()
	{
	  if ($this->CheckAccess($this->menuname, $this->ispost) == false) {
			$this->redirect(array('/admin/login'));
	  }
	}
	
	public function actionHistory()
	{
	  if ($this->CheckAccess($this->menuname, $this->isread) == false) {
			$this->redirect(array('/admin/login'));
	  }
	}
	
	public function actionPurge()
	{
	  if ($this->CheckAccess($this->menuname, $this->ispurge) == false) {
			$this->redirect(array('/admin/login'));
	  }
	}

	public function actionUpload()
	{
	  if ($this->CheckAccess($this->menuname, $this->isupload) == false) {
			$this->redirect(array('/admin/login'));
	  } else {
        Yii::import("ext.EAjaxUpload.qqFileUploader");
				if ($this->folder == '')
				{
					$this->folder=$_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/upload/';
				}
				$allowedExtensions = Yii::app()->params['allowedext'];
        $sizeLimit = Yii::app()->params['sizeLimit'];
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($this->folder,true);
				$this->filename =$this->folder.$result['filename'];
				$return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
				echo $return;
		}
	}
	
	public function actionDownload()
	{
		if ($this->CheckAccess($this->menuname, $this->isdownload) == false) {
			$this->redirect(array('/admin/login'));
		} else {
			require_once("pdf.php");
			$this->connection=Yii::app()->db;    
			$this->pdf = new PDF();
		}
	}

	public function actionHelp()
	{
	  $this->GetMessage('success','');
	}    
}