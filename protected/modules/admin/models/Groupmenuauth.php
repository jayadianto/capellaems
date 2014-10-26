<?php

/**
 * This is the model class for table "groupmenuauth".
 *
 * The followings are the available columns in table 'groupmenuauth':
 * @property string $groupmenuauthid
 * @property string $groupaccessid
 * @property string $menuauthid
 * @property string $menuvalueid
 */
class Groupmenuauth extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'groupmenuauth';
	}

	public function rules()
	{
		return array(
			array('groupaccessid, menuauthid, menuvalueid', 'required'),
			array('groupaccessid, menuauthid', 'length', 'max'=>10),
			array('menuvalueid', 'length', 'max'=>50),
			array('groupmenuauthid, groupaccessid, menuauthid, menuvalueid', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
		'groupaccess' => array(self::BELONGS_TO, 'Groupaccess', 'groupaccessid'),
			'menuauth' => array(self::BELONGS_TO, 'Menuauth', 'menuauthid'),
		);
	}

	public function attributeLabels()
	{	
		return array(
			'groupmenuauthid' => Catalogsys::model()->getCatalog('groupmenuauthid'),
			'groupaccessid' => Catalogsys::model()->getCatalog('groupaccess'),
			'menuauthid' => Catalogsys::model()->getCatalog('menuauth'),
			'menuvalueid' => Catalogsys::model()->getCatalog('menuvalueid'),
		);
	}
	
	private function comparedb($criteria)
	{
				if (isset($_GET['groupmenuauthid']))
		{
			$criteria->compare('groupmenuauthid',$_GET['groupmenuauthid'],true);
		}
		if (isset($_GET['groupaccessid']))
		{
			$criteria->compare('groupaccessid',$_GET['groupaccessid'],true);
		}
		if (isset($_GET['menuauthid']))
		{
			$criteria->compare('menuauthid',$_GET['menuauthid'],true);
		}
		if (isset($_GET['menuvalueid']))
		{
			$criteria->compare('menuvalueid',$_GET['menuvalueid'],true);
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
		$criteria->with=array('groupaccess','menuauth');
		$this->comparedb($criteria);
		$criteria->compare('t.groupmenuauthid',$this->groupmenuauthid,true);
		$criteria->compare('t.groupaccessid',$this->groupaccessid,true);
		$criteria->compare('t.menuauthid',$this->menuauthid,true);
		$criteria->compare('t.menuvalueid',$this->menuvalueid,true);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 't.groupmenuauthid desc', 
    ),
		));
	}
	
	}