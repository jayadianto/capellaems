<?php

/**
 * This is the model class for table "catalogsys".
 *
 * The followings are the available columns in table 'catalogsys':
 * @property integer $catalogsysid
 * @property integer $languageid
 * @property string $catalogname
 * @property string $catalogval
 * @property integer $recordstatus
 */
class Catalogsys extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Catalogsys the static model class
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
		return 'catalogsys';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('languageid, catalogname, catalogval', 'required'),
			array('languageid', 'numerical', 'integerOnly'=>true),
			array('catalogname', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('catalogsysid, languageid, catalogname, catalogval', 'safe', 'on'=>'search'),
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
			'language' => array(self::BELONGS_TO, 'Language', 'languageid'),
		);
	}
	
		private function comparedb($criteria)
	{
		if (isset($_GET['languagename']))
		{
			$criteria->compare('language.languagename',$_GET['languagename'],true);
		}		
		if (isset($_GET['catalogname']))
		{
			$criteria->compare('catalogname',$_GET['catalogname'],true);
		}		
		if (isset($_GET['catalogval']))
		{
			$criteria->compare('catalogval',$_GET['catalogval'],true);
		}		
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'catalogsysid' => Catalogsys::model()->getCatalog('catalogsysID'),
			'languageid' =>Catalogsys::model()->getCatalog('Language'),
			'catalogname' => Catalogsys::model()->getCatalog('Catalog'),
			'catalogval' => Catalogsys::model()->getCatalog('CatalogValue'),
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
		$criteria->with=array('language');
$this->comparedb($criteria);
		$criteria->compare('catalogsysid',$this->catalogsysid);
		$criteria->compare('languageid',$this->languageid);
		$criteria->compare('catalogname',$this->catalogname,true);
		$criteria->compare('catalogval',$this->catalogval,true);

		return new CActiveDataProvider(get_class($this), array(
		'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'catalogsysid desc', 
    ),
		));
	}
	
	public function GetCatalog($menuname)
  {
		if (Yii::app()->user->id !== null)
		{
			$menu = Catalogsys::model()->findbysql("select catalogval ".
			" from catalogsys a ".
			" inner join useraccess b on b.languageid = a.languageid ".
			" where lower(catalogname) = lower('".$menuname."') and lower(b.username) = lower('". Yii::app()->user->id ."')");
		}
		else
		{
			$menu = Catalogsys::model()->findbysql("select catalogval ".
			" from catalogsys a ".
			" inner join useraccess b on b.languageid = a.languageid ".
			" where lower(catalogname) = lower('".$menuname."')");
		}
    if ($menu != null)
    {
      return  $menu->catalogval;
    }
    else 
    {
      return $menuname;
    }
  }
}