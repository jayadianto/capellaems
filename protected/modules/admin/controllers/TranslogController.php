<?php

class TranslogController extends Controller
{
	protected $menuname = 'translog';
	public $layout = '//layouts/columnadmin';
	
	protected function gridData($data,$row)
  {     
    $model = Translog::model()->findByPk($data->translogid); 
    return $this->renderPartial('_view',array('model'=>$model),true); 
  }
	
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
			$model=Translog::model()->findByPk((int)$id[0]);
			if ($model != null)
				{
					if ($this->CheckDataLock($this->menuname, $id[0]) == false)
					{
						$this->InsertLock($this->menuname, $id[0]);
						echo CJSON::encode(array(
								'status'=>'success',
								'translogid'=>$model->translogid,
'username'=>$model->username,
'createddate'=>$model->createddate,
'useraction'=>$model->useraction,
'newdata'=>$model->newdata,
'olddata'=>$model->olddata,
'menuname'=>$model->menuname,
'tableid'=>$model->tableid,
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
		$this->DeleteLockCloseForm($this->menuname, $_POST['Translog'], $_POST['Translog']['translogid']);
  }  
		
	public function actionWrite()
	{
	  if(isset($_POST['Translog']))
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
					
					if ((int)$_POST['Translog']['translogid'] > 0)
					{
						$sql = 'call UpdateTranslog(:vid,:vusername,:vcreateddate,:vuseraction,:vnewdata,:volddata,:vmenuname,:vtableid,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$_POST['Translog']['translogid'],PDO::PARAM_STR);
					}
					else
					{
						$sql = 'call InsertTranslog(:vusername,:vcreateddate,:vuseraction,:vnewdata,:volddata,:vmenuname,:vtableid,:vcreatedby)';
						$command=$connection->createCommand($sql);
					}
					$command->bindvalue(':vusername',$_POST['Translog']['username'],PDO::PARAM_STR);
$command->bindvalue(':vcreateddate',$_POST['Translog']['createddate'],PDO::PARAM_STR);
$command->bindvalue(':vuseraction',$_POST['Translog']['useraction'],PDO::PARAM_STR);
$command->bindvalue(':vnewdata',$_POST['Translog']['newdata'],PDO::PARAM_STR);
$command->bindvalue(':volddata',$_POST['Translog']['olddata'],PDO::PARAM_STR);
$command->bindvalue(':vmenuname',$_POST['Translog']['menuname'],PDO::PARAM_STR);
$command->bindvalue(':vtableid',$_POST['Translog']['tableid'],PDO::PARAM_STR);
					$command->bindvalue(':vcreatedby', Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
					$transaction->commit();
					$this->DeleteLock($this->menuname, $_POST['Translog']['translogid']);
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
				$sql = 'call Deletetranslog(:vid,:vcreatedby)';
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
				$sql = 'call Purgetranslog(:vid,:vcreatedby)';
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
		  
		 $model=new Translog('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Translog']))
		  $model->attributes=$_GET['Translog'];
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
	  $sql = "select username,createddate,useraction,newdata,olddata,menuname,tableid				from Translog a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.translogid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		//masukkan judul
		$this->pdf->title='Translog List';
		$this->pdf->AddPage('P');
		//masukkan posisi judul
		$this->pdf->colalign = array('C','C','C','C','C','C');
		//masukkan colom judul
		$this->pdf->colheader = array('User Name','User Action','Menu Name','Table ID','Old Data','New Data');
		$this->pdf->setwidths(array(20,20,20,20,55,55));
		$this->pdf->Rowheader();
		$this->pdf->coldetailalign = array('L','L','L','L','L','L');
		
		foreach($dataReader as $row1)
		{
			//masukkan baris untuk cetak
		  $this->pdf->row(array($row1['username'],$row1['useraction'],$row1['menuname'],$row1['tableid'],$row1['olddata'],$row1['newdata']));
		}
		// me-render ke browser
		$this->pdf->Output();
	}
	
	public function actionDownExcel()
	{
		parent::actionDownload();
		$sql = "select username,createddate,useraction,newdata,olddata,menuname,tableid				from Translog a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.translogid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		 $excel=Yii::createComponent('application.extensions.PHPExcel.PHPExcel');
		$i=1;
		$excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0,1,'User Name')
					->setCellValueByColumnAndRow(1,1,'Created Date')
					->setCellValueByColumnAndRow(2,1,'User Action')
					->setCellValueByColumnAndRow(3,1,'Menu Name')
					->setCellValueByColumnAndRow(4,1,'Table ID')
					->setCellValueByColumnAndRow(5,1,'New Data')
					->setCellValueByColumnAndRow(6,1,'Old Data');
		foreach($dataReader as $row1)
		{
			  $excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0, $i+1, $row1['username'])
					->setCellValueByColumnAndRow(1, $i+1, $row1['createddate'])
					->setCellValueByColumnAndRow(2, $i+1, $row1['useraction'])
					->setCellValueByColumnAndRow(3, $i+1, $row1['menuname'])
					->setCellValueByColumnAndRow(4, $i+1, $row1['tableid'])
					->setCellValueByColumnAndRow(5, $i+1, $row1['newdata'])
					->setCellValueByColumnAndRow(6, $i+1, $row1['olddata'])
					;
		$i+=1;
		}
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Translog.xlsx"');
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
												$sql = 'call UploadTranslog(:vid,:vusername,:vcreateddate,:vuseraction,:vnewdata,:volddata,:vmenuname,:vtableid,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$data[0],PDO::PARAM_STR);
						$command->bindvalue(':vusername',$data[1],PDO::PARAM_STR);
$command->bindvalue(':vcreateddate',$data[2],PDO::PARAM_STR);
$command->bindvalue(':vuseraction',$data[3],PDO::PARAM_STR);
$command->bindvalue(':vnewdata',$data[4],PDO::PARAM_STR);
$command->bindvalue(':volddata',$data[5],PDO::PARAM_STR);
$command->bindvalue(':vmenuname',$data[6],PDO::PARAM_STR);
$command->bindvalue(':vtableid',$data[7],PDO::PARAM_STR);
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