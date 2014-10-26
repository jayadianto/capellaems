<?php

/**
 * This is the model class for table "menuaccess".
 *
 * The followings are the available columns in table 'menuaccess':
 * @property integer $menuaccessid
 * @property string $menucode
 * @property string $menuname
 * @property string $menuurl
 * @property integer $recordstatus
 */
class Menuaccess extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Menuaccess the static model class
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
		return 'menuaccess';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menuname, menuurl, menuicon,recordstatus, moduleid', 'required'),
			array('recordstatus,parentid,moduleid,sortorder', 'numerical', 'integerOnly'=>true),
			array('menuname, menuicon,menuurl,description,menuicon', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('menuaccessid, menucode, sortorder,menuname, menuurl, menuicon,recordstatus,description,parentid,moduleid', 'safe', 'on'=>'search'),
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
			'menuparent' => array(self::BELONGS_TO, 'Menuaccess', 'parentid'),
			'module' => array(self::BELONGS_TO, 'Modules', 'moduleid'),
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'menuaccessid' => Catalogsys::model()->getCatalog('menuaccessid'),
			'menucode' => Catalogsys::model()->getCatalog('menucode'),
			'menuname' => Catalogsys::model()->getCatalog('menuname'),
			'menuurl' => Catalogsys::model()->getCatalog('menuurl'),
			'description'=> Catalogsys::model()->getCatalog('description'),
			'recordstatus' => Catalogsys::model()->getCatalog('recordstatus'),
			'menuicon'=> Catalogsys::model()->getCatalog('menuicon'),
			'parentid'=>Catalogsys::model()->getCatalog('parent'),
			'moduleid'=>Catalogsys::model()->getCatalog('modulename'),
			'sortorder'=>Catalogsys::model()->getCatalog('sortorder')
		);
	}
	
	private function comparedb($criteria)
	{
		if (isset($_GET['menucode']))
		{
			$criteria->compare('t.menucode',$_GET['menucode'],true);
		}
		if (isset($_GET['menuname']))
		{
			$criteria->compare('t.menuname',$_GET['menuname'],true);
		}
		if (isset($_GET['menuurl']))
		{
			$criteria->compare('t.menuurl',$_GET['menuurl'],true);
		}
		if (isset($_GET['description']))
		{
			$criteria->compare('t.description',$_GET['description'],true);
		}
		if (isset($_GET['modulename']))
		{
			$criteria->compare('module.modulename',$_GET['modulename'],true);
		}
	}
    
	public function getdescription($menuname)
	{
			$menu = Menuaccess::model()->findbysql('select * from menuaccess where lower(menuname) = lower('.$menuname.')');
			return $menu->description;
	}
	
	public function getItems()
	{
		$results = Yii::app()->getDb()->createCommand();
		if (Yii::app()->user->id !== null)
		{
			$results->select('a.menuicon,a.menuname, a.menuaccessid, a.description, a.menuurl,a.parentid')
				->from('menuaccess a, groupmenu b, usergroup c, useraccess d')
				->where('b.menuaccessid = a.menuaccessid and c.groupaccessid = b.groupaccessid and parentid is null and a.recordstatus = 1 and 
					d.useraccessid = c.useraccessid and lower(d.username) = lower("'.Yii::app()->user->id.'")');
		}
		else
		{
			$results->select('a.menuicon,a.menuname, a.menuaccessid, a.description, a.menuurl,a.parentid')
				->from('menuaccess a, groupmenu b, usergroup c, useraccess d')
				->where('b.menuaccessid = a.menuaccessid and c.groupaccessid = b.groupaccessid and a.recordstatus = 1 and 
					d.useraccessid = c.useraccessid and lower(d.username) = lower("guest") and parentid is null');
		}
		$results->order('sortorder ASC, description ASC');
		$results = $results->queryAll();

		$items = array();

		foreach($results AS $result)
		{
			$items[] = array(
				'label'         => Catalogsys::model()->getCatalog($result['menuname']),
				'url'           => Yii::app()->createUrl($result['menuurl']),
				'icon'					=> $result['menuicon']
			 );
		}
		$items[] = array(
			'label'         => (Yii::app()->user->id!==null)?Yii::app()->user->id:"Guest",
			'url'           => '#',
			'icon'					=> 'glyphicon glyphicon-user'
			);
		return $items;
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
		$criteria->with=array('module','menuparent');
		$this->comparedb($criteria);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		'sort' => array(
        'defaultOrder' => 't.menuaccessid desc', 
    ),
		));
	}

	public function searchwstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
				$criteria->with=array('module','menuparent');
		$criteria->condition='t.recordstatus=1';
		$this->comparedb($criteria);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		'sort' => array(
        'defaultOrder' => 't.menuaccessid desc', 
    ),
		));
	}
}
