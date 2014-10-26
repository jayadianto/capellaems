<?php
class Country extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'country';
	}
	
	public function rules()
	{
		return array(
			array('countrycode, countryname, recordstatus', 'required'),
			array('recordstatus', 'numerical', 'integerOnly'=>true),
			array('countrycode', 'length', 'max'=>5),
			array('countryname', 'length', 'max'=>50),
			array('countryid, countrycode, countryname, recordstatus', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'provinces' => array(self::HAS_MANY, 'Province', 'countryid'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'countryid' => Catalogsys::model()->getcatalog('countryid'),
			'countrycode' => Catalogsys::model()->getcatalog('countrycode'),
			'countryname' => Catalogsys::model()->getcatalog('countryname'),
			'recordstatus' => Catalogsys::model()->getcatalog('recordstatus'),
		);
	}
	
	private function comparedb($criteria)
	{
		if (isset($_GET['countrycode']))
		{
			$criteria->compare('countrycode',$_GET['countrycode'],true);
		}		
		if (isset($_GET['countryname']))
		{
			$criteria->compare('countryname',$_GET['countryname'],true);
		}	
	}

	public function search()
	{
		$criteria=new CDbCriteria;
		$this->comparedb($criteria);
		$criteria->compare('countryid',$this->countryid);
		$criteria->compare('countrycode',$this->countrycode,true);
		$criteria->compare('countryname',$this->countryname,true);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'countryid desc', 
    ),
		));
	}

	public function searchwstatus()
	{
		$criteria=new CDbCriteria;
		$this->comparedb($criteria);
    $criteria->condition='recordstatus=1';
		$criteria->compare('countryid',$this->countryid);
		$criteria->compare('countrycode',$this->countrycode,true);
		$criteria->compare('countryname',$this->countryname,true);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'countryid desc', 
    ),
		));
	}
}