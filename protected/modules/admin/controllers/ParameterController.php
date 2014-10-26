<?php

class ParameterController extends Controller
{
	protected $menuname = 'parameter';
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
			$model=Parameter::model()->findByPk((int)$id[0]);
			if ($model != null)
				{
					if ($this->CheckDataLock($this->menuname, $id[0]) == false)
					{
						$this->InsertLock($this->menuname, $id[0]);
						echo CJSON::encode(array(
								'status'=>'success',
								'parameterid'=>$model->parameterid,
'paramname'=>$model->paramname,
'paramvalue'=>$model->paramvalue,
'description'=>$model->description,
'moduleid'=>$model->moduleid,
'modulename'=>($model->module!==null)?$model->module->modulename:"",
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
		$this->DeleteLockCloseForm($this->menuname, $_POST['Parameter'], $_POST['Parameter']['parameterid']);
  }  
		
	public function actionWrite()
	{
	  if(isset($_POST['Parameter']))
	  {
			$messages = $this->ValidateData(
							array(
							//masukkan validasi, seperti contoh dibawah
							array($_POST['Parameter']['paramname'],'emptyparamname','emptystring'),
							array($_POST['Parameter']['paramvalue'],'emptyparamvalue','emptystring'),
							array($_POST['Parameter']['description'],'emptydescription','emptystring'),
							array($_POST['Parameter']['moduleid'],'emptymodule','emptystring'),
					)
			);
			if ($messages == '') 
			{
				$connection=Yii::app()->db;
				$transaction=$connection->beginTransaction();
				try
				{
					
					if ((int)$_POST['Parameter']['parameterid'] > 0)
					{
						$sql = 'call UpdateParameter(:vid,:vparamname,:vparamvalue,:vdescription,:vmoduleid,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$_POST['Parameter']['parameterid'],PDO::PARAM_STR);
					}
					else
					{
						$sql = 'call InsertParameter(:vparamname,:vparamvalue,:vdescription,:vmoduleid,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
					}
					$command->bindvalue(':vparamname',$_POST['Parameter']['paramname'],PDO::PARAM_STR);
$command->bindvalue(':vparamvalue',$_POST['Parameter']['paramvalue'],PDO::PARAM_STR);
$command->bindvalue(':vdescription',$_POST['Parameter']['description'],PDO::PARAM_STR);
$command->bindvalue(':vmoduleid',$_POST['Parameter']['moduleid'],PDO::PARAM_STR);
$command->bindvalue(':vrecordstatus',$_POST['Parameter']['recordstatus'],PDO::PARAM_STR);
					$command->bindvalue(':vcreatedby', Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
					$transaction->commit();
					$this->DeleteLock($this->menuname, $_POST['Parameter']['parameterid']);
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
				$sql = 'call Deleteparameter(:vid,:vcreatedby)';
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
				$sql = 'call Purgeparameter(:vid,:vcreatedby)';
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
		  
		 $model=new Parameter('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Parameter']))
		  $model->attributes=$_GET['Parameter'];
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
	  $sql = "select paramname,paramvalue,description,moduleid,recordstatus				from Parameter a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.parameterid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		//masukkan judul
		$this->pdf->title='Parameter List';
		$this->pdf->AddPage('P');
		//masukkan posisi judul
		$this->pdf->colalign = array('C');
		//masukkan colom judul
		$this->pdf->colheader = array('Account Period');
		$this->pdf->setwidths(array(90));
		$this->pdf->Rowheader();
		$this->pdf->coldetailalign = array('L');
		
		foreach($dataReader as $row1)
		{
			//masukkan baris untuk cetak
		  $this->pdf->row(array($row1['paramname'],$row1['paramvalue'],$row1['description'],$row1['moduleid'],$row1['recordstatus']));
		}
		// me-render ke browser
		$this->pdf->Output();
	}
	
	public function actionDownExcel()
	{
		parent::actionDownload();
		$sql = "select paramname,paramvalue,description,moduleid,recordstatus				from Parameter a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.parameterid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		 $excel=Yii::createComponent('application.extensions.PHPExcel.PHPExcel');
		$i=1;
		$excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0,1,'Language');
		foreach($dataReader as $row1)
		{
			  $excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0, $i+1, $row1['languagename']);
		$i+=1;
		}
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Parameter.xlsx"');
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
												$sql = 'call UploadParameter(:vid,:vparamname,:vparamvalue,:vdescription,:vmoduleid,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$data[0],PDO::PARAM_STR);
						$command->bindvalue(':vparamname',$data[1],PDO::PARAM_STR);
$command->bindvalue(':vparamvalue',$data[2],PDO::PARAM_STR);
$command->bindvalue(':vdescription',$data[3],PDO::PARAM_STR);
$command->bindvalue(':vmoduleid',$data[4],PDO::PARAM_STR);
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