<?php

class DefaultController extends Controller
{
	protected $menuname = 'article';
	public function actionIndex()
	{
		$model = Article::model()->findbypk($id);
		$this->render('index',array('model'=>$model));
	}
}