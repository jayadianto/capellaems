<?php

class GroupmenuController extends Controller
{
	protected $menuname = 'groupmenu';
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
			$model=Groupmenu::model()->findByPk((int)$id[0]);
			if ($model != null)
				{
					if ($this->CheckDataLock($this->menuname, $id[0]) == false)
					{
						$this->InsertLock($this->menuname, $id[0]);
						echo CJSON::encode(array(
								'status'=>'success',
								'groupmenuid'=>$model->groupmenuid,
'groupaccessid'=>$model->groupaccessid,
'menuaccessid'=>$model->menuaccessid,
'groupname'=>($model->groupaccess!==null)?$model->groupaccess->groupname:"",
'menuname'=>($model->menuaccess!==null)?$model->menuaccess->menuname:"",
'isread'=>$model->isread,
'iswrite'=>$model->iswrite,
'ispost'=>$model->ispost,
'isreject'=>$model->isreject,
'isupload'=>$model->isupload,
'isdownload'=>$model->isdownload,
'ispurge'=>$model->ispurge,
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
		$this->DeleteLockCloseForm($this->menuname, $_POST['Groupmenu'], $_POST['Groupmenu']['groupmenuid']);
  }  
		
	public function actionWrite()
	{
	  if(isset($_POST['Groupmenu']))
	  {
			$messages = $this->ValidateData(
							array(
							//masukkan validasi, seperti contoh dibawah
							array($_POST['Groupmenu']['menuaccessid'],'emptymenuname','emptystring'),
							array($_POST['Groupmenu']['groupaccessid'],'emptygroupname','emptystring'),
					)
			);
			if ($messages == '') 
			{
				$connection=Yii::app()->db;
				$transaction=$connection->beginTransaction();
				try
				{
					
					if ((int)$_POST['Groupmenu']['groupmenuid'] > 0)
					{
						$sql = 'call UpdateGroupmenu(:vid,:vmenuaccessid,:vgroupaccessid,:visread,:viswrite,:vispost,:visreject,:visupload,:visdownload,:vispurge,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$_POST['Groupmenu']['groupmenuid'],PDO::PARAM_STR);
					}
					else
					{
						$sql = 'call InsertGroupmenu(:vmenuaccessid,:vgroupaccessid,:visread,:viswrite,:vispost,:visreject,:visupload,:visdownload,:vispurge,:vcreatedby)';
						$command=$connection->createCommand($sql);
					}
					$command->bindvalue(':vgroupaccessid',$_POST['Groupmenu']['groupaccessid'],PDO::PARAM_STR);
$command->bindvalue(':vmenuaccessid',$_POST['Groupmenu']['menuaccessid'],PDO::PARAM_STR);
$command->bindvalue(':visread',$_POST['Groupmenu']['isread'],PDO::PARAM_STR);
$command->bindvalue(':viswrite',$_POST['Groupmenu']['iswrite'],PDO::PARAM_STR);
$command->bindvalue(':vispost',$_POST['Groupmenu']['ispost'],PDO::PARAM_STR);
$command->bindvalue(':visreject',$_POST['Groupmenu']['isreject'],PDO::PARAM_STR);
$command->bindvalue(':visupload',$_POST['Groupmenu']['isupload'],PDO::PARAM_STR);
$command->bindvalue(':visdownload',$_POST['Groupmenu']['isdownload'],PDO::PARAM_STR);
$command->bindvalue(':vispurge',$_POST['Groupmenu']['ispurge'],PDO::PARAM_STR);
					$command->bindvalue(':vcreatedby', Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
					$transaction->commit();
					$this->DeleteLock($this->menuname, $_POST['Groupmenu']['groupmenuid']);
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
				$sql = 'call Deletegroupmenu(:vid,:vcreatedby)';
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
				$sql = 'call Purgegroupmenu(:vid,:vcreatedby)';
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
		  
		 $model=new Groupmenu('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Groupmenu']))
		  $model->attributes=$_GET['Groupmenu'];
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
	  $sql = "select groupname,menuname,isread,iswrite,ispost,isreject,isupload,
			isdownload,ispurge				
			from Groupmenu a 
			inner join groupaccess b on b.groupaccessid = a.groupaccessid
			inner join menuaccess c on c.menuaccessid = a.menuaccessid";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.groupmenuid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		//masukkan judul
		$this->pdf->title='Groupmenu List';
		$this->pdf->AddPage('P');
		//masukkan posisi judul
		$this->pdf->colalign = array('C','C','C','C','C','C','C','C','C','C','C');
		//masukkan colom judul
		$this->pdf->colheader = array('Group','Menu','Is Read','Is Write','Is Post','Is Reject','Is Upload','Is Download','Is Purge');
		$this->pdf->setwidths(array(50,50,10,10,10,10,10,10,10,10,10));
		$this->pdf->Rowheader();
		$this->pdf->coldetailalign = array('L','L','L','L','L','L','L','L','L','L','L','L');
		
		foreach($dataReader as $row1)
		{
			//masukkan baris untuk cetak
		  $this->pdf->row(array($row1['groupname'],$row1['menuname'],$row1['isread'],$row1['iswrite'],$row1['ispost'],$row1['isreject'],$row1['isupload'],$row1['isdownload'],$row1['ispurge']));
		}
		// me-render ke browser
		$this->pdf->Output();
	}
	
	public function actionDownExcel()
	{
		parent::actionDownload();
		$sql = "select groupname,menuname,isread,iswrite,ispost,isreject,isupload,
			isdownload,ispurge				
			from Groupmenu a 
			inner join groupaccess b on b.groupaccessid = a.groupaccessid
			inner join menuaccess c on c.menuaccessid = a.menuaccessid";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.groupmenuid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		 $excel=Yii::createComponent('application.extensions.PHPExcel.PHPExcel');
		$i=1;
		$excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0,1,'Group')
					->setCellValueByColumnAndRow(1,1,'Menu')
					->setCellValueByColumnAndRow(2,1,'Read')
					->setCellValueByColumnAndRow(3,1,'Write')
					->setCellValueByColumnAndRow(4,1,'Is Post')
					->setCellValueByColumnAndRow(5,1,'Is Reject')
					->setCellValueByColumnAndRow(6,1,'Is Upload')
					->setCellValueByColumnAndRow(7,1,'Is Download')
					->setCellValueByColumnAndRow(8,1,'Is Purge');
		foreach($dataReader as $row1)
		{
			  $excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0, $i+1, $row1['groupname'])
					->setCellValueByColumnAndRow(1, $i+1, $row1['menuname'])
					->setCellValueByColumnAndRow(2, $i+1, $row1['isread'])
					->setCellValueByColumnAndRow(3, $i+1, $row1['iswrite'])
					->setCellValueByColumnAndRow(4, $i+1, $row1['ispost'])
					->setCellValueByColumnAndRow(5, $i+1, $row1['isreject'])
					->setCellValueByColumnAndRow(6, $i+1, $row1['isupload'])
					->setCellValueByColumnAndRow(7, $i+1, $row1['isdownload'])
					->setCellValueByColumnAndRow(8, $i+1, $row1['ispurge']);
		$i+=1;
		}
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Groupmenu.xlsx"');
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
												$sql = 'call UploadGroupmenu(:vid,:vgroupaccessid,:vmenuaccessid,:visread,:viswrite,:vispost,:visreject,:visupload,:visdownload,:vispurge,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$data[0],PDO::PARAM_STR);
						$command->bindvalue(':vgroupaccessid',$data[1],PDO::PARAM_STR);
$command->bindvalue(':vmenuaccessid',$data[2],PDO::PARAM_STR);
$command->bindvalue(':visread',$data[3],PDO::PARAM_STR);
$command->bindvalue(':viswrite',$data[4],PDO::PARAM_STR);
$command->bindvalue(':vispost',$data[5],PDO::PARAM_STR);
$command->bindvalue(':visreject',$data[6],PDO::PARAM_STR);
$command->bindvalue(':visupload',$data[7],PDO::PARAM_STR);
$command->bindvalue(':visdownload',$data[8],PDO::PARAM_STR);
$command->bindvalue(':vispurge',$data[9],PDO::PARAM_STR);
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