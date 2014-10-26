<?php

/**
 * This is the model class for table "groupmenu".
 *
 * The followings are the available columns in table 'groupmenu':
 * @property integer $groupmenuid
 * @property integer $groupaccessid
 * @property integer $menuaccessid
 * @property integer $isread
 * @property integer $iswrite
 * @property integer $ispost
 * @property integer $isreject
 * @property integer $isupload
 * @property integer $isdownload
 *
 * The followings are the available model relations:
 * @property Menuaccess $menuaccess
 * @property Groupaccess $groupaccess
 */
class Groupmenu extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Groupmenu the static model class
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
		return 'groupmenu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('groupaccessid, menuaccessid, isread, iswrite, ispost, isreject, isupload, isdownload', 'required'),
			array('groupaccessid, menuaccessid, isread, iswrite, ispost, isreject, isupload, isdownload,ispurge', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('groupmenuid, groupaccessid, menuaccessid, isread, iswrite, ispost, isreject, isupload, isdownload,ispurge', 'safe', 'on'=>'search'),
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
			'menuaccess' => array(self::BELONGS_TO, 'Menuaccess', 'menuaccessid'),
			'groupaccess' => array(self::BELONGS_TO, 'Groupaccess', 'groupaccessid'),
		);
	}
	
		private function comparedb($criteria)
	{
		if (isset($_GET['groupname']))
		{
			$criteria->compare('groupaccess.groupname',$_GET['groupname'],true);
		}		
		if (isset($_GET['menuname']))
		{
			$criteria->compare('menuaccess.menuname',$_GET['menuname'],true);
		}	
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'groupmenuid' => Catalogsys::model()->getCatalog('groupmenuid'),
			'groupaccessid' => Catalogsys::model()->getCatalog('groupaccess'),
			'menuaccessid' => Catalogsys::model()->getCatalog('menuaccess'),
			'isread' => Catalogsys::model()->getCatalog('isread'),
			'iswrite' => Catalogsys::model()->getCatalog('iswrite'),
			'ispost' => Catalogsys::model()->getCatalog('ispost'),
			'isreject' => Catalogsys::model()->getCatalog('isreject'),
			'isupload' => Catalogsys::model()->getCatalog('isupload'),
			'isdownload' => Catalogsys::model()->getCatalog('isdownload'),
			'ispurge' => Catalogsys::model()->getCatalog('ispurge'),
		);
	}
  
  public function GetReadMenu($menuname)
  {
    $menu = Groupmenu::model()->findbysql("select isread ".
		" from useraccess a ".
		" inner join usergroup b on b.useraccessid = a.useraccessid ".
		" inner join groupmenu c on c.groupaccessid = b.groupaccessid ".
		" inner join menuaccess d on d.menuaccessid = c.menuaccessid ".
		" where lower(username) = '".Yii::app()->user->id."' and lower(menuname) = '".$menuname."'");
    if ($menu != null)
    {
      if ($menu->isread == 1)
      {
        return true;
      } else
      {
        return false;
      }
    }
    else 
    {
      return false;
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
        $criteria->with=array('groupaccess','menuaccess');
				$this->comparedb($criteria);
		$criteria->compare('groupmenuid',$this->groupmenuid);
		$criteria->compare('groupaccess.groupname',$this->groupaccessid,true);
		$criteria->compare('menuaccess.description',$this->menuaccessid,true);
		$criteria->compare('isread',$this->isread);
		$criteria->compare('iswrite',$this->iswrite);
		$criteria->compare('ispost',$this->ispost);
		$criteria->compare('isreject',$this->isreject);
		$criteria->compare('isupload',$this->isupload);
		$criteria->compare('isdownload',$this->isdownload);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		'sort' => array(
        'defaultOrder' => 'groupmenuid desc', 
    ),
		));
	}
}
