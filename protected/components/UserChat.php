<?php
Yii::import('zii.widgets.CPortlet');
class UserChat extends CPortlet
{
	protected function renderContent()
	{	
		$model=new Userinbox('search');
		if(isset($_GET['Userinbox']))
			$model->attributes=$_GET['Userinbox'];
		if (isset($_GET['pageSize']))
		{
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
		}
 	
		$this->render('UserChat',array(
			'model'=>$model
		));
	}
}