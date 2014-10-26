<?php

/**
 * This is the model class for table "modules".
 *
 * The followings are the available columns in table 'modules':
 * @property integer $moduleid
 * @property string $modulename
 * @property string $moduleicon
 * @property integer $isinstall
 * @property string $moduledesc
 * @property integer $recordstatus
 */
class Modules extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'modules';
	}

	public function rules()
	{
		return array(
			array('isinstall, recordstatus', 'numerical', 'integerOnly'=>true),
			array('modulename', 'length', 'max'=>30),
			array('moduleicon', 'length', 'max'=>50),
			array('moduledesc', 'length', 'max'=>150),
			array('moduleid, modulename, moduleicon, isinstall, moduledesc, recordstatus', 'safe', 'on'=>'search'),
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
			'moduleid' => Catalogsys::model()->getCatalog('moduleid'),
			'modulename' => Catalogsys::model()->getCatalog('modulename'),
			'moduleicon' => Catalogsys::model()->getCatalog('moduleicon'),
			'isinstall' => Catalogsys::model()->getCatalog('isinstall'),
			'moduledesc' => Catalogsys::model()->getCatalog('moduledesc'),
			'recordstatus' => Catalogsys::model()->getCatalog('recordstatus'),
		);
	}
	
	private function comparedb($criteria)
	{
				if (isset($_GET['moduleid']))
		{
			$criteria->compare('moduleid',$_GET['moduleid'],true);
		}
		if (isset($_GET['modulename']))
		{
			$criteria->compare('modulename',$_GET['modulename'],true);
		}
		if (isset($_GET['moduleicon']))
		{
			$criteria->compare('moduleicon',$_GET['moduleicon'],true);
		}
		if (isset($_GET['isinstall']))
		{
			$criteria->compare('isinstall',$_GET['isinstall'],true);
		}
		if (isset($_GET['moduledesc']))
		{
			$criteria->compare('moduledesc',$_GET['moduledesc'],true);
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
		$criteria->compare('moduleid',$this->moduleid);
		$criteria->compare('modulename',$this->modulename,true);
		$criteria->compare('moduleicon',$this->moduleicon,true);
		$criteria->compare('isinstall',$this->isinstall);
		$criteria->compare('moduledesc',$this->moduledesc,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 't.moduleid desc', 
    ),
		));
	}
	
		public function searchwstatus()
	{
		$criteria=new CDbCriteria;
		$criteria->condition='recordstatus=1';
				$this->comparedb($criteria);
		$criteria->compare('moduleid',$this->moduleid);
		$criteria->compare('modulename',$this->modulename,true);
		$criteria->compare('moduleicon',$this->moduleicon,true);
		$criteria->compare('isinstall',$this->isinstall);
		$criteria->compare('moduledesc',$this->moduledesc,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 't.moduleid desc', 
    ),
		));
	}
	
	}