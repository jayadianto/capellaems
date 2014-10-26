<?php
require_once(dirname(__FILE__).'createdbadmin.php')
class DefaultController extends Controller
{
	public $layout = '//layouts/columninstall';
	public $tableadministration = array(
		'language',
		'useraccess',
		'groupaccess',
		'usergroup',
		'menuaccess',
		'groupmenu',
		'menuauth',
		'groupmenuauth',
		'country',
		'province',
		'city',
		'company',
		'parameter',
		'snro',
		'snrodet',
		'workflow',
		'wfgroup',
		'wfstatus',
		'catalogsys'
	);
	public $createadministration = array(
	);

	public function actionIndex()
	{
		$modules=new CActiveDataProvider('Modules', array(
			'criteria'=>array(
					'condition'=>'isinstall=0',
			),
			'countCriteria'=>array(
					'condition'=>'isinstall=1',
					// 'order' and 'with' clauses have no meaning for the count query
			),
			'pagination'=>array(
					'pageSize'=>99,
			),
		));
		$this->render('index',array('modules'=>$modules));
	}
	
	public function InstallAdministration()
	{
		//proses install modul
		//cek dependensi modul
		//create tableadministration
		//copy file dibawah administration 
		return true;
	}
	
	public function UnInstallAdministration()
	{
		//proses install modul
		//cek dependensi modul
		//drop tabel administrasi
		//delete file dibawah administration
		return true;
	}

	public function actionInstallModul()
	{
		if (isset($_POST['id']) && isset($_POST['text'.$_POST['id']]))
		{
			$id = $_POST['id'];
			$text = $_POST['text'.$id];
			$hasil = false;
			if (strtolower($text) == 'install')
			{
				if ($id == 'administration')
				{	
					$hasil = $this->InstallAdministration();
				}
				if ($hasil == true)
				{
					$id = 'Proses Pemasangan Modul '.$id.' Berhasil';
					$text = 'Uninstall';
				}
			}
			else
			{
				//proses uninstall modul
				//cek dependensi modul
				if ($id == 'administration')
				{	
					$hasil = $this->UnInstallAdministration();
					{
					}
				}
				if ($hasil == true)
				{
					$id = 'Proses Pembuangan Modul '.$id.' Berhasil';
					$text = 'Install';
				}
			}
			if (Yii::app()->request->isAjaxRequest)
			{
				echo CJSON::encode(array(
					'status'=>'success',
					'div'=> $id,
					'text'=>$text
					));
				Yii::app()->end();
			}	
		}
		else
		{
			echo CJSON::encode(array(
				'status'=>'failure',
				'div'=> 'Pilih salah satu modul yang akan di Install/UnInstall',
				'text'=>'Install'
				));
			Yii::app()->end();
		}
	}
}