<?php

class WorkflowController extends Controller
{
	protected $menuname = 'workflow';
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
			$model=Workflow::model()->findByPk((int)$id[0]);
			if ($model != null)
				{
					if ($this->CheckDataLock($this->menuname, $id[0]) == false)
					{
						$this->InsertLock($this->menuname, $id[0]);
						echo CJSON::encode(array(
								'status'=>'success',
								'workflowid'=>$model->workflowid,
'wfname'=>$model->wfname,
'wfdesc'=>$model->wfdesc,
'wfminstat'=>$model->wfminstat,
'wfmaxstat'=>$model->wfmaxstat,
'recordstatus'=>$model->recordstatus,
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
		$this->DeleteLockCloseForm($this->menuname, $_POST['Workflow'], $_POST['Workflow']['workflowid']);
  }  
		
	public function actionWrite()
	{
	  if(isset($_POST['Workflow']))
	  {
			$messages = $this->ValidateData(
							array(
							//masukkan validasi, seperti contoh dibawah
							array($_POST['Workflow']['wfname'],'emptywfname','emptystring'),
							array($_POST['Workflow']['wfdesc'],'emptywfdesc','emptystring'),
							array($_POST['Workflow']['wfminstat'],'emptywfminstat','emptystring'),
							array($_POST['Workflow']['wfmaxstat'],'emptywfmaxstat','emptystring'),
					)
			);
			if ($messages == '') 
			{
				$connection=Yii::app()->db;
				$transaction=$connection->beginTransaction();
				try
				{
					
					if ((int)$_POST['Workflow']['workflowid'] > 0)
					{
						$sql = 'call UpdateWorkflow(:vid,:vwfname,:vwfdesc,:vwfminstat,:vwfmaxstat,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$_POST['Workflow']['workflowid'],PDO::PARAM_STR);
					}
					else
					{
						$sql = 'call InsertWorkflow(:vwfname,:vwfdesc,:vwfminstat,:vwfmaxstat,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
					}
					$command->bindvalue(':vwfname',$_POST['Workflow']['wfname'],PDO::PARAM_STR);
$command->bindvalue(':vwfdesc',$_POST['Workflow']['wfdesc'],PDO::PARAM_STR);
$command->bindvalue(':vwfminstat',$_POST['Workflow']['wfminstat'],PDO::PARAM_STR);
$command->bindvalue(':vwfmaxstat',$_POST['Workflow']['wfmaxstat'],PDO::PARAM_STR);
$command->bindvalue(':vrecordstatus',$_POST['Workflow']['recordstatus'],PDO::PARAM_STR);
					$command->bindvalue(':vcreatedby', Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
					$transaction->commit();
					$this->DeleteLock($this->menuname, $_POST['Workflow']['workflowid']);
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
				$sql = 'call Deleteworkflow(:vid,:vcreatedby)';
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
				$sql = 'call Purgeworkflow(:vid,:vcreatedby)';
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
		  
		 $model=new Workflow('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Workflow']))
		  $model->attributes=$_GET['Workflow'];
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
	  $sql = "select wfname,wfdesc,wfminstat,wfmaxstat,recordstatus				from Workflow a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.workflowid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		//masukkan judul
		$this->pdf->title='Workflow List';
		$this->pdf->AddPage('P');
		//masukkan posisi judul
		$this->pdf->colalign = array('C','C','C','C');
		//masukkan colom judul
		$this->pdf->colheader = array('Workflow','Description','Min Status','Max Status');
		$this->pdf->setwidths(array(40,70,20,20));
		$this->pdf->Rowheader();
		$this->pdf->coldetailalign = array('L','L','L','L');
		
		foreach($dataReader as $row1)
		{
			//masukkan baris untuk cetak
		  $this->pdf->row(array($row1['wfname'],$row1['wfdesc'],$row1['wfminstat'],$row1['wfmaxstat']));
		}
		// me-render ke browser
		$this->pdf->Output();
	}
	
	public function actionDownExcel()
	{
		parent::actionDownload();
		$sql = "select wfname,wfdesc,wfminstat,wfmaxstat,recordstatus				from Workflow a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.workflowid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		 $excel=Yii::createComponent('application.extensions.PHPExcel.PHPExcel');
		$i=1;
		$excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0,1,'Workflow')
					->setCellValueByColumnAndRow(1,1,'Description')
					->setCellValueByColumnAndRow(2,1,'Min Status')
					->setCellValueByColumnAndRow(3,1,'Max Status');
		foreach($dataReader as $row1)
		{
			  $excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0, $i+1, $row1['wfname'])
					->setCellValueByColumnAndRow(1, $i+1, $row1['wfdesc'])
					->setCellValueByColumnAndRow(2, $i+1, $row1['wfminstat'])
					->setCellValueByColumnAndRow(3, $i+1, $row1['wfmaxstat']);
		$i+=1;
		}
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Workflow.xlsx"');
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
												$sql = 'call UploadWorkflow(:vid,:vwfname,:vwfdesc,:vwfminstat,:vwfmaxstat,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$data[0],PDO::PARAM_STR);
						$command->bindvalue(':vwfname',$data[1],PDO::PARAM_STR);
$command->bindvalue(':vwfdesc',$data[2],PDO::PARAM_STR);
$command->bindvalue(':vwfminstat',$data[3],PDO::PARAM_STR);
$command->bindvalue(':vwfmaxstat',$data[4],PDO::PARAM_STR);
$command->bindvalue(':vrecordstatus',$data[5],PDO::PARAM_STR);
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