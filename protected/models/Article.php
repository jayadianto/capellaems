<?php

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $articleid
 * @property string $title
 * @property string $introtext
 * @property string $fulltext
 * @property integer $ispublish
 * @property integer $isnewsflash
 * @property string $createddate
 * @property string $updatedate
 * @property string $createdby
 */
class Article extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'article';
	}

	public function rules()
	{
		return array(
			array('ispublish, isnewsflash', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('createdby', 'length', 'max'=>50),
			array('introtext, fulltext, createddate, updatedate', 'safe'),
			array('articleid, title, introtext, fulltext, ispublish, isnewsflash, createddate, updatedate, createdby', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{	
		return array(
			'articleid' => Catalogsys::model()->getCatalog('articleid'),
			'title' => Catalogsys::model()->getCatalog('title'),
			'introtext' => Catalogsys::model()->getCatalog('introtext'),
			'fulltext' => Catalogsys::model()->getCatalog('fulltext'),
			'ispublish' => Catalogsys::model()->getCatalog('ispublish'),
			'isnewsflash' => Catalogsys::model()->getCatalog('isnewsflash'),
			'createddate' => Catalogsys::model()->getCatalog('createddate'),
			'updatedate' => Catalogsys::model()->getCatalog('updatedate'),
			'createdby' => Catalogsys::model()->getCatalog('createdby'),
		);
	}
	
	private function comparedb($criteria)
	{
				if (isset($_GET['articleid']))
		{
			$criteria->compare('articleid',$_GET['articleid'],true);
		}
		if (isset($_GET['title']))
		{
			$criteria->compare('title',$_GET['title'],true);
		}
		if (isset($_GET['introtext']))
		{
			$criteria->compare('introtext',$_GET['introtext'],true);
		}
		if (isset($_GET['fulltext']))
		{
			$criteria->compare('fulltext',$_GET['fulltext'],true);
		}
		if (isset($_GET['ispublish']))
		{
			$criteria->compare('ispublish',$_GET['ispublish'],true);
		}
		if (isset($_GET['isnewsflash']))
		{
			$criteria->compare('isnewsflash',$_GET['isnewsflash'],true);
		}
		if (isset($_GET['createddate']))
		{
			$criteria->compare('createddate',$_GET['createddate'],true);
		}
		if (isset($_GET['updatedate']))
		{
			$criteria->compare('updatedate',$_GET['updatedate'],true);
		}
		if (isset($_GET['createdby']))
		{
			$criteria->compare('createdby',$_GET['createdby'],true);
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
		$this->comparedb($criteria);
		$criteria->compare('articleid',$this->articleid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('introtext',$this->introtext,true);
		$criteria->compare('fulltext',$this->fulltext,true);
		$criteria->compare('ispublish',$this->ispublish);
		$criteria->compare('isnewsflash',$this->isnewsflash);
		$criteria->compare('createddate',$this->createddate,true);
		$criteria->compare('updatedate',$this->updatedate,true);
		$criteria->compare('createdby',$this->createdby,true);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => 'updatedate desc', 
    ),
		));
	}
	
	}