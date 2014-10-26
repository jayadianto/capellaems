<?php 
$columns = '';$ncolumns = '';$pcolumns = '';
echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass."\n"; ?>
{
	protected $menuname = '<?php echo $this->controller?>';
	public $layout = '//layouts/columnadmin';
	<?php if ($this->isdetail == 1) { ?>
	public $<?php echo $this->modeldetail ?>;
	public function lookupdata()
	{
		$this-><?php echo $this->modeldetail ?>=new <?php echo $this->modeldetail ?>('search');
		$this-><?php echo $this->modeldetail ?>->unsetAttributes();
		if(isset($_GET['<?php echo $this->modeldetail ?>']))
		$this-><?php echo $this->modeldetail?>->attributes=$_GET['<?php echo $this->modeldetail?>'];
	}
	<?php } ?>
	public function actionCreate()
	{
		parent::actionCreate();
		<?php if ($this->isdetail == 0) { ?>
		$this->GetMessage('success','insertsuccess');
		<?php } else { ?>
		$model=new <?php echo $this->model ?>;
		if (Yii::app()->request->isAjaxRequest)
        {
		  if ($model->save()) {
            echo CJSON::encode(array(
                'status'=>'success',
                '<?php echo $this->getModelID() ?>'=>$model-><?php echo $this->getModelID() ?>,
				));
            Yii::app()->end();
		  }
        }		
		<?php } ?>}
	
	<?php if ($this->isdetail == 1){ ?>
	public function actionCreatedetail()
	{
		parent::actionCreate();
		$<?php echo $this->modeldetail ?>=new <?php echo $this->modeldetail ?>;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				));
            Yii::app()->end();
        }
	}
	<?php } ?>
	public function actionUpdate()
	{
		parent::actionUpdate();
		if (isset($_POST['id']))
		{
			$id=$_POST['id'];
			$model=<?php echo $this->model;?>::model()->findByPk((int)$id[0]);
			if ($model != null)
				{
					if ($this->CheckDataLock($this->menuname, $id[0]) == false)
					{
						$this->InsertLock($this->menuname, $id[0]);
						echo CJSON::encode(array(
								'status'=>'success',
								<?php 
								foreach($this->tableSchema->columns as $column)
								{
									if (stripos($column->dbType,'date')!==false)
									{
										echo "'$column->name'=>(\$model->$column->name!==null)?date(Yii::app()->params['dateviewfromdb'], strtotime(\$model->$column->name)):\"\",\n";
									}
									else
									{
										echo "'$column->name'=>\$model->$column->name,\n";
									}
								}
								?>
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
	<?php if ($this->isdetail == 1){ ?>
	public function actionUpdatedetail()
	{
		parent::actionUpdate();
		$id=$_POST['id'];
		$<?php echo $this->modeldetail ?>=<?php echo $this->modeldetail ?>::model()->findByPk((int)$id[0]);

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
								<?php 
							foreach($this->tableDetailSchema->columns as $column)
							{
								if (stripos($column->dbType,'date')!==false)
								{
									echo "'$column->name'=>(\$$this->modeldetail->$column->name!==null)?date(Yii::app()->params['dateviewfromdb'], strtotime(\$model->$column->name)):\"\",\n";
								}
								else
								{
									echo "'$column->name'=>\$$this->modeldetail->$column->name,\n";
								}
							}
							?>
				));
            Yii::app()->end();
        }
	}
	<?php } ?>
	public function actionCancelWrite()
  {
		$this->DeleteLockCloseForm($this->menuname, $_POST['<?php echo $this->model ?>'], $_POST['<?php echo $this->model ?>']['<?php echo $this->getModelID() ?>']);
  }  
		
	public function actionWrite()
	{
	  if(isset($_POST['<?php echo $this->model ?>']))
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
					<?php 
						foreach($this->tableSchema->columns as $column)
						{
							if($column->autoIncrement)
								continue;
							if ($columns == '') 
							{
								$columns = ':v'.$column->name;
								$ncolumns = $column->name;
								$pcolumns = "\$row1['".$column->name."']";
							}
							else
							{
								$columns .= ',:v'.$column->name;
								$ncolumns .= ','.$column->name;
								$pcolumns .= ",\$row1['".$column->name."']";
							}
						}
						$columns .= ',:vcreatedby';
					?>

					if ((int)$_POST['<?php echo $this->model ?>']['<?php echo $this->getModelID()?>'] > 0)
					{
						$sql = 'call Update<?php echo $this->model ?>(:vid,<?php echo $columns ?>)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$_POST['<?php echo $this->model ?>']['<?php echo $this->getModelID()?>'],PDO::PARAM_STR);
					}
					else
					{
						$sql = 'call Insert<?php echo $this->model ?>(<?php echo $columns ?>)';
						$command=$connection->createCommand($sql);
					}
					<?php foreach($this->tableSchema->columns as $column)
						{
							if($column->autoIncrement)
							{
								continue;
							}
							else
							if (stripos($column->dbType,'date')!==false)
							{
								echo "\$command->bindvalue(':v".$column->name."',date(Yii::app()->params['datetodb'], strtotime(\$_POST['".$this->model."']['".$column->name."'])),PDO::PARAM_STR);\n";
							}
							else
							{
								echo "\$command->bindvalue(':v".$column->name."',\$_POST['".$this->model."']['".$column->name."'],PDO::PARAM_STR);\n";
							}
						}
						?>
					$command->bindvalue(':vcreatedby', Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
					$transaction->commit();
					$this->DeleteLock($this->menuname, $_POST['<?php echo $this->model ?>']['<?php echo $this->getModelID()?>']);
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
	<?php if ($this->isdetail == 1){ ?>
	public function actionWritedetail()
	{
	  if(isset($_POST['<?php echo $this->modeldetail ?>']))
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
					<?php $columns = '';
						foreach($this->tableDetailSchema->columns as $column)
						{
							if($column->autoIncrement)
								continue;
							if ($columns == '') 
							{
								$columns = ':v'.$column->name;
								$ncolumns = $column->name;
								$pcolumns = "\$row1['".$column->name."']";
							}
							else
							{
								$columns .= ',:v'.$column->name;
								$ncolumns .= ','.$column->name;
								$pcolumns .= ",\$row1['".$column->name."']";
							}
						}
						$columns .= ',:vcreatedby';
					?>if ((int)$_POST['<?php echo $this->modeldetail ?>']['<?php echo $this->getModelDetailID()?>'] > 0)
					{
						$sql = 'call Update<?php echo $this->modeldetail ?>(:vid,<?php echo $columns ?>)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$_POST['<?php echo $this->modeldetail ?>']['<?php echo $this->getModelDetailID()?>'],PDO::PARAM_STR);
					}
					else
					{
						$sql = 'call Insert<?php echo $this->modeldetail ?>(<?php echo $columns ?>)';
						$command=$connection->createCommand($sql);
					}
					<?php 
					foreach($this->tableDetailSchema->columns as $column)
						{
							if($column->autoIncrement)
							{
								continue;
							}
							else
							if (stripos($column->dbType,'date')!==false)
							{
								echo "\$command->bindvalue(':v".$column->name."',date(Yii::app()->params['datetodb'], strtotime(\$_POST['".$this->modeldetail."']['".$column->name."'])),PDO::PARAM_STR);\n";
							}
							else
							{
								echo "\$command->bindvalue(':v".$column->name."',\$_POST['".$this->modeldetail."']['".$column->name."'],PDO::PARAM_STR);\n";
							}
						}
						?>
					$command->bindvalue(':vcreatedby', Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
					$transaction->commit();
					$this->DeleteLock($this->menuname, $_POST['<?php echo $this->modeldetail ?>']['<?php echo $this->getModelDetailID()?>']);
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
	<?php } ?>
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
				$sql = 'call Delete<?php echo $this->controller ?>(:vid,:vcreatedby)';
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
				$sql = 'call Purge<?php echo $this->controller ?>(:vid,:vcreatedby)';
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
	<?php if ($this->isdetail == 1) { ?>
	public function actionDeletedetail()
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
				$sql = 'call Delete<?php echo $this->controller ?>Detail(:vid,:vcreatedby)';
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
	<?php } ?>
	
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
		 <?php if ($this->isdetail == 1) { ?>
		 $this->lookupdata();
		 <?php } ?> 
		 $model=new <?php echo $this->model; ?>('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['<?php echo $this->model; ?>']))
		  $model->attributes=$_GET['<?php echo $this->model; ?>'];
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
		 <?php if ($this->isdetail == 1) { ?>
			'<?php echo $this->modeldetail ?>'=>$this-><?php echo $this->modeldetail?>
			<?php } ?>
	  ));
	}

	public function actionDownPDF()
	{
	  parent::actionDownload();
		//masukkan perintah download
	  $sql = "select <?php echo $ncolumns ?>
				from <?php echo $this->model ?> a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.<?php echo $this->getModelID() ?> in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		//masukkan judul
		$this->pdf->title='<?php echo $this->model ?> List';
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
		  $this->pdf->row(array(<?php echo $pcolumns ?>));
		}
		// me-render ke browser
		$this->pdf->Output();
	}
	
	public function actionDownExcel()
	{
		parent::actionDownload();
		$sql = "select <?php echo $ncolumns ?>
				from <?php echo $this->model ?> a ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.<?php echo $this->getModelID() ?> in (".$_GET['id'].")";
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
		header('Content-Disposition: attachment;filename="<?php echo $this->model ?>.xlsx"');
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
						<?php $columns = '';
						foreach($this->tableDetailSchema->columns as $column)
						{
							if($column->autoIncrement)
								continue;
							if ($columns == '') 
							{
								$columns = ':v'.$column->name;
								$ncolumns = $column->name;
								$pcolumns = "\$row1['".$column->name."']";
							}
							else
							{
								$columns .= ',:v'.$column->name;
								$ncolumns .= ','.$column->name;
								$pcolumns .= ",\$row1['".$column->name."']";
							}
						}
						$columns .= ',:vcreatedby';
					?>
						$sql = 'call Upload<?php echo $this->model ?>(:vid,<?php echo $columns ?>)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$data[0],PDO::PARAM_STR);
						<?php $i=1;
					foreach($this->tableDetailSchema->columns as $column)
						{
							if($column->autoIncrement)
							{
								continue;
							}
							else
							if (stripos($column->dbType,'date')!==false)
							{
								echo "\$command->bindvalue(':v".$column->name."',date(Yii::app()->params['datetodb'], strtotime(\$data[".$i."])),PDO::PARAM_STR);\n";
							}
							else
							{
								echo "\$command->bindvalue(':v".$column->name."',\$data[".$i."],PDO::PARAM_STR);\n";
							}
							$i += 1;
						}
						?>
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