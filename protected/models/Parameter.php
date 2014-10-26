<?php

/**
 * This is the model class for table "parameter".
 *
 * The followings are the available columns in table 'parameter':
 * @property integer $parameterid
 * @property string $paramname
 * @property string $paramvalue
 * @property string $description
 * @property integer $recordstatus
 */
class Parameter extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Parameter the static model class
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
		return 'parameter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('paramname, paramvalue, description, recordstatus', 'required'),
			array('recordstatus,moduleid', 'numerical', 'integerOnly'=>true),
			array('paramname', 'length', 'max'=>30),
			array('paramvalue, description', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('parameterid, paramname, paramvalue, description, recordstatus,moduleid', 'safe', 'on'=>'search'),
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
		'module' => array(self::BELONGS_TO, 'Modules', 'moduleid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'parameterid' => Catalogsys::model()->getCatalog('ID'),
			'paramname' => Catalogsys::model()->getCatalog('paramname'),
			'paramvalue' => Catalogsys::model()->getCatalog('paramvalue'),
			'description' => Catalogsys::model()->getCatalog('Description'),
			'recordstatus' => Catalogsys::model()->getCatalog('RecordStatus'),
			'moduleid' => Catalogsys::model()->getCatalog('module'),
		);
	}
	
		private function comparedb($criteria)
	{
		if (isset($_GET['paramname']))
		{
			$criteria->compare('paramname',$_GET['paramname'],true);
		}		
			if (isset($_GET['paramvalue']))
		{
			$criteria->compare('paramvalue',$_GET['paramvalue'],true);
		}		
			if (isset($_GET['description']))
		{
			$criteria->compare('description',$_GET['description'],true);
		}		
		if (isset($_GET['modulename']))
		{
			$criteria->compare('module.modulename',$_GET['modulename'],true);
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
		$criteria->with=array('module');
		$this->comparedb($criteria);
		$criteria->compare('parameterid',$this->parameterid);
		$criteria->compare('paramname',$this->paramname,true);
		$criteria->compare('paramvalue',$this->paramvalue,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 't.parameterid desc', 
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
		$criteria->with=array('module');
		$this->comparedb($criteria);
    $criteria->condition='recordstatus=1';
		$criteria->compare('parameterid',$this->parameterid);
		$criteria->compare('paramname',$this->paramname,true);
		$criteria->compare('paramvalue',$this->paramvalue,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 't.parameterid desc', 
    ),
		));
	}
}