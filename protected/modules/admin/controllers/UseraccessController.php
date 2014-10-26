<?php

class UseraccessController extends Controller
{
	protected $menuname = 'useraccess';
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
			$model=Useraccess::model()->findByPk((int)$id[0]);
			if ($model != null)
				{
					if ($this->CheckDataLock($this->menuname, $id[0]) == false)
					{
						$this->InsertLock($this->menuname, $id[0]);
						echo CJSON::encode(array(
								'status'=>'success',
								'useraccessid'=>$model->useraccessid,
'username'=>$model->username,
'realname'=>$model->realname,
'password'=>$model->password,
'email'=>$model->email,
'phoneno'=>$model->phoneno,
'languageid'=>$model->languageid,
'languagename'=>($model->language!==null)?$model->language->languagename:"",
'themeid'=>$model->themeid,
'themename'=>($model->theme!==null)?$model->theme->themename:"",
'isonline'=>$model->isonline,
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
		$this->DeleteLockCloseForm($this->menuname, $_POST['Useraccess'], $_POST['Useraccess']['useraccessid']);
  }  
		
	public function actionWrite()
	{
	  if(isset($_POST['Useraccess']))
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
					
					if ((int)$_POST['Useraccess']['useraccessid'] > 0)
					{
						$sql = 'call UpdateUseraccess(:vid,:vusername,:vrealname,:vpassword,:vemail,:vphoneno,:vlanguageid,:vthemeid,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$_POST['Useraccess']['useraccessid'],PDO::PARAM_STR);
					}
					else
					{
						$sql = 'call InsertUseraccess(:vusername,:vrealname,:vpassword,:vemail,:vphoneno,:vlanguageid,:vthemeid,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
					}
					$command->bindvalue(':vusername',$_POST['Useraccess']['username'],PDO::PARAM_STR);
$command->bindvalue(':vrealname',$_POST['Useraccess']['realname'],PDO::PARAM_STR);
$command->bindvalue(':vpassword',Useraccess::model()->hashPassword($_POST['Useraccess']['password']),PDO::PARAM_STR);
$command->bindvalue(':vemail',$_POST['Useraccess']['email'],PDO::PARAM_STR);
$command->bindvalue(':vphoneno',$_POST['Useraccess']['phoneno'],PDO::PARAM_STR);
$command->bindvalue(':vlanguageid',$_POST['Useraccess']['languageid'],PDO::PARAM_STR);
$command->bindvalue(':vthemeid',$_POST['Useraccess']['themeid'],PDO::PARAM_STR);
$command->bindvalue(':vrecordstatus',$_POST['Useraccess']['recordstatus'],PDO::PARAM_STR);
					$command->bindvalue(':vcreatedby', Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
					$transaction->commit();
					$this->DeleteLock($this->menuname, $_POST['Useraccess']['useraccessid']);
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
				$sql = 'call Deleteuseraccess(:vid,:vcreatedby)';
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
				$sql = 'call Purgeuseraccess(:vid,:vcreatedby)';
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
		  
		 $model=new Useraccess('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Useraccess']))
		  $model->attributes=$_GET['Useraccess'];
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
	  $sql = "select username,realname,email,phoneno from Useraccess a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.useraccessid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		//masukkan judul
		$this->pdf->title='Useraccess List';
		$this->pdf->AddPage('P');
		//masukkan posisi judul
		$this->pdf->colalign = array('C','C','C','C');
		//masukkan colom judul
		$this->pdf->colheader = array('User Name','Real Name','Email','Phone No');
		$this->pdf->setwidths(array(50,60,40,30));
		$this->pdf->Rowheader();
		$this->pdf->coldetailalign = array('L','L','L','L');
		
		foreach($dataReader as $row1)
		{
			//masukkan baris untuk cetak
		  $this->pdf->row(array($row1['username'],$row1['realname'],$row1['email'],$row1['phoneno']));
		}
		// me-render ke browser
		$this->pdf->Output();
	}
	
	public function actionDownExcel()
	{
		parent::actionDownload();
		$sql = "select username,realname,email,phoneno from Useraccess a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.useraccessid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		 $excel=Yii::createComponent('application.extensions.PHPExcel.PHPExcel');
		$i=1;
		$excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0,1,'User Name')
					->setCellValueByColumnAndRow(1,1,'Real Name')
					->setCellValueByColumnAndRow(2,1,'Email')
					->setCellValueByColumnAndRow(3,1,'Phone No');
		foreach($dataReader as $row1)
		{
			  $excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0, $i+1, $row1['username'])
					->setCellValueByColumnAndRow(1, $i+1, $row1['realname'])
					->setCellValueByColumnAndRow(2, $i+1, $row1['email'])
					->setCellValueByColumnAndRow(3, $i+1, $row1['phoneno']);
		$i+=1;
		}
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Useraccess.xlsx"');
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
												$sql = 'call UploadUseraccess(:vid,:vusername,:vrealname,:vpassword,:vemail,:vphoneno,:vlanguageid,:vthemeid,:visonline,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$data[0],PDO::PARAM_STR);
						$command->bindvalue(':vusername',$data[1],PDO::PARAM_STR);
$command->bindvalue(':vrealname',$data[2],PDO::PARAM_STR);
$command->bindvalue(':vpassword',$data[3],PDO::PARAM_STR);
$command->bindvalue(':vemail',$data[4],PDO::PARAM_STR);
$command->bindvalue(':vphoneno',$data[5],PDO::PARAM_STR);
$command->bindvalue(':vlanguageid',$data[6],PDO::PARAM_STR);
$command->bindvalue(':vthemeid',$data[7],PDO::PARAM_STR);
$command->bindvalue(':visonline',$data[8],PDO::PARAM_STR);
$command->bindvalue(':vrecordstatus',$data[9],PDO::PARAM_STR);
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