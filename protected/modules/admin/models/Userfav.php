<?php

/**
 * This is the model class for table "userfav".
 *
 * The followings are the available columns in table 'userfav':
 * @property integer $userfavid
 * @property integer $useraccessid
 * @property integer $menuaccessid
 */
class Userfav extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'userfav';
	}

	public function rules()
	{
		return array(
			array('useraccessid, menuaccessid', 'required'),
			array('useraccessid, menuaccessid', 'numerical', 'integerOnly'=>true),
			array('userfavid, useraccessid, menuaccessid', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
					'useraccess' => array(self::BELONGS_TO, 'Useraccess', 'useraccessid'),
								'menuaccess' => array(self::BELONGS_TO, 'Menuaccess', 'menuaccessid'),

		);
	}

	public function attributeLabels()
	{	
		return array(
			'userfavid' => Catalogsys::model()->getCatalog('userfavid'),
			'useraccessid' => Catalogsys::model()->getCatalog('useraccess'),
			'menuaccessid' => Catalogsys::model()->getCatalog('menuaccess'),
		);
	}
	
	private function comparedb($criteria)
	{
				if (isset($_GET['userfavid']))
		{
			$criteria->compare('userfavid',$_GET['userfavid'],true);
		}
		if (isset($_GET['useraccessid']))
		{
			$criteria->compare('useraccessid',$_GET['useraccessid'],true);
		}
		if (isset($_GET['menuaccessid']))
		{
			$criteria->compare('menuaccessid',$_GET['menuaccessid'],true);
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
		$criteria->compare('userfavid',$this->userfavid);
		$criteria->compare('useraccessid',$this->useraccessid);
		$criteria->compare('menuaccessid',$this->menuaccessid);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'useraccessid desc', 
    ),
		));
	}
	
	}