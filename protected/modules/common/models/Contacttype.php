<?php

/**
 * This is the model class for table "contacttype".
 *
 * The followings are the available columns in table 'contacttype':
 * @property integer $contacttypeid
 * @property string $contacttypename
 * @property integer $recordstatus
 */
class Contacttype extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'contacttype';
	}

	public function rules()
	{
		return array(
			array('contacttypename, recordstatus', 'required'),
			array('recordstatus', 'numerical', 'integerOnly'=>true),
			array('contacttypename', 'length', 'max'=>50),
			array('contacttypeid, contacttypename, recordstatus', 'safe', 'on'=>'search'),
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
			'contacttypeid' => Catalogsys::model()->getCatalog('contacttypeid'),
			'contacttypename' => Catalogsys::model()->getCatalog('contacttypename'),
			'recordstatus' => Catalogsys::model()->getCatalog('recordstatus'),
		);
	}
	
	private function comparedb($criteria)
	{
				if (isset($_GET['contacttypeid']))
		{
			$criteria->compare('contacttypeid',$_GET['contacttypeid'],true);
		}
		if (isset($_GET['contacttypename']))
		{
			$criteria->compare('contacttypename',$_GET['contacttypename'],true);
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
		$criteria->compare('contacttypeid',$this->contacttypeid);
		$criteria->compare('contacttypename',$this->contacttypename,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'contacttypeid desc', 
    ),
		));
	}
	
		public function searchwstatus()
	{
		$criteria=new CDbCriteria;
		$criteria->condition='recordstatus=1';
		$this->comparedb($criteria);
		$criteria->compare('contacttypeid',$this->contacttypeid);
		$criteria->compare('contacttypename',$this->contacttypename,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'contacttypeid desc', 
    ),
		));
	}
	
	}