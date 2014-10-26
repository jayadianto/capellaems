<?php

/**
 * This is the model class for table "menuauth".
 *
 * The followings are the available columns in table 'menuauth':
 * @property string $menuauthid
 * @property string $menuobject
 * @property integer $recordstatus
 */
class Menuauth extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'menuauth';
	}

	public function rules()
	{
		return array(
			array('menuobject, recordstatus', 'required'),
			array('recordstatus', 'numerical', 'integerOnly'=>true),
			array('menuobject', 'length', 'max'=>50),
			array('menuauthid, menuobject, recordstatus', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{	
		return array(
			'menuauthid' => Catalogsys::model()->getCatalog('menuauthid'),
			'menuobject' => Catalogsys::model()->getCatalog('menuobject'),
			'recordstatus' => Catalogsys::model()->getCatalog('recordstatus'),
		);
	}
	
	private function comparedb($criteria)
	{
				if (isset($_GET['menuauthid']))
		{
			$criteria->compare('menuauthid',$_GET['menuauthid'],true);
		}
		if (isset($_GET['menuobject']))
		{
			$criteria->compare('menuobject',$_GET['menuobject'],true);
		}
		if (isset($_GET['recordstatus']))
		{
			$criteria->compare('recordstatus',$_GET['recordstatus'],true);
		}
		
	}
	
	public function beforeSave()
	{
		//khusus untuk date time
	// $this->field = date(Yii::app()->params['datetodb'], strtotime($this->$field));
		return parent::beforeSave();
	}

	
	public function search()
	{
		$criteria=new CDbCriteria;
		$this->comparedb($criteria);
		$criteria->compare('menuauthid',$this->menuauthid,true);
		$criteria->compare('menuobject',$this->menuobject,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
		public function searchwstatus()
	{
		$criteria=new CDbCriteria;
		$criteria->condition='recordstatus=1';
		$this->comparedb($criteria);
		$criteria->compare('menuauthid',$this->menuauthid,true);
		$criteria->compare('menuobject',$this->menuobject,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	}