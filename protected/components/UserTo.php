<?php
Yii::import('zii.widgets.CPortlet');
class UserTo extends CPortlet
{
	protected function renderContent()
	{
		$a = Yii::app()->user->name;
	
		$model=new Usertodo('search');
		if(isset($_GET['Usertodo']))
			$model->attributes=$_GET['Usertodo'];
		if (isset($_GET['pageSize']))
		{
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
		}
		$this->render('UserTo',array(
			'model'=>$model
		));
	}
}