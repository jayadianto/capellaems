<?php

/**
 * This is the model class for table "currency".
 *
 * The followings are the available columns in table 'currency':
 * @property integer $currencyid
 * @property integer $countryid
 * @property string $currencyname
 * @property string $symbol
 * @property integer $recordstatus
 */
class Currency extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Currency the static model class
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
		return 'currency';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('countryid, currencyname, symbol, recordstatus', 'required'),
			array('countryid, recordstatus', 'numerical', 'integerOnly'=>true),
			array('currencyname,i18n', 'length', 'max'=>70),
			array('symbol', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('currencyid, countryid, currencyname, symbol, recordstatus,i18n', 'safe', 'on'=>'search'),
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
      'country' => array(self::BELONGS_TO, 'Country', 'countryid'),
		);
	}
	
		private function comparedb($criteria)
	{
		if (isset($_GET['countrycode']))
		{
			$criteria->compare('country.countrycode',$_GET['countrycode'],true);
		}		
				if (isset($_GET['countryname']))
		{
			$criteria->compare('country.countryname',$_GET['countryname'],true);
		}		
						if (isset($_GET['currencyname']))
		{
			$criteria->compare('currencyname',$_GET['currencyname'],true);
		}		
						if (isset($_GET['symbol']))
		{
			$criteria->compare('symbol',$_GET['symbol'],true);
		}				
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'currencyid' => Catalogsys::model()->getCatalog('currencyID'),
			'countryid' => Catalogsys::model()->getCatalog('Country'),
			'currencyname' => Catalogsys::model()->getCatalog('Currency'),
			'symbol' => Catalogsys::model()->getCatalog('Symbol'),
			'recordstatus' => Catalogsys::model()->getCatalog('RecordStatus'),
		);
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
    $criteria->with=array('country');
		$this->comparedb($criteria);
		$criteria->compare('t.currencyid',$this->currencyid);
		$criteria->compare('country.countryname',$this->countryid,true);
		$criteria->compare('t.currencyname',$this->currencyname,true);
		$criteria->compare('t.symbol',$this->symbol,true);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'currencyid desc', 
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
    $criteria->with=array('country');
		$this->comparedb($criteria);
    $criteria->condition='t.recordstatus=1';
		$criteria->compare('t.currencyid',$this->currencyid);
		$criteria->compare('country.countryname',$this->countryid,true);
		$criteria->compare('t.currencyname',$this->currencyname,true);
		$criteria->compare('t.symbol',$this->symbol,true);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'currencyid desc', 
    ),
		));
	}
}