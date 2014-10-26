<?php
Yii::import('zii.widgets.CPortlet');
class UserInfo extends CPortlet
{
    protected function renderContent()
    {
			$model=Useraccess::model()->findbyattributes(array('username'=>Yii::app()->user->name));
				   $this->render('UserInfo',array('model'=>$model));
    }
}