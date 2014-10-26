<?php

class CurrencyController extends Controller
{
	protected $menuname = 'currency';
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
			$model=Currency::model()->findByPk((int)$id[0]);
			if ($model != null)
				{
					if ($this->CheckDataLock($this->menuname, $id[0]) == false)
					{
						$this->InsertLock($this->menuname, $id[0]);
						echo CJSON::encode(array(
								'status'=>'success',
								'currencyid'=>$model->currencyid,
'countryid'=>$model->countryid,
'countryname'=>($model->country!==null)?$model->country->countryname:"",
'currencyname'=>$model->currencyname,
'symbol'=>$model->symbol,
'recordstatus'=>$model->recordstatus,
'i18n'=>$model->i18n,
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
		$this->DeleteLockCloseForm($this->menuname, $_POST['Currency'], $_POST['Currency']['currencyid']);
  }  
		
	public function actionWrite()
	{
	  if(isset($_POST['Currency']))
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
					
					if ((int)$_POST['Currency']['currencyid'] > 0)
					{
						$sql = 'call UpdateCurrency(:vid,:vcountryid,:vcurrencyname,:vsymbol,:vrecordstatus,:vi18n,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$_POST['Currency']['currencyid'],PDO::PARAM_STR);
					}
					else
					{
						$sql = 'call InsertCurrency(:vcountryid,:vcurrencyname,:vsymbol,:vrecordstatus,:vi18n,:vcreatedby)';
						$command=$connection->createCommand($sql);
					}
					$command->bindvalue(':vcountryid',$_POST['Currency']['countryid'],PDO::PARAM_STR);
$command->bindvalue(':vcurrencyname',$_POST['Currency']['currencyname'],PDO::PARAM_STR);
$command->bindvalue(':vsymbol',$_POST['Currency']['symbol'],PDO::PARAM_STR);
$command->bindvalue(':vrecordstatus',$_POST['Currency']['recordstatus'],PDO::PARAM_STR);
$command->bindvalue(':vi18n',$_POST['Currency']['i18n'],PDO::PARAM_STR);
					$command->bindvalue(':vcreatedby', Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
					$transaction->commit();
					$this->DeleteLock($this->menuname, $_POST['Currency']['currencyid']);
					$this->GetMessage('success','insertsuccess');
			  }
				catch (Exception $e)
				{
					$transaction->rollback();
					$this->GetMessage($e->getMessage());
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
				$sql = 'call Deletecurrency(:vid,:vcreatedby)';
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
				$this->GetMessage($e->getMessage());
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
				$sql = 'call Purgecurrency(:vid,:vcreatedby)';
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
				$this->GetMessage($e->getMessage());
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
		  
		 $model=new Currency('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Currency']))
		  $model->attributes=$_GET['Currency'];
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
		$sql = "select countryname,currencyname,symbol,i18n
				from currency a
left join country b on b.countryid = a.countryid				";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.currencyid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		$this->pdf->title='Currency List';
		$this->pdf->AddPage('P');
		// definisi font
		
		$this->pdf->colalign = array('C','C','C','C');
		$this->pdf->setwidths(array(80,50,30,30));
		$this->pdf->colheader = array('Country Name','Currency Name','Symbol','i18n');
		$this->pdf->rowheader();
		
		$this->pdf->coldetailalign = array('L','L','L','L');
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['countryname'],$row1['currencyname'],$row1['symbol'],$row1['i18n']));
		}
		// me-render ke browser
		$this->pdf->Output();
	}
	
	public function actionDownExcel()
	{
		parent::actionDownload();
		$sql = "select countryname,currencyname,symbol,i18n
				from currency a
left join country b on b.countryid = a.countryid				";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.currencyid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		 $excel=Yii::createComponent('application.extensions.PHPExcel.PHPExcel');
		 $excel->setActiveSheetIndex(0)
           ->setCellValueByColumnAndRow(0, 1, 'Country Name')
					->setCellValueByColumnAndRow(1, 1, 'Currency Name')
					 ->setCellValueByColumnAndRow(2, 1, 'Symbol')
					->setCellValueByColumnAndRow(3, 1, 'i18n');
					 $i=1;
		foreach($dataReader as $row1)
		{
			  $excel->setActiveSheetIndex(0)
           ->setCellValueByColumnAndRow(0, $i+1, $row1['countryname'])
           ->setCellValueByColumnAndRow(1, $i+1, $row1['currencyname'])					 
           ->setCellValueByColumnAndRow(2, $i+1, $row1['symbol'])
					->setCellValueByColumnAndRow(3, $i+1, $row1['i18n']);
					 $i+=1;
		}
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="currency.xlsx"');
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
												$sql = 'call UploadCurrency(:vid,:vcompanyname,:vaddress,:vcity,:vzipcode,:vtaxno,:vcurrencyid,:vfaxno,:vphoneno,:vwebaddress,:vemail,:vleftlogofile,:vrightlogofile,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$data[0],PDO::PARAM_STR);
						$command->bindvalue(':vcompanyname',$data[1],PDO::PARAM_STR);
$command->bindvalue(':vaddress',$data[2],PDO::PARAM_STR);
$command->bindvalue(':vcity',$data[3],PDO::PARAM_STR);
$command->bindvalue(':vzipcode',$data[4],PDO::PARAM_STR);
$command->bindvalue(':vtaxno',$data[5],PDO::PARAM_STR);
$command->bindvalue(':vcurrencyid',$data[6],PDO::PARAM_STR);
$command->bindvalue(':vfaxno',$data[7],PDO::PARAM_STR);
$command->bindvalue(':vphoneno',$data[8],PDO::PARAM_STR);
$command->bindvalue(':vwebaddress',$data[9],PDO::PARAM_STR);
$command->bindvalue(':vemail',$data[10],PDO::PARAM_STR);
$command->bindvalue(':vleftlogofile',$data[11],PDO::PARAM_STR);
$command->bindvalue(':vrightlogofile',$data[12],PDO::PARAM_STR);
$command->bindvalue(':vrecordstatus',$data[13],PDO::PARAM_STR);
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