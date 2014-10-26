<?php

/**
 * This is the model class for table "language".
 *
 * The followings are the available columns in table 'language':
 * @property integer $languageid
 * @property string $languagename
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Catalogsys[] $catalogsys
 * @property Useraccess[] $useraccesses
 */
class Language extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'language';
	}

	public function rules()
	{
		return array(
			array('recordstatus', 'numerical', 'integerOnly'=>true),
			array('languagename', 'length', 'max'=>30),
			array('languageid, languagename, recordstatus', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'catalogsys' => array(self::HAS_MANY, 'Catalogsys', 'languageid'),
			'useraccesses' => array(self::HAS_MANY, 'Useraccess', 'languageid'),
		);
	}

	public function attributeLabels()
	{	
		return array(
			'languageid' => Catalogsys::model()->getCatalog('languageid'),
			'languagename' => Catalogsys::model()->getCatalog('languagename'),
			'recordstatus' => Catalogsys::model()->getCatalog('recordstatus'),
		);
	}
	
	private function comparedb($criteria)
	{
				if (isset($_GET['languageid']))
		{
			$criteria->compare('languageid',$_GET['languageid'],true);
		}
		if (isset($_GET['languagename']))
		{
			$criteria->compare('languagename',$_GET['languagename'],true);
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
		$criteria->compare('languageid',$this->languageid);
		$criteria->compare('languagename',$this->languagename,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'languageid desc', 
    ),
		));
	}
	
		public function searchwstatus()
	{
		$criteria=new CDbCriteria;
		$criteria->condition='recordstatus=1';
				$this->comparedb($criteria);
		$criteria->compare('languageid',$this->languageid);
		$criteria->compare('languagename',$this->languagename,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'languageid desc', 
    ),
		));
	}
	
	}