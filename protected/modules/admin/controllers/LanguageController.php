<?php

class LanguageController extends Controller
{
	public $menuname = 'language';
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
			$model=Language::model()->findByPk((int)$id[0]);
			if ($model !== null)
			{
				if ($this->CheckDataLock($this->menuname, $id[0]) == false)
				{
					$this->InsertLock($this->menuname, $id[0]);
					echo CJSON::encode(array(
						'status'=>'success',
						'languageid'=>$model->languageid,
						'languagename'=>$model->languagename,
						'recordstatus'=>$model->recordstatus
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
		$this->DeleteLockCloseForm($this->menuname, $_POST['Language'], $_POST['Language']['languageid']);
	}

	public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Language']))
	  {
			$messages = $this->ValidateData(
							array(array($_POST['Language']['languagename'],'emptylanguagename','emptystring'),
					)
			);
			if ($messages == '') 
			{
				$connection=Yii::app()->db;
				$transaction=$connection->beginTransaction();
				try
				{
					if ((int)$_POST['Language']['languageid'] > 0)
					{
						$sql = 'call UpdateLanguage(:vid,:vlanguagename, :vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$_POST['Language']['languageid'],PDO::PARAM_STR);
					}
					else
					{
						$sql = 'call InsertLanguage(:vlanguagename, :vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
					}
					$command->bindvalue(':vlanguagename',$_POST['Language']['languagename'],PDO::PARAM_STR);
					$command->bindvalue(':vrecordstatus',$_POST['Language']['recordstatus'],PDO::PARAM_STR);
					$command->bindvalue(':vcreatedby', Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
					$transaction->commit();
					$this->DeleteLock($this->menuname, $_POST['Language']['languageid']);
					$this->GetMessage('success','insertsuccess');
				}
				catch (Exception $e)
				{
					$transaction->rollBack();
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
				$sql = 'call DeleteLanguage(:vid,:vcreatedby)';
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
				$sql = 'call PurgeLanguage(:vid,:vcreatedby)';
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
    $model=new Language('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Language']))
			$model->attributes=$_GET['Language'];
    $translog=new Translog('search');
		$translog->unsetAttributes();  // clear any default values
		if(isset($_GET['Translog']))
			$translog->attributes=$_GET['Translog'];
		if (isset($_GET['pageSize']))
	  {
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
			'translog'=>$translog
		));
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
						$sql = 'call UploadLanguage(:vid,:vlanguagename, :vrecordstatus,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$data[0],PDO::PARAM_STR);
						$command->bindvalue(':vlanguagename',$data[1],PDO::PARAM_STR);
						$command->bindvalue(':vrecordstatus',$data[2],PDO::PARAM_STR);
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
	
	public function actionDownPDF()
	{
		parent::actionDownload();
		$sql = "select languagename
				from language a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.languageid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		$this->pdf->title='Language List';
		$this->pdf->AddPage('P');
		
		$this->pdf->colalign = array('C');
		$this->pdf->setwidths(array(90));
		$this->pdf->colheader = array('Language');
		$this->pdf->rowheader();
				
		$this->pdf->coldetailalign = array('L');
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['languagename']));
		}
		// me-render ke browser
		$this->pdf->Output();
	}
	
	public function actionDownExcel()
	{
		parent::actionDownload();
		$sql = "select languagename
				from language a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.languageid in (".$_GET['id'].")";
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
}