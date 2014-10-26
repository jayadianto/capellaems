<?php

/**
 * This is the model class for table "city".
 *
 * The followings are the available columns in table 'city':
 * @property integer $cityid
 * @property integer $provinceid
 * @property string $cityname
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Address[] $addresses
 * @property Province $province
 * @property Employeeeducation[] $employeeeducations
 * @property Employeefamily[] $employeefamilys
 */
class City extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return City the static model class
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
		return 'city';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('provinceid, cityname, recordstatus', 'required'),
			array('provinceid, recordstatus', 'numerical', 'integerOnly'=>true),
			array('cityname', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cityid, provinceid, cityname, recordstatus', 'safe', 'on'=>'search'),
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
			'addresses' => array(self::HAS_MANY, 'Address', 'cityid'),
			'province' => array(self::BELONGS_TO, 'Province', 'provinceid'),
			'employeeeducations' => array(self::HAS_MANY, 'Employeeeducation', 'cityid'),
			'employeefamilys' => array(self::HAS_MANY, 'Employeefamily', 'cityid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cityid' => Catalogsys::model()->getcatalog('cityid'),
			'provinceid' => Catalogsys::model()->getcatalog('Province'),
			'citycode' => Catalogsys::model()->getcatalog('citycode'),
			'cityname' => Catalogsys::model()->getcatalog('Cityname'),
			'recordstatus' => Catalogsys::model()->getcatalog('recordstatus'),
		);
	}
	
	private function comparedb($criteria)
	{
		if (isset($_GET['cityname']))
		{
			$criteria->compare('cityname',$_GET['cityname'],true);
		}		
		if (isset($_GET['provincename']))
		{
			$criteria->compare('province.provincename',$_GET['provincename'],true);
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
		$criteria->with=array('province');
		$this->comparedb($criteria);
		$criteria->compare('cityid',$this->cityid);
		$criteria->compare('province.provincename',$this->provinceid,true);
		$criteria->compare('cityname',$this->cityname,true);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
							'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
					),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 't.cityid desc', 
    ),
		));
	}

  /**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchwstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
        $criteria->with=array('province');
				$this->comparedb($criteria);
    $criteria->condition='t.recordstatus=1';
		$criteria->compare('t.cityid',$this->cityid);
		$criteria->compare('province.provincename',$this->provinceid,true);
		$criteria->compare('t.cityname',$this->cityname,true);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 't.cityid desc', 
    ),
		));
	}
}