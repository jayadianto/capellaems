<?php
class Province extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'province';
	}

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('countryid, provincename, recordstatus', 'required'),
			array('countryid, recordstatus', 'numerical', 'integerOnly'=>true),	
			array('provinceid, countryid, provincename, recordstatus', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'cities' => array(self::HAS_MANY, 'City', 'provinceid'),
			'country' => array(self::BELONGS_TO, 'Country', 'countryid'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'provinceid' => Catalogsys::model()->getcatalog('provinceid'),
			'countryid' => Catalogsys::model()->getcatalog('Country'),
			'provincename' => Catalogsys::model()->getcatalog('Provincename'),
			'recordstatus' => Catalogsys::model()->getcatalog('RecordStatus'),
			'provincecode' => Catalogsys::model()->getcatalog('ProvinceCode')
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
		if (isset($_GET['provincename']))
		{
			$criteria->compare('provincename',$_GET['provincename'],true);
		}			
		if (isset($_GET['provincecode']))
		{
			$criteria->compare('provincecode',$_GET['provincecode'],true);
		}			
	}

	public function search()
	{
		$criteria=new CDbCriteria;
    $criteria->with=array('country');
		$this->comparedb($criteria);
		$criteria->compare('t.provinceid',$this->provinceid);
		$criteria->compare('country.countryname',$this->countryid,true);
		$criteria->compare('t.provincename',$this->provincename,true);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 't.provinceid desc', 
    ),
		));
	}

	public function searchwstatus()
	{
		$criteria=new CDbCriteria;
    $criteria->with=array('country');
		$this->comparedb($criteria);
    $criteria->condition='t.recordstatus=1';
		$criteria->compare('t.provinceid',$this->provinceid);
		$criteria->compare('country.countryname',$this->countryid);
		$criteria->compare('t.provincename',$this->provincename,true);
		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 't.provinceid desc', 
    ),
		));
	}
}