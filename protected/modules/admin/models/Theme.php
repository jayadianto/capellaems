<?php

/**
 * This is the model class for table "theme".
 *
 * The followings are the available columns in table 'theme':
 * @property integer $themeid
 * @property string $themename
 * @property string $description
 * @property integer $recordstatus
 */
class Theme extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'theme';
	}

	public function rules()
	{
		return array(
			array('themename, description', 'required'),
			array('recordstatus', 'numerical', 'integerOnly'=>true),
			array('themename', 'length', 'max'=>20),
			array('description', 'length', 'max'=>50),
			array('themeid, themename, description, recordstatus', 'safe', 'on'=>'search'),
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
			'themeid' => Catalogsys::model()->getCatalog('themeid'),
			'themename' => Catalogsys::model()->getCatalog('themename'),
			'description' => Catalogsys::model()->getCatalog('description'),
			'recordstatus' => Catalogsys::model()->getCatalog('recordstatus'),
			'themeprev' => Catalogsys::model()->getCatalog('themeprev'),
		);
	}
	
	private function comparedb($criteria)
	{
				if (isset($_GET['themeid']))
		{
			$criteria->compare('themeid',$_GET['themeid'],true);
		}
		if (isset($_GET['themename']))
		{
			$criteria->compare('themename',$_GET['themename'],true);
		}
		if (isset($_GET['description']))
		{
			$criteria->compare('description',$_GET['description'],true);
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
		$criteria->compare('themeid',$this->themeid);
		$criteria->compare('themename',$this->themename,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 't.themeid desc', 
    ),
		));
	}
	
		public function searchwstatus()
	{
		$criteria=new CDbCriteria;
		$criteria->condition='recordstatus=1';
		$this->comparedb($criteria);
		$criteria->compare('themeid',$this->themeid);
		$criteria->compare('themename',$this->themename,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 't.themeid desc', 
    ),
		));
	}
	
	}