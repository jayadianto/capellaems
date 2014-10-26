<?php

class CompanyController extends Controller
{
	protected $menuname = 'company';
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
			$model=Company::model()->findByPk((int)$id[0]);
			if ($model != null)
				{
					if ($this->CheckDataLock($this->menuname, $id[0]) == false)
					{
						$this->InsertLock($this->menuname, $id[0]);
						echo CJSON::encode(array(
								'status'=>'success',
								'companyid'=>$model->companyid,
'companyname'=>$model->companyname,
'address'=>$model->address,
'city'=>$model->city,
'zipcode'=>$model->zipcode,
'taxno'=>$model->taxno,
'currencyid'=>$model->currencyid,
'currencyname'=>($model->currency!==null)?$model->currency->currencyname:"",
'faxno'=>$model->faxno,
'phoneno'=>$model->phoneno,
'webaddress'=>$model->webaddress,
'email'=>$model->email,
'leftlogofile'=>$model->leftlogofile,
'rightlogofile'=>$model->rightlogofile,
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
		$this->DeleteLockCloseForm($this->menuname, $_POST['Company'], $_POST['Company']['companyid']);
  }  
		
	public function actionWrite()
	{
	  if(isset($_POST['Company']))
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
					
					if ((int)$_POST['Company']['companyid'] > 0)
					{
						$sql = 'call UpdateCompany(:vid,:vcompanyname,:vaddress,:vcity,:vzipcode,:vtaxno,:vcurrencyid,:vfaxno,:vphoneno,:vwebaddress,:vemail,:vleftlogofile,:vrightlogofile,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$_POST['Company']['companyid'],PDO::PARAM_STR);
					}
					else
					{
						$sql = 'call InsertCompany(:vcompanyname,:vaddress,:vcity,:vzipcode,:vtaxno,:vcurrencyid,:vfaxno,:vphoneno,:vwebaddress,:vemail,:vleftlogofile,:vrightlogofile,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
					}
					$command->bindvalue(':vcompanyname',$_POST['Company']['companyname'],PDO::PARAM_STR);
$command->bindvalue(':vaddress',$_POST['Company']['address'],PDO::PARAM_STR);
$command->bindvalue(':vcity',$_POST['Company']['city'],PDO::PARAM_STR);
$command->bindvalue(':vzipcode',$_POST['Company']['zipcode'],PDO::PARAM_STR);
$command->bindvalue(':vtaxno',$_POST['Company']['taxno'],PDO::PARAM_STR);
$command->bindvalue(':vcurrencyid',$_POST['Company']['currencyid'],PDO::PARAM_STR);
$command->bindvalue(':vfaxno',$_POST['Company']['faxno'],PDO::PARAM_STR);
$command->bindvalue(':vphoneno',$_POST['Company']['phoneno'],PDO::PARAM_STR);
$command->bindvalue(':vwebaddress',$_POST['Company']['webaddress'],PDO::PARAM_STR);
$command->bindvalue(':vemail',$_POST['Company']['email'],PDO::PARAM_STR);
$command->bindvalue(':vleftlogofile',$_POST['Company']['leftlogofile'],PDO::PARAM_STR);
$command->bindvalue(':vrightlogofile',$_POST['Company']['rightlogofile'],PDO::PARAM_STR);
$command->bindvalue(':vrecordstatus',$_POST['Company']['recordstatus'],PDO::PARAM_STR);
					$command->bindvalue(':vcreatedby', Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
					$transaction->commit();
					$this->DeleteLock($this->menuname, $_POST['Company']['companyid']);
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
				$sql = 'call Deletecompany(:vid,:vcreatedby)';
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
				$sql = 'call Purgecompany(:vid,:vcreatedby)';
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
		  
		 $model=new Company('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Company']))
		  $model->attributes=$_GET['Company'];
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
	  $sql = "select companyname,address,city,zipcode,taxno,currencyid,faxno,phoneno,webaddress,email,recordstatus				from Company a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.companyid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		//masukkan judul
		$this->pdf->title='Company List';
		$this->pdf->AddPage('L');
		//masukkan posisi judul
		$this->pdf->colalign = array('C','C','C','C','C','C','C','C','C','C','C');
		//masukkan colom judul
		$this->pdf->colheader = array('Company','Address','City','Zip Code','Tax No','Currency','Fax No','Phone No','Web Address','Email');
		$this->pdf->setwidths(array(40,40,40,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,40));
		$this->pdf->Rowheader();
		$this->pdf->coldetailalign = array('L','L','L','L','L','L','L','L','L','L','L','L','L','L','L','L','L','L','L','L');
		
		foreach($dataReader as $row1)
		{
			//masukkan baris untuk cetak
		  $this->pdf->row(array($row1['companyname'],$row1['address'],$row1['city'],$row1['zipcode'],$row1['taxno'],$row1['currencyid'],$row1['faxno'],$row1['phoneno'],$row1['webaddress'],$row1['email']));
		}
		// me-render ke browser
		$this->pdf->Output();
	}
	
	public function actionDownExcel()
	{
		parent::actionDownload();
		$sql = "select companyname,address,city,zipcode,taxno,currencyid,faxno,phoneno,webaddress,email,leftlogofile,rightlogofile,recordstatus				from Company a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.companyid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		 $excel=Yii::createComponent('application.extensions.PHPExcel.PHPExcel');
		 $i=1;
		$excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0,1,'companyname')
					->setCellValueByColumnAndRow(1,1,'address')
					->setCellValueByColumnAndRow(2,1,'city')
					->setCellValueByColumnAndRow(3,1,'zipcode')
					->setCellValueByColumnAndRow(4,1,'taxno')
					->setCellValueByColumnAndRow(5,1,'currencyid')
					->setCellValueByColumnAndRow(6,1,'faxno')
					->setCellValueByColumnAndRow(7,1,'phoneno')
					->setCellValueByColumnAndRow(8,1,'webaddress')
					;
		foreach($dataReader as $row1)
		{
					 $excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0,$i+1,$row1['companyname'])
					->setCellValueByColumnAndRow(1,$i+1,$row1['address'])
					->setCellValueByColumnAndRow(2,$i+1,$row1['city'])
					->setCellValueByColumnAndRow(3,$i+1,$row1['zipcode'])
					->setCellValueByColumnAndRow(4,$i+1,$row1['taxno'])
					->setCellValueByColumnAndRow(5,$i+1,$row1['currencyid'])
					->setCellValueByColumnAndRow(6,$i+1,$row1['faxno'])
					->setCellValueByColumnAndRow(7,$i+1,$row1['phoneno'])
					->setCellValueByColumnAndRow(8,$i+1,$row1['webaddress'])
					;
		$i+=1;
		}
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="company.xlsx"');
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
												$sql = 'call UploadCompany(:vid,:vcompanyname,:vaddress,:vcity,:vzipcode,:vtaxno,:vcurrencyid,:vfaxno,:vphoneno,:vwebaddress,:vemail,:vleftlogofile,:vrightlogofile,:vrecordstatus,:vcreatedby)';
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