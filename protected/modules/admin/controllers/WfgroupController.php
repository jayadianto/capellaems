<?php

class WfgroupController extends Controller
{
	protected $menuname = 'wfgroup';
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
			$model=Wfgroup::model()->findByPk((int)$id[0]);
			if ($model != null)
				{
					if ($this->CheckDataLock($this->menuname, $id[0]) == false)
					{
						$this->InsertLock($this->menuname, $id[0]);
						echo CJSON::encode(array(
								'status'=>'success',
								'wfgroupid'=>$model->wfgroupid,
'workflowid'=>$model->workflowid,
'wfdesc'=>($model->workflow!==null)?$model->workflow->wfdesc:"",
'groupaccessid'=>$model->groupaccessid,
'groupname'=>($model->groupaccess!==null)?$model->groupaccess->groupname:"",
'wfbefstat'=>$model->wfbefstat,
'wfrecstat'=>$model->wfrecstat,
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
		$this->DeleteLockCloseForm($this->menuname, $_POST['Wfgroup'], $_POST['Wfgroup']['wfgroupid']);
  }  
		
	public function actionWrite()
	{
	  if(isset($_POST['Wfgroup']))
	  {
			$messages = $this->ValidateData(
							array(
							//masukkan validasi, seperti contoh dibawah
							array($_POST['Wfgroup']['workflowid'],'emptywfdesc','emptystring'),
							array($_POST['Wfgroup']['groupaccessid'],'emptygroupname','emptystring'),
					)
			);
			if ($messages == '') 
			{
				$connection=Yii::app()->db;
				$transaction=$connection->beginTransaction();
				try
				{
					
					if ((int)$_POST['Wfgroup']['wfgroupid'] > 0)
					{
						$sql = 'call UpdateWfgroup(:vid,:vworkflowid,:vgroupaccessid,:vwfbefstat,:vwfrecstat,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$_POST['Wfgroup']['wfgroupid'],PDO::PARAM_STR);
					}
					else
					{
						$sql = 'call InsertWfgroup(:vworkflowid,:vgroupaccessid,:vwfbefstat,:vwfrecstat,:vcreatedby)';
						$command=$connection->createCommand($sql);
					}
					$command->bindvalue(':vworkflowid',$_POST['Wfgroup']['workflowid'],PDO::PARAM_STR);
$command->bindvalue(':vgroupaccessid',$_POST['Wfgroup']['groupaccessid'],PDO::PARAM_STR);
$command->bindvalue(':vwfbefstat',$_POST['Wfgroup']['wfbefstat'],PDO::PARAM_STR);
$command->bindvalue(':vwfrecstat',$_POST['Wfgroup']['wfrecstat'],PDO::PARAM_STR);
					$command->bindvalue(':vcreatedby', Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
					$transaction->commit();
					$this->DeleteLock($this->menuname, $_POST['Wfgroup']['wfgroupid']);
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
				$sql = 'call Deletewfgroup(:vid,:vcreatedby)';
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
				$sql = 'call Purgewfgroup(:vid,:vcreatedby)';
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
		  
		 $model=new Wfgroup('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Wfgroup']))
		  $model->attributes=$_GET['Wfgroup'];
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
	  $sql = "select wfdesc,groupname,wfbefstat,wfrecstat				
			from wfgroup a 
			inner join workflow b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = a.groupaccessid			";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.wfgroupid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		//masukkan judul
		$this->pdf->title='Wfgroup List';
		$this->pdf->AddPage('P');
		//masukkan posisi judul
		$this->pdf->colalign = array('C','C','C','C');
		//masukkan colom judul
		$this->pdf->colheader = array('Workflow','Group','Before Process','After Process');
		$this->pdf->setwidths(array(60,60,20,20));
		$this->pdf->Rowheader();
		$this->pdf->coldetailalign = array('L','L','L','L');
		
		foreach($dataReader as $row1)
		{
			//masukkan baris untuk cetak
		  $this->pdf->row(array($row1['wfdesc'],$row1['groupname'],$row1['wfbefstat'],$row1['wfrecstat']));
		}
		// me-render ke browser
		$this->pdf->Output();
	}
	
	public function actionDownExcel()
	{
		parent::actionDownload();
		$sql = "select wfdesc,groupname,wfbefstat,wfrecstat				
			from wfgroup a 
			inner join workflow b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = a.groupaccessid			";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.wfgroupid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		 $excel=Yii::createComponent('application.extensions.PHPExcel.PHPExcel');
		$i=1;
		$excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0,1,'Workflow')
					->setCellValueByColumnAndRow(1,1,'Group')
					->setCellValueByColumnAndRow(2,1,'Before Process')
					->setCellValueByColumnAndRow(3,1,'After Process');
		foreach($dataReader as $row1)
		{
			  $excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0, $i+1, $row1['wfdesc'])
					->setCellValueByColumnAndRow(1, $i+1, $row1['groupname'])
					->setCellValueByColumnAndRow(2, $i+1, $row1['wfbefstat'])
					->setCellValueByColumnAndRow(3, $i+1, $row1['wfrecstat']);
		$i+=1;
		}
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Wfgroup.xlsx"');
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
												$sql = 'call UploadWfgroup(:vid,:vworkflowid,:vgroupaccessid,:vwfbefstat,:vwfrecstat,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$data[0],PDO::PARAM_STR);
						$command->bindvalue(':vworkflowid',$data[1],PDO::PARAM_STR);
$command->bindvalue(':vgroupaccessid',$data[2],PDO::PARAM_STR);
$command->bindvalue(':vwfbefstat',$data[3],PDO::PARAM_STR);
$command->bindvalue(':vwfrecstat',$data[4],PDO::PARAM_STR);
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