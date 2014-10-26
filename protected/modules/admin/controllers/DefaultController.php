<?php

class DefaultController extends Controller
{
	public $menuname = 'admin';
	public $layout = '//layouts/columnadmin';
	public function actionIndex()
	{
		parent::actionIndex();
				if (Yii::app()->user->id !== null)
		{
			$user = Useraccess::model()->findbyattributes(array('username'=>Yii::app()->user->id));
			if ($user !== null)
			{
				Yii::app()->theme = $user->theme->themename;
			}
		}

		$modules=new CActiveDataProvider('Menuaccess', array(
			'criteria'=>array(
					'condition'=>'t.parentid in (select menuaccessid from menuaccess where menuname = "'.$this->menuname.'") 
						and t.menuaccessid in (select a.menuaccessid from groupmenu a 
							inner join usergroup b on b.groupaccessid = a.groupaccessid 
							inner join useraccess c on c.useraccessid = b.useraccessid where c.username = "'.Yii::app()->user->id.'") and t.recordstatus = 1 ',
				'order' => 'sortorder ASC'
			),
			'countCriteria'=>array(
					'condition'=>'t.parentid in (select menuaccessid from menuaccess where menuname = "'.$this->menuname.'") 
						and t.menuaccessid in (select a.menuaccessid from groupmenu a 
							inner join usergroup b on b.groupaccessid = a.groupaccessid 
							inner join useraccess c on c.useraccessid = b.useraccessid where c.username = "'.Yii::app()->user->id.'") and t.recordstatus = 1 ',
			),
			'pagination'=>array(
					'pageSize'=>99,
			),
		));
		$this->render('index',array('modules'=>$modules));
	}
}