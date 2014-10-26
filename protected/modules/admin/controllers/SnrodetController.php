<?php

class SnrodetController extends Controller
{
	protected $menuname = 'snrodet';
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
			$model=Snrodet::model()->findByPk((int)$id[0]);
			if ($model != null)
				{
					if ($this->CheckDataLock($this->menuname, $id[0]) == false)
					{
						$this->InsertLock($this->menuname, $id[0]);
						echo CJSON::encode(array(
								'status'=>'success',
								'snrodid'=>$model->snrodid,
'snroid'=>$model->snroid,
'curdd'=>$model->curdd,
'curmm'=>$model->curmm,
'curyy'=>$model->curyy,
'curvalue'=>$model->curvalue,
'curcc'=>$model->curcc,
'curpt'=>$model->curpt,
'curpp'=>$model->curpp,
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
		$this->DeleteLockCloseForm($this->menuname, $_POST['Snrodet'], $_POST['Snrodet']['snrodid']);
  }  
		
	public function actionWrite()
	{
	  if(isset($_POST['Snrodet']))
	  {
			$messages = $this->ValidateData(
							array(
							//masukkan validasi, seperti contoh dibawah
							array($_POST['Snrodet']['curdd'],'emptycurdd','emptystring'),
							array($_POST['Snrodet']['curdd'],'emptycurmm','emptystring'),
							array($_POST['Snrodet']['curdd'],'emptycuryy','emptystring'),
							array($_POST['Snrodet']['curdd'],'emptycurvalue','emptystring'),
					)
			);
			if ($messages == '') 
			{
				$connection=Yii::app()->db;
				$transaction=$connection->beginTransaction();
				try
				{
					
					if ((int)$_POST['Snrodet']['snrodid'] > 0)
					{
						$sql = 'call UpdateSnrodet(:vid,:vsnroid,:vcurdd,:vcurmm,:vcuryy,:vcurvalue,:vcurcc,:vcurpt,:vcurpp,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$_POST['Snrodet']['snrodid'],PDO::PARAM_STR);
					}
					else
					{
						$sql = 'call InsertSnrodet(:vsnroid,:vcurdd,:vcurmm,:vcuryy,:vcurvalue,:vcurcc,:vcurpt,:vcurpp,:vcreatedby)';
						$command=$connection->createCommand($sql);
					}
					$command->bindvalue(':vsnroid',$_POST['Snrodet']['snroid'],PDO::PARAM_STR);
$command->bindvalue(':vcurdd',$_POST['Snrodet']['curdd'],PDO::PARAM_STR);
$command->bindvalue(':vcurmm',$_POST['Snrodet']['curmm'],PDO::PARAM_STR);
$command->bindvalue(':vcuryy',$_POST['Snrodet']['curyy'],PDO::PARAM_STR);
$command->bindvalue(':vcurvalue',$_POST['Snrodet']['curvalue'],PDO::PARAM_STR);
$command->bindvalue(':vcurcc',$_POST['Snrodet']['curcc'],PDO::PARAM_STR);
$command->bindvalue(':vcurpt',$_POST['Snrodet']['curpt'],PDO::PARAM_STR);
$command->bindvalue(':vcurpp',$_POST['Snrodet']['curpp'],PDO::PARAM_STR);
					$command->bindvalue(':vcreatedby', Yii::app()->user->name,PDO::PARAM_STR);
					$command->execute();
					$transaction->commit();
					$this->DeleteLock($this->menuname, $_POST['Snrodet']['snrodid']);
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
				$sql = 'call Deletesnrodet(:vid,:vcreatedby)';
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
				$sql = 'call Purgesnrodet(:vid,:vcreatedby)';
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
		  
		 $model=new Snrodet('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Snrodet']))
		  $model->attributes=$_GET['Snrodet'];
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
	  $sql = "select description,curdd,curmm,curyy,curvalue,curcc,curpt,curpp				
			from Snrodet a
			inner join snro b on b.snroid = a.snroid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.snrodid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		//masukkan judul
		$this->pdf->title='SNRO Detail List';
		$this->pdf->AddPage('P');
		//masukkan posisi judul
		$this->pdf->colalign = array('C','C','C','C','C');
		//masukkan colom judul
		$this->pdf->colheader = array('SNRO','Date','Month','Year','Value');
		$this->pdf->setwidths(array(60,20,20,20,20,20,20));
		$this->pdf->Rowheader();
		$this->pdf->coldetailalign = array('L','L','L','L','L');
		
		foreach($dataReader as $row1)
		{
			//masukkan baris untuk cetak
		  $this->pdf->row(array($row1['description'],$row1['curdd'],$row1['curmm'],$row1['curyy'],$row1['curvalue']));
		}
		// me-render ke browser
		$this->pdf->Output();
	}
	
	public function actionDownExcel()
	{
		parent::actionDownload();
		$sql = "select description,curdd,curmm,curyy,curvalue,curcc,curpt,curpp				
			from Snrodet a
			inner join snro b on b.snroid = a.snroid ";
		if ($_GET['id'] !== '') {
				$sql = $sql . "where a.snrodid in (".$_GET['id'].")";
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();
		 $excel=Yii::createComponent('application.extensions.PHPExcel.PHPExcel');
		$i=1;
		$excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0,1,'Description')
					->setCellValueByColumnAndRow(1,1,'Date')
					->setCellValueByColumnAndRow(2,1,'Month')
					->setCellValueByColumnAndRow(3,1,'Year')
					->setCellValueByColumnAndRow(4,1,'Value');
		foreach($dataReader as $row1)
		{
			  $excel->setActiveSheetIndex(0)
					->setCellValueByColumnAndRow(0, $i+1, $row1['description'])
					->setCellValueByColumnAndRow(1, $i+1, $row1['curdd'])
					->setCellValueByColumnAndRow(2, $i+1, $row1['curmm'])
					->setCellValueByColumnAndRow(3, $i+1, $row1['curyy'])
					->setCellValueByColumnAndRow(4, $i+1, $row1['curvalue']);
		$i+=1;
		}
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Snrodet.xlsx"');
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
												$sql = 'call UploadSnrodet(:vid,:vsnroid,:vcurdd,:vcurmm,:vcuryy,:vcurvalue,:vcurcc,:vcurpt,:vcurpp,:vcreatedby)';
						$command=$connection->createCommand($sql);
						$command->bindvalue(':vid',$data[0],PDO::PARAM_STR);
						$command->bindvalue(':vsnroid',$data[1],PDO::PARAM_STR);
$command->bindvalue(':vcurdd',$data[2],PDO::PARAM_STR);
$command->bindvalue(':vcurmm',$data[3],PDO::PARAM_STR);
$command->bindvalue(':vcuryy',$data[4],PDO::PARAM_STR);
$command->bindvalue(':vcurvalue',$data[5],PDO::PARAM_STR);
$command->bindvalue(':vcurcc',$data[6],PDO::PARAM_STR);
$command->bindvalue(':vcurpt',$data[7],PDO::PARAM_STR);
$command->bindvalue(':vcurpp',$data[8],PDO::PARAM_STR);
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