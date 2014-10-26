<?php
class LogoutController extends Controller
{
	public $layout = '//layouts/column1';
	public function actionIndex()
	{
		$useraccess = Useraccess::model()->findbyattributes(array('username'=>Yii::app()->user->id));
		if ($useraccess !== null) {
		$useraccess->isonline = 0;
		$useraccess->save();
		}
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}