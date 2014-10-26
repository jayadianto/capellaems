<?php

/**
 * This is the model class for table "translog".
 *
 * The followings are the available columns in table 'translog':
 * @property integer $translogid
 * @property string $username
 * @property string $model
 * @property string $useraction
 * @property string $createddate
 * @property string $fieldname
 * @property string $fieldoldvalue
 * @property string $fieldnewvalue
 */
class Translog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Translog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'translog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, useraction, menuname, tableid', 'length', 'max'=>50),
			array('newdata, olddata, createddate', 'length','max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('translogid, username, useraction, menuname, tableid,newdata, olddata, createddate', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'translogid' => 'Data',
			'username' => 'User',
			'menuname' => 'Menu Name',
			'useraction' => 'Action',
			'createddate' => 'Created Date',
			'tableid' => 'Table ID',
			'newdata' => 'New Datas',
			'olddata' => 'Old Datas'
		);
	}
	
		private function comparedb($criteria)
	{
		if (isset($_GET['username']))
		{
			$criteria->compare('username',$_GET['username'],true);
		}		
		if (isset($_GET['menuname']))
		{
			$criteria->compare('menuname',$_GET['menuname'],true);
		}		
		if (isset($_GET['useraction']))
		{
			$criteria->compare('useraction',$_GET['useraction'],true);
		}		
				if (isset($_GET['newdata']))
		{
			$criteria->compare('newdata',$_GET['newdata'],true);
		}		
				if (isset($_GET['olddata']))
		{
			$criteria->compare('olddata',$_GET['olddata'],true);
		}		
				if (isset($_GET['tableid']))
		{
			$criteria->compare('tableid',$_GET['tableid'],true);
		}		
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
$this->comparedb($criteria);
$criteria->order = 'createddate desc';
		$criteria->compare('translogid',$this->translogid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('menuname',$this->menuname,true);
		$criteria->compare('useraction',$this->useraction,true);
		$criteria->compare('createddate',$this->createddate,true);
		$criteria->compare('tableid',$this->tableid,true);
		$criteria->compare('newdata',$this->newdata,true);
		$criteria->compare('olddata',$this->olddata,true);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'translogid desc', 
    ),
		));
	}
}