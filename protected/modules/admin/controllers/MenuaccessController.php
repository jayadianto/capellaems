<?php

class MenuaccessController extends Controller
{
	protected $menuname = 'menuaccess';
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
			$model=Menuaccess::model()->findByPk((int)$id[0]);
			if ($model != null)
				{
					if ($this->CheckDataLock($this->menuname, $id[0]) == false)
					{
						$this->InsertLock($this->menuname, $id[0]);
						echo CJSON::encode(array(
								'status'=>'success',
								'menuaccessid'=>$model->menuaccessid,
'menuname'=>$model->menuname,
'description'=>$model->description,
'menuurl'=>$model->menuurl,
'menuicon'=>$model->menuicon,
'parentid'=>$model->parentid,
'parentname'=>($model->menuparent!==null)?$model->menuparent->description:"",
'moduleid'=>$model->moduleid,
'modulename'=>($model->module!==null)?$model->module->moduledesc:"",
'sortorder'=>$model->sortorder,
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
		$this->DeleteLockCloseForm($this->menuname, $_POST['Menuaccess'], $_POST['Menuaccess']['menuaccessid']);
  }  
		
	public function actionWrite()
	{
	  if(isset($_POST['Menuaccess']))
	  {
			$messages = $this->ValidateData(
							array(
							//masukkan validasi, seperti contoh dibawah
							array($_POST['Menuaccess']['menuname'],'emptymenuname','emptystring'),
							array($_POST['Menuaccess']['description'],'emptydescription','emptystring'),
							array($_POST['Menuaccess']['menuurl'],'emptymenuurl','emptystring'),
							array($_POST['Menuaccess']['moduleid'],'emptymodulename','emptystring'),
					)
			);
			if ($messages == '') 
			{
				$connection=Yii::app()->db;
				$transaction=$connection->beginTransaction();
				try
				{
					
					if ((int)$_POST['Menuaccess']['menuaccessid'] > 0)
					{
						$sql = 'call UpdateMenuaccess(:vid,:vmenuname,:vdescription,:vmenuurl,:vmenuicon,:vparentid,:vmoduleid,:vsortorder,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$_POST['Menuaccess']['menuaccessid'],PDO::PARAM_STR);
					}
					else
					{
						$sql = 'call InsertMenuaccess(:vmenuname,:vdescription,:vmenuurl,:vmenuicon,:vparentid,:vmoduleid,:vsortorder,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
					}
					$command->bindvalue(':vmenuname',$_POST['Menuaccess']['menuname'],PDO::PARAM_STR);
$command->bindvalue(':vdescription',$_POST['Menuaccess']['description'],PDO::PARAM_STR);
$command->bindvalue(':vmenuurl',$_POST['Menuaccess']['menuurl'],PDO::PARAM_STR);
$command->bindvalue(':vmenuicon',$_POST['Menuaccess']['menuicon'],PDO::PARAM_STR);
$command->bindvalue(':vparentid',$_POST['Menuaccess']['parentid'],PDO::PARAM_STR);
$command->bindvalue(':vmoduleid',$_POST['Menuaccess']['moduleid'],PDO::PARAM_STR);
$command->bindvalue(':vsortorder',$_POST['Menuaccess']['sortorder'],PDO::PARAM_STR);
$command->bindvalue(':vrecordstatus',$_POST['Menuaccess']['recordstatus'],PDO::PARAM_STR);
					$command->bindvalue(':vcreatedby', Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
					$transaction->commit();
					$this->DeleteLock($this->menuname, $_POST['Menuaccess']['menuaccessid']);
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
				$sql = 'call Deletemenuaccess(:vid,:vcreatedby)';
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
				$sql = 'call Purgemenuaccess(:vid,:vcreatedby)';
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
		  
		 $model=new Menuaccess('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Menuaccess']))
		  $model->attributes=$_GET['Menuaccess'];
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
	  $sql = "select menuname,description,menuurl				from Menuaccess a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.menuaccessid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		//masukkan judul
		$this->pdf->title='Menuaccess List';
		$this->pdf->AddPage('P');
		//masukkan posisi judul
		$this->pdf->colalign = array('C','C','C','C');
		//masukkan colom judul
		$this->pdf->colheader = array('Menu Name','Description','Url');
		$this->pdf->setwidths(array(60,90,30));
		$this->pdf->Rowheader();
		$this->pdf->coldetailalign = array('L','L','L');
		
		foreach($dataReader as $row1)
		{
			//masukkan baris untuk cetak
		  $this->pdf->row(array($row1['menuname'],$row1['description'],$row1['menuurl']));
		}
		// me-render ke browser
		$this->pdf->Output();
	}
	
	public function actionDownExcel()
	{
		parent::actionDownload();
		$sql = "select menuname,description,menuurl				from Menuaccess a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.menuaccessid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		 $excel=Yii::createComponent('application.extensions.PHPExcel.PHPExcel');
		$i=1;
		$excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0,1,'Menu Name')
					->setCellValueByColumnAndRow(1,1,'Description')
					->setCellValueByColumnAndRow(2,1,'Url');
		foreach($dataReader as $row1)
		{
			  $excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0, $i+1, $row1['menuname'])
					->setCellValueByColumnAndRow(0, $i+1, $row1['description'])
					->setCellValueByColumnAndRow(0, $i+1, $row1['menuurl']);
		$i+=1;
		}
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Menuaccess.xlsx"');
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
												$sql = 'call UploadMenuaccess(:vid,:vmenuname,:vdescription,:vmenuurl,:vmenuicon,:vparentid,:vmoduleid,:vsortorder,:vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$data[0],PDO::PARAM_STR);
						$command->bindvalue(':vmenuname',$data[1],PDO::PARAM_STR);
$command->bindvalue(':vdescription',$data[2],PDO::PARAM_STR);
$command->bindvalue(':vmenuurl',$data[3],PDO::PARAM_STR);
$command->bindvalue(':vmenuicon',$data[4],PDO::PARAM_STR);
$command->bindvalue(':vparentid',$data[5],PDO::PARAM_STR);
$command->bindvalue(':vmoduleid',$data[6],PDO::PARAM_STR);
$command->bindvalue(':vsortorder',$data[7],PDO::PARAM_STR);
$command->bindvalue(':vrecordstatus',$data[8],PDO::PARAM_STR);
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