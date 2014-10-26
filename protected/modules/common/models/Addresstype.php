<?php

/**
 * This is the model class for table "addresstype".
 *
 * The followings are the available columns in table 'addresstype':
 * @property integer $addresstypeid
 * @property string $addresstypename
 * @property integer $recordstatus
 */
class Addresstype extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'addresstype';
	}

	public function rules()
	{
		return array(
			array('addresstypename, recordstatus', 'required'),
			array('recordstatus', 'numerical', 'integerOnly'=>true),
			array('addresstypename', 'length', 'max'=>50),
			array('addresstypeid, addresstypename, recordstatus', 'safe', 'on'=>'search'),
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
			'addresstypeid' => Catalogsys::model()->getCatalog('addresstypeid'),
			'addresstypename' => Catalogsys::model()->getCatalog('addresstypename'),
			'recordstatus' => Catalogsys::model()->getCatalog('recordstatus'),
		);
	}
	
	private function comparedb($criteria)
	{
				if (isset($_GET['addresstypeid']))
		{
			$criteria->compare('addresstypeid',$_GET['addresstypeid'],true);
		}
		if (isset($_GET['addresstypename']))
		{
			$criteria->compare('addresstypename',$_GET['addresstypename'],true);
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
		$criteria->compare('addresstypeid',$this->addresstypeid);
		$criteria->compare('addresstypename',$this->addresstypename,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'addresstypeid desc', 
    ),
		));
	}
	
		public function searchwstatus()
	{
		$criteria=new CDbCriteria;
		$criteria->condition='recordstatus=1';
		$this->comparedb($criteria);
		$criteria->compare('addresstypeid',$this->addresstypeid);
		$criteria->compare('addresstypename',$this->addresstypename,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'addresstypeid desc', 
    ),
		));
	}
	
	}