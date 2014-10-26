<?php
class SiteController extends Controller
{
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
		if (Yii::app()->user->id !== null)
		{
			$user = Useraccess::model()->findbyattributes(array('username'=>Yii::app()->user->id));
			if ($user !== null)
			{
				Yii::app()->theme = $user->theme->themename;
			}
		}
		else
		{
			$user = Useraccess::model()->findbyattributes(array('username'=>'guest'));
			if ($user !== null)
			{
				Yii::app()->theme = $user->theme->themename;
			}
		}
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	}
	
	public function actionAbout()
	{
		$this->render('about');
	}
	
	public function actionSignUp()
	{
		$this->layout = '//layouts/column1';
		$model=new SignUpForm;
		if(isset($_POST['ajax']) && $_POST['ajax']==='signup-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['SignUpForm']))
		{
			$model->attributes=$_POST['SignUpForm'];
			if ($model->signup())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		$this->render('signup',array('model'=>$model));
	}
	
	public function actionWritechat()
	{
		$connection=Yii::app()->db;
		$transaction=$connection->beginTransaction();
		$id=count($_POST['Userinbox']);
		try
		{
			if ($id > 2)
			{
				for ($x=0; $x<=$id; $x++)
				{
					$sql = 'call InsertChat(:vusername,:vuserfrom,:vmessages)';
					$command=$connection->createCommand($sql);
					$command->bindvalue(':vusername',$_POST['Userinbox']['username'][$x],PDO::PARAM_STR);
					$command->bindvalue(':vuserfrom',Yii::app()->user->id,PDO::PARAM_STR);
					$command->bindvalue(':vmessages',$_POST['Userinbox']['usermessages'],PDO::PARAM_STR);
					$command->execute();
				}
			}
			else
			{
				$sql = 'call InsertChat(:vusername,:vuserfrom,:vmessages)';
					$command=$connection->createCommand($sql);
					$command->bindvalue(':vusername',$_POST['Userinbox']['username'][0],PDO::PARAM_STR);
					$command->bindvalue(':vuserfrom',Yii::app()->user->id,PDO::PARAM_STR);
					$command->bindvalue(':vmessages',$_POST['Userinbox']['usermessages'],PDO::PARAM_STR);
					$command->execute();
			}
			$transaction->commit();
			$this->GetSMessage('insertsuccess');
		}
		catch (Exception $e)
		{
			$transaction->rollBack();
			$this->GetMessage($e->getMessage());
		}
	}
	
	public function actionChangeRealname()
	{
			$model = Useraccess::model()->findbypk($_POST['pk']);
			$model->realname = $_POST['value'];
			$model->save();
	}
	
		public function actionChangeemail()
	{
			$model = Useraccess::model()->findbypk($_POST['pk']);
			$model->email = $_POST['value'];
			$model->save();
	}
	
	public function actionChangepass()
	{
			$model = Useraccess::model()->findbypk($_POST['pk']);
			$model->password = $model->hashPassword($_POST['value']);
			$model->save();
	}
	
		public function actionChangephoneno()
	{
			$model = Useraccess::model()->findbypk($_POST['pk']);
			$model->phoneno = $_POST['value'];
			$model->save();
	}
	
		public function actionChangethemes()
	{
			$model = Useraccess::model()->findbypk($_POST['pk']);
			$model->themeid = $_POST['value'];
			$model->save();
			 $this->redirect(Yii::app()->user->returnUrl);
	}
}