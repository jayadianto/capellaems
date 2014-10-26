<?php

class WfstatusController extends Controller
{
	protected $menuname = 'wfstatus';
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
			$model=Wfstatus::model()->findByPk((int)$id[0]);
			if ($model != null)
				{
					if ($this->CheckDataLock($this->menuname, $id[0]) == false)
					{
						$this->InsertLock($this->menuname, $id[0]);
						echo CJSON::encode(array(
								'status'=>'success',
								'wfstatusid'=>$model->wfstatusid,
'workflowid'=>$model->workflowid,
'wfdesc'=>($model->workflow!==null)?$model->workflow->wfdesc:"",
'wfstat'=>$model->wfstat,
'wfstatusname'=>$model->wfstatusname,
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
		$this->DeleteLockCloseForm($this->menuname, $_POST['Wfstatus'], $_POST['Wfstatus']['wfstatusid']);
  }  
		
	public function actionWrite()
	{
	  if(isset($_POST['Wfstatus']))
	  {
			$messages = $this->ValidateData(
							array(
							//masukkan validasi, seperti contoh dibawah
							array($_POST['Wfstatus']['workflowid'],'emptyworkflow','emptystring'),
							array($_POST['Wfstatus']['wfstat'],'emptywfstat','emptystring'),
							array($_POST['Wfstatus']['wfstatusname'],'emptywfstatusname','emptystring'),
					)
			);
			if ($messages == '') 
			{
				$connection=Yii::app()->db;
				$transaction=$connection->beginTransaction();
				try
				{
					
					if ((int)$_POST['Wfstatus']['wfstatusid'] > 0)
					{
						$sql = 'call UpdateWfstatus(:vid,:vworkflowid,:vwfstat,:vwfstatusname,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$_POST['Wfstatus']['wfstatusid'],PDO::PARAM_STR);
					}
					else
					{
						$sql = 'call InsertWfstatus(:vworkflowid,:vwfstat,:vwfstatusname,:vcreatedby)';
						$command=$connection->createCommand($sql);
					}
					$command->bindvalue(':vworkflowid',$_POST['Wfstatus']['workflowid'],PDO::PARAM_STR);
$command->bindvalue(':vwfstat',$_POST['Wfstatus']['wfstat'],PDO::PARAM_STR);
$command->bindvalue(':vwfstatusname',$_POST['Wfstatus']['wfstatusname'],PDO::PARAM_STR);
					$command->bindvalue(':vcreatedby', Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
					$transaction->commit();
					$this->DeleteLock($this->menuname, $_POST['Wfstatus']['wfstatusid']);
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
				$sql = 'call Deletewfstatus(:vid,:vcreatedby)';
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
				$sql = 'call Purgewfstatus(:vid,:vcreatedby)';
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
		  
		 $model=new Wfstatus('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Wfstatus']))
		  $model->attributes=$_GET['Wfstatus'];
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
	  $sql = "select wfdesc,wfstat,wfstatusname				
			from wfstatus a 
			inner join workflow b on b.workflowid = a.workflowid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.wfstatusid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		//masukkan judul
		$this->pdf->title='Wfstatus List';
		$this->pdf->AddPage('P');
		//masukkan posisi judul
		$this->pdf->colalign = array('C','C','C');
		//masukkan colom judul
		$this->pdf->colheader = array('Workflow','Status','Text');
		$this->pdf->setwidths(array(70,30,40));
		$this->pdf->Rowheader();
		$this->pdf->coldetailalign = array('L','L','L');
		
		foreach($dataReader as $row1)
		{
			//masukkan baris untuk cetak
		  $this->pdf->row(array($row1['wfdesc'],$row1['wfstat'],$row1['wfstatusname']));
		}
		// me-render ke browser
		$this->pdf->Output();
	}
	
	public function actionDownExcel()
	{
		parent::actionDownload();
		$sql = "select wfdesc,wfstat,wfstatusname				
			from wfstatus a 
			inner join workflow b on b.workflowid = a.workflowid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.wfstatusid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		 $excel=Yii::createComponent('application.extensions.PHPExcel.PHPExcel');
		$i=1;
		$excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0,1,'Workflow')
					->setCellValueByColumnAndRow(1,1,'Status')
					->setCellValueByColumnAndRow(2,1,'Text');
		foreach($dataReader as $row1)
		{
			  $excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0, $i+1, $row1['wfdesc'])
					->setCellValueByColumnAndRow(1, $i+1, $row1['wfstat'])
					->setCellValueByColumnAndRow(2, $i+1, $row1['wfstatusname']);
		$i+=1;
		}
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Wfstatus.xlsx"');
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
												$sql = 'call UploadWfstatus(:vid,:vworkflowid,:vwfstat,:vwfstatusname,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$data[0],PDO::PARAM_STR);
						$command->bindvalue(':vworkflowid',$data[1],PDO::PARAM_STR);
$command->bindvalue(':vwfstat',$data[2],PDO::PARAM_STR);
$command->bindvalue(':vwfstatusname',$data[3],PDO::PARAM_STR);
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