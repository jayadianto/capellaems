<?php

/**
 * This is the model class for table "workflow".
 *
 * The followings are the available columns in table 'workflow':
 * @property integer $workflowid
 * @property string $wfname
 * @property string $wfdesc
 * @property integer $wfminstat
 * @property integer $wfmaxstat
 * @property integer $recordstatus
 */
class Workflow extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Workflow the static model class
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
		return 'workflow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wfname, wfdesc, wfminstat, wfmaxstat, recordstatus', 'required'),
			array('wfminstat, wfmaxstat, recordstatus', 'numerical', 'integerOnly'=>true),
			array('wfname', 'length', 'max'=>20),
			array('wfdesc', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('workflowid, wfname, wfdesc, wfminstat, wfmaxstat, recordstatus', 'safe', 'on'=>'search'),
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
			'workflowid' => Catalogsys::model()->getCatalog('workflowid'),
			'wfname' => Catalogsys::model()->getCatalog('wfname'),
			'wfdesc' => Catalogsys::model()->getCatalog('Description'),
			'wfminstat' => Catalogsys::model()->getCatalog('MinStatus'),
			'wfmaxstat' => Catalogsys::model()->getCatalog('MaxStatus'),
			'recordstatus' => Catalogsys::model()->getCatalog('RecordStatus'),
		);
	}
	
		private function comparedb($criteria)
	{
		if (isset($_GET['wfname']))
		{
			$criteria->compare('wfname',$_GET['wfname'],true);
		}
		if (isset($_GET['wfdesc']))
		{
			$criteria->compare('wfdesc',$_GET['wfdesc'],true);
		}
		if (isset($_GET['wfminstat']))
		{
			$criteria->compare('wfminstat',$_GET['wfminstat'],true);
		}
		if (isset($_GET['wfmaxstat']))
		{
			$criteria->compare('wfmaxstat',$_GET['wfmaxstat'],true);
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
$this->comparedb($criteria);
		$criteria->compare('workflowid',$this->workflowid);
		$criteria->compare('wfname',$this->wfname,true);
		$criteria->compare('wfdesc',$this->wfdesc,true);
		$criteria->compare('wfminstat',$this->wfminstat,true);
		$criteria->compare('wfmaxstat',$this->wfmaxstat,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
'criteria'=>$criteria,
'sort' => array(
        'defaultOrder' => 't.workflowid desc', 
    ),
		));
	}

	public function searchwstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition='recordstatus=1';
		$this->comparedb($criteria);
		$criteria->compare('workflowid',$this->workflowid);
		$criteria->compare('wfname',$this->wfname,true);
		$criteria->compare('wfdesc',$this->wfdesc,true);
		$criteria->compare('wfminstat',$this->wfminstat,true);
		$criteria->compare('wfmaxstat',$this->wfmaxstat,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
'criteria'=>$criteria,
'sort' => array(
        'defaultOrder' => 't.workflowid desc', 
    ),
		));
	}
}