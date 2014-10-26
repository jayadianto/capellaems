<?php
class SiteController extends Controller
{
	public $layout = '/column1';
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionIndex()
	{
		$this->layout = '//layouts/columninstall';
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
		$this->render('install/index',array('modules'=>$modules));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	}

	public function actionLogin()
	{
		$this->layout = '//layouts/column1';
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
			  $this->redirect(Yii::app()->user->returnUrl);
			} 
		}
		$this->render('login',array('model'=>$model));
	}

	public function actionLogout()
	{
		$useraccess = Useraccess::model()->findbyattributes(array('username'=>Yii::app()->user->id));
		if ($useraccess !== null) {
		$useraccess->isonline = 0;
		$useraccess->save();
		}
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionAbout()
	{
		$this->render('about');
	}
}