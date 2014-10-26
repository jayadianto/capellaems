<?php

/**
 * This is the model class for table "identitytype".
 *
 * The followings are the available columns in table 'identitytype':
 * @property integer $identitytypeid
 * @property string $identitytypename
 * @property integer $recordstatus
 */
class Identitytype extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'identitytype';
	}

	public function rules()
	{
		return array(
			array('identitytypename, recordstatus', 'required'),
			array('recordstatus', 'numerical', 'integerOnly'=>true),
			array('identitytypename', 'length', 'max'=>50),
			array('identitytypeid, identitytypename, recordstatus', 'safe', 'on'=>'search'),
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
			'identitytypeid' => Catalogsys::model()->getCatalog('identitytypeid'),
			'identitytypename' => Catalogsys::model()->getCatalog('identitytypename'),
			'recordstatus' => Catalogsys::model()->getCatalog('recordstatus'),
		);
	}
	
	private function comparedb($criteria)
	{
				if (isset($_GET['identitytypeid']))
		{
			$criteria->compare('identitytypeid',$_GET['identitytypeid'],true);
		}
		if (isset($_GET['identitytypename']))
		{
			$criteria->compare('identitytypename',$_GET['identitytypename'],true);
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
		$criteria->compare('identitytypeid',$this->identitytypeid);
		$criteria->compare('identitytypename',$this->identitytypename,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'identitytypeid desc', 
    ),
		));
	}
	
		public function searchwstatus()
	{
		$criteria=new CDbCriteria;
		$criteria->condition='recordstatus=1';
		$this->comparedb($criteria);
		$criteria->compare('identitytypeid',$this->identitytypeid);
		$criteria->compare('identitytypename',$this->identitytypename,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'identitytypeid desc', 
    ),
		));
	}
	
	}