<?php

class ProvinceController extends Controller
{
	protected $menuname = 'province';
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
			$model=Province::model()->findByPk((int)$id[0]);
			if ($model != null)
				{
					if ($this->CheckDataLock($this->menuname, $id[0]) == false)
					{
						$this->InsertLock($this->menuname, $id[0]);
						echo CJSON::encode(array(
								'status'=>'success',
								'provinceid'=>$model->provinceid,
'countryid'=>$model->countryid,
'countryname'=>($model->country!==null)?$model->country->countryname:"",
'provincecode'=>$model->provincecode,
'provincename'=>$model->provincename,
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
		$this->DeleteLockCloseForm($this->menuname, $_POST['Province'], $_POST['Province']['provinceid']);
  }  
		
	public function actionWrite()
	{
	  if(isset($_POST['Province']))
	  {
			$messages = $this->ValidateData(
							array(
							//masukkan validasi, seperti contoh dibawah
							array($_POST['Province']['countryid'],'emptycountry','emptystring'),
							array($_POST['Province']['provincecode'],'emptyprovincecode','emptystring'),
							array($_POST['Province']['provincename'],'emptyprovincename','emptystring'),
					)
			);
			if ($messages == '') 
			{
				$connection=Yii::app()->db;
				$transaction=$connection->beginTransaction();
				try
				{
					
					if ((int)$_POST['Province']['provinceid'] > 0)
					{
						$sql = 'call UpdateProvince(:vid,:vcountryid,:vprovincecode,:vprovincename,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$_POST['Province']['provinceid'],PDO::PARAM_STR);
					}
					else
					{
						$sql = 'call InsertProvince(:vcountryid,:vprovincecode,:vprovincename,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
					}
					$command->bindvalue(':vcountryid',$_POST['Province']['countryid'],PDO::PARAM_STR);
$command->bindvalue(':vprovincecode',$_POST['Province']['provincecode'],PDO::PARAM_STR);
$command->bindvalue(':vprovincename',$_POST['Province']['provincename'],PDO::PARAM_STR);
$command->bindvalue(':vrecordstatus',$_POST['Province']['recordstatus'],PDO::PARAM_STR);
					$command->bindvalue(':vcreatedby', Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
					$transaction->commit();
					$this->DeleteLock($this->menuname, $_POST['Province']['provinceid']);
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
				$sql = 'call Deleteprovince(:vid,:vcreatedby)';
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
				$sql = 'call Purgeprovince(:vid,:vcreatedby)';
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
		  
		 $model=new Province('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Province']))
		  $model->attributes=$_GET['Province'];
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
		$sql = "select countryname,provincename
				from province a 
				left join country b on b.countryid = a.countryid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.provinceid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		$this->pdf->title='Province List';
		$this->pdf->AddPage('P');
		$this->pdf->colalign = array('C','C');
		$this->pdf->setwidths(array(70,50));
		$this->pdf->colheader = array('Country Name','Province Name');
		$this->pdf->RowHeader();
		$this->pdf->coldetailalign = array('L','L');
		
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['countryname'],$row1['provincename']));
		}
		// me-render ke browser
		$this->pdf->Output();
	}
	
	public function actionDownExcel()
	{
		parent::actionDownload();
		$sql = "select countryname,provincename
				from province a 
				left join country b on b.countryid = a.countryid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.provinceid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		$i=1;
		 $excel=Yii::createComponent('application.extensions.PHPExcel.PHPExcel');
		 $excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0,1,'Country')
					->setCellValueByColumnAndRow(1,1,'Province');
		foreach($dataReader as $row1)
		{
			  $excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0, $i+1, $row1['countryname'])
					->setCellValueByColumnAndRow(1, $i+1, $row1['provincename']);
		$i+=1;
		}
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="language.xlsx"');
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
												$sql = 'call UploadProvince(:vid,:vcountryid,:vprovincecode,:vprovincename,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$data[0],PDO::PARAM_STR);
						$command->bindvalue(':vcountryid',$data[1],PDO::PARAM_STR);
$command->bindvalue(':vprovincecode',$data[2],PDO::PARAM_STR);
$command->bindvalue(':vprovincename',$data[3],PDO::PARAM_STR);
$command->bindvalue(':vrecordstatus',$data[4],PDO::PARAM_STR);
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