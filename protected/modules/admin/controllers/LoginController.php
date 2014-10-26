<?php
class LoginController extends Controller
{
	public $layout = '//layouts/column1';
	public function actionIndex()
	{
		$model=new LoginForm;
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			if($model->validate() && $model->login()) {
			  $useraccess = Useraccess::model()->findbyattributes(array('username'=>Yii::app()->user->id));
				$useraccess->isonline = 1;
			  $useraccess->save();
				Yii::app()->theme = $useraccess->theme->themename;
			  $this->redirect(Yii::app()->user->returnUrl);
			} 
		}
		$this->render('login',array('model'=>$model));
	}
}