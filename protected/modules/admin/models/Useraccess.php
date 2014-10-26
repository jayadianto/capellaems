<?php

/**
 * This is the model class for table "useraccess".
 *
 * The followings are the available columns in table 'useraccess':
 * @property integer $useraccessid
 * @property string $username
 * @property string $realname
 * @property string $password
 * @property string $email
 * @property string $phoneno
 * @property integer $languageid
 * @property string $themeid
 * @property integer $isonline
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Usergroup[] $usergroups
 */
class Useraccess extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'useraccess';
	}

	public function rules()
	{
		return array(
			array('username, realname, password, recordstatus', 'required'),
			array('languageid, isonline, recordstatus', 'numerical', 'integerOnly'=>true),
			array('username, phoneno, themeid', 'length', 'max'=>50),
			array('realname, email', 'length', 'max'=>100),
			array('password', 'length', 'max'=>128),
			array('useraccessid, username, realname, password, email, phoneno, languageid, themeid, isonline, recordstatus', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'theme' => array(self::BELONGS_TO, 'Theme', 'themeid'),
			'language' => array(self::BELONGS_TO, 'Language', 'languageid'),
		);
	}

	public function attributeLabels()
	{	
		return array(
			'useraccessid' => Catalogsys::model()->getCatalog('useraccessid'),
			'username' => Catalogsys::model()->getCatalog('username'),
			'realname' => Catalogsys::model()->getCatalog('realname'),
			'password' => Catalogsys::model()->getCatalog('password'),
			'email' => Catalogsys::model()->getCatalog('email'),
			'phoneno' => Catalogsys::model()->getCatalog('phoneno'),
			'languageid' => Catalogsys::model()->getCatalog('languagename'),
			'themeid' => Catalogsys::model()->getCatalog('themename'),
			'isonline' => Catalogsys::model()->getCatalog('isonline'),
			'recordstatus' => Catalogsys::model()->getCatalog('recordstatus'),
		);
	}
	
	private function comparedb($criteria)
	{
				if (isset($_GET['useraccessid']))
		{
			$criteria->compare('useraccessid',$_GET['useraccessid'],true);
		}
		if (isset($_GET['username']))
		{
			$criteria->compare('username',$_GET['username'],true);
		}
		if (isset($_GET['realname']))
		{
			$criteria->compare('realname',$_GET['realname'],true);
		}
		if (isset($_GET['password']))
		{
			$criteria->compare('password',$_GET['password'],true);
		}
		if (isset($_GET['email']))
		{
			$criteria->compare('email',$_GET['email'],true);
		}
		if (isset($_GET['phoneno']))
		{
			$criteria->compare('phoneno',$_GET['phoneno'],true);
		}
		if (isset($_GET['languageid']))
		{
			$criteria->compare('languageid',$_GET['languageid'],true);
		}
		if (isset($_GET['themeid']))
		{
			$criteria->compare('themeid',$_GET['themeid'],true);
		}
		if (isset($_GET['isonline']))
		{
			$criteria->compare('isonline',$_GET['isonline'],true);
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
	
	public function validatePassword($password)
	{
		return $this->hashPassword($password)===$this->password;
	}
	
	public function hashPassword($password)
	{
		return md5($password);
	}
	
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('theme','language');
		$this->comparedb($criteria);
		$criteria->compare('useraccessid',$this->useraccessid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('realname',$this->realname,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phoneno',$this->phoneno,true);
		$criteria->compare('languageid',$this->languageid);
		$criteria->compare('themeid',$this->themeid,true);
		$criteria->compare('isonline',$this->isonline);
		$criteria->compare('t.recordstatus',$this->recordstatus);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'useraccessid desc', 
    ),
		));
	}
	
		public function searchwstatus()
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('theme','language');
		$criteria->condition='t.recordstatus=1';
		$this->comparedb($criteria);
		$criteria->compare('useraccessid',$this->useraccessid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('realname',$this->realname,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phoneno',$this->phoneno,true);
		$criteria->compare('languageid',$this->languageid);
		$criteria->compare('themeid',$this->themeid,true);
		$criteria->compare('isonline',$this->isonline);
		$criteria->compare('t.recordstatus',$this->recordstatus);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'useraccessid desc', 
    ),
		));
	}
	
	}