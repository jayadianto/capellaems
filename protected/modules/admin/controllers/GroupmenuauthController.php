<?php

class GroupmenuauthController extends Controller
{
	protected $menuname = 'groupmenuauth';
	public $layout = '//layouts/columnadmin';
		public function actionCreate()
	{
		parent::actionCreate();
				$this->GetMessage('success','insertsuccess');
		}
	
		public function actionUpdate()
	{
		parent::actionUpdate();
		if (isset($_POST['id']))
		{
			$id=$_POST['id'];
			$model=Groupmenuauth::model()->findByPk((int)$id[0]);
			if ($model != null)
				{
					if ($this->CheckDataLock($this->menuname, $id[0]) == false)
					{
						$this->InsertLock($this->menuname, $id[0]);
						echo CJSON::encode(array(
								'status'=>'success',
								'groupmenuauthid'=>$model->groupmenuauthid,
'groupaccessid'=>$model->groupaccessid,
'menuauthid'=>$model->menuauthid,
'menuvalueid'=>$model->menuvalueid,
'groupname'=>($model->groupaccess!==null)?$model->groupaccess->groupname:"",
'menuobject'=>($model->menuauth!==null)?$model->menuauth->menuobject:"",
								));
						Yii::app()->end();
					}
			}
		}
		else
		{
			$this->getMessage('failure','chooseone');
		}
	}
		public function actionCancelWrite()
  {
		$this->DeleteLockCloseForm($this->menuname, $_POST['Groupmenuauth'], $_POST['Groupmenuauth']['groupmenuauthid']);
  }  
		
	public function actionWrite()
	{
	  if(isset($_POST['Groupmenuauth']))
	  {
			$messages = $this->ValidateData(
							array(
							//masukkan validasi, seperti contoh dibawah
							//array($_POST['Accperiod']['period'],'emptyperiod','emptystring'),
					)
			);
			if ($messages == '') 
			{
				$connection=Yii::app()->db;
				$transaction=$connection->beginTransaction();
				try
				{
					
					if ((int)$_POST['Groupmenuauth']['groupmenuauthid'] > 0)
					{
						$sql = 'call UpdateGroupmenuauth(:vid,:vgroupaccessid,:vmenuauthid,:vmenuvalueid,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$_POST['Groupmenuauth']['groupmenuauthid'],PDO::PARAM_STR);
					}
					else
					{
						$sql = 'call InsertGroupmenuauth(:vgroupaccessid,:vmenuauthid,:vmenuvalueid,:vcreatedby)';
						$command=$connection->createCommand($sql);
					}
					$command->bindvalue(':vgroupaccessid',$_POST['Groupmenuauth']['groupaccessid'],PDO::PARAM_STR);
$command->bindvalue(':vmenuauthid',$_POST['Groupmenuauth']['menuauthid'],PDO::PARAM_STR);
$command->bindvalue(':vmenuvalueid',$_POST['Groupmenuauth']['menuvalueid'],PDO::PARAM_STR);
					$command->bindvalue(':vcreatedby', Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
					$transaction->commit();
					$this->DeleteLock($this->menuname, $_POST['Groupmenuauth']['groupmenuauthid']);
					$this->GetMessage('success','insertsuccess');
			  }
				catch (Exception $e)
				{
					$transaction->rollback();
					$this->GetMessage('failure',$e->getMessage());
				}         
			}
	  }
		else
		{
			$this->getMessage('failure','chooseone');
		}
	}
		public function actionDelete()
	{
		parent::actionDelete();
		if (isset($_POST['id']))
		{
			$id=$_POST['id'];
			$connection=Yii::app()->db;
			$transaction=$connection->beginTransaction();
			try
			{
				//masukkan perintah delete
				$sql = 'call Deletegroupmenuauth(:vid,:vcreatedby)';
				$command=$connection->createCommand($sql);
				foreach($id as $ids)
				{
					$command->bindvalue(':vid',$ids,PDO::PARAM_STR);
					$command->bindvalue(':vcreatedby',Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
				}
				$transaction->commit();
				$this->GetMessage('success','insertsuccess');
			}
			catch (Exception $e)
			{
				$transaction->rollback();
				$this->GetMessage('failure',$e->getMessage());
			}
		}
		else
		{
			$this->getMessage('failure','chooseone');
		}
	}	
	
	public function actionPurge()
	{
		parent::actionPurge();
		if (isset($_POST['id']))
		{
			$id=$_POST['id'];
			$connection=Yii::app()->db;
			$transaction=$connection->beginTransaction();
			try
			{
				//masukkan perintah delete
				$sql = 'call Purgegroupmenuauth(:vid,:vcreatedby)';
				$command=$connection->createCommand($sql);
				foreach($id as $ids)
				{
					$command->bindvalue(':vid',$ids,PDO::PARAM_STR);
					$command->bindvalue(':vcreatedby',Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
				}
				$transaction->commit();
				$this->GetMessage('success','insertsuccess');
			}
			catch (Exception $e)
			{
				$transaction->rollback();
				$this->GetMessage('failure',$e->getMessage());
			}
		}
		else
		{
			$this->getMessage('failure','chooseone');
		}
	}	
		
	public function actionHistory()
	{
	  parent::actionHistory();
		if (isset($_POST['id']))
		{
			echo CJSON::encode(array(
						'status'=>'success',
						'id'=>$_POST['id'][0],
					));
		}
		else
		{
			$this->getMessage('failure','chooseone');
		}
	}
	
	public function actionIndex()
	{
		 parent::actionIndex();
		  
		 $model=new Groupmenuauth('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Groupmenuauth']))
		  $model->attributes=$_GET['Groupmenuauth'];
	  if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$translog=new Translog('search');
		$translog->unsetAttributes();  // clear any default values
		if(isset($_GET['Translog']))
			$translog->attributes=$_GET['Translog'];
	  $this->render('index',array(
		  'model'=>$model,
			'translog'=>$translog,
		 	  ));
	}

	public function actionDownPDF()
	{
	  parent::actionDownload();
		//masukkan perintah download
	  $sql = "select groupname,menuobject,menuvalueid 
			from Groupmenuauth a 
			inner join groupaccess b on b.groupaccessid = a.groupaccessid
			inner join menuauth c on c.menuauthid = a.menuauthid";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.groupmenuauthid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		//masukkan judul
		$this->pdf->title='Groupmenuauth List';
		$this->pdf->AddPage('P');
		//masukkan posisi judul
		$this->pdf->colalign = array('C','C','C');
		//masukkan colom judul
		$this->pdf->colheader = array('Group Name','Menu Object','Menu Value');
		$this->pdf->setwidths(array(70,70,40));
		$this->pdf->Rowheader();
		$this->pdf->coldetailalign = array('L','L','L');
		
		foreach($dataReader as $row1)
		{
			//masukkan baris untuk cetak
		  $this->pdf->row(array($row1['groupname'],$row1['menuobject'],$row1['menuvalueid']));
		}
		// me-render ke browser
		$this->pdf->Output();
	}
	
	public function actionDownExcel()
	{
		parent::actionDownload();
		$sql = "select groupname,menuobject,menuvalueid 
			from Groupmenuauth a 
			inner join groupaccess b on b.groupaccessid = a.groupaccessid
			inner join menuauth c on c.menuauthid = a.menuauthid";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.groupmenuauthid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		 $excel=Yii::createComponent('application.extensions.PHPExcel.PHPExcel');
		$i=1;
		$excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0,1,'Group Name')
					->setCellValueByColumnAndRow(1,1,'Menu Object')
					->setCellValueByColumnAndRow(2,1,'Menu Value')
					;
		foreach($dataReader as $row1)
		{
			  $excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0, $i+1, $row1['groupname'])
					->setCellValueByColumnAndRow(1, $i+1, $row1['menuobject'])
					->setCellValueByColumnAndRow(2, $i+1, $row1['menuvalueid']);
		$i+=1;
		}
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Groupmenuauth.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$objWriter->save('php://output');
		unset($excel);
	}
	
	public function actionUpload()
	{
    parent::actionUpload();
		$row=1;$error = false;$return='';$id=0;
		if (($handle = fopen($this->filename, "r")) !== FALSE) 
		{
			while (($data = fgetcsv($handle, 2000, "^")) !== FALSE) 
			{
				if ($row>1)
				{
					$connection=Yii::app()->db;
					$transaction=$connection->beginTransaction();
					try
					{
												$sql = 'call UploadGroupmenuauth(:vid,:vgroupaccessid,:vmenuauthid,:vmenuvalueid,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$data[0],PDO::PARAM_STR);
						$command->bindvalue(':vgroupaccessid',$data[1],PDO::PARAM_STR);
$command->bindvalue(':vmenuauthid',$data[2],PDO::PARAM_STR);
$command->bindvalue(':vmenuvalueid',$data[3],PDO::PARAM_STR);
						$command->bindvalue(':vcreatedby', Yii::app()->user->name,PDO::PARAM_STR);
						$command->execute();
						$transaction->commit();
					}
					catch (Exception $e)
					{
						$transaction->rollBack();
						$this->GetMessage($e->getMessage());
					}
				}
				$row++;
			}
		}
  }
}