<?php

/**
 * This is the model class for table "snro".
 *
 * The followings are the available columns in table 'snro':
 * @property integer $snroid
 * @property string $description
 * @property string $formatdoc
 * @property string $formatno
 * @property string $repeatby
 * @property integer $recordstatus
 */
class Snro extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Snro the static model class
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
		return 'snro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description, formatdoc, formatno, recordstatus', 'required'),
			array('recordstatus', 'numerical', 'integerOnly'=>true),
			array('description, formatdoc', 'length', 'max'=>50),
			array('formatno', 'length', 'max'=>10),
			array('repeatby', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('snroid, description, formatdoc, formatno, repeatby, recordstatus', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'snroid' => Catalogsys::model()->getCatalog('snroid'),
			'description' => Catalogsys::model()->getCatalog('description'),
			'formatdoc' => Catalogsys::model()->getCatalog('formatdoc'),
			'formatno' => Catalogsys::model()->getCatalog('formatno'),
			'repeatby' => Catalogsys::model()->getCatalog('repeatby'),
			'recordstatus' => Catalogsys::model()->getCatalog('recordstatus'),
		);
	}
	
		private function comparedb($criteria)
	{
		if (isset($_GET['description']))
		{
			$criteria->compare('description',$_GET['description'],true);
		}		
		if (isset($_GET['formatdoc']))
		{
			$criteria->compare('formatdoc',$_GET['formatdoc'],true);
		}		
		if (isset($_GET['formatno']))
		{
			$criteria->compare('formatno',$_GET['formatno'],true);
		}		
		if (isset($_GET['repeatby']))
		{
			$criteria->compare('repeatby',$_GET['repeatby'],true);
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
		$criteria->compare('snroid',$this->snroid);
		$this->comparedb($criteria);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('formatdoc',$this->formatdoc,true);
		$criteria->compare('formatno',$this->formatno,true);
		$criteria->compare('repeatby',$this->repeatby,true);
		$criteria->compare('recordstatus',$this->recordstatus,true);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 't.snroid desc', 
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
		$this->comparedb($criteria);
    $criteria->condition='t.recordstatus=1';
		$criteria->compare('snroid',$this->snroid);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('formatdoc',$this->formatdoc,true);
		$criteria->compare('formatno',$this->formatno,true);
		$criteria->compare('repeatby',$this->repeatby,true);
		$criteria->compare('recordstatus',$this->recordstatus,true);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 't.snroid desc', 
    ),
		));
	}
}