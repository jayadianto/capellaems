<?php
/**
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 */
?>
<?php echo "<?php\n"; ?>

/**
 * This is the model class for table "<?php echo $tableName; ?>".
 *
 * The followings are the available columns in table '<?php echo $tableName; ?>':
<?php foreach($columns as $column): ?>
 * @property <?php echo $column->type.' $'.$column->name."\n"; ?>
<?php endforeach; ?>
<?php if(!empty($relations)): ?>
 *
 * The followings are the available model relations:
<?php foreach($relations as $name=>$relation): ?>
 * @property <?php
	if (preg_match("~^array\(self::([^,]+), '([^']+)', '([^']+)'\)$~", $relation, $matches))
    {
        $relationType = $matches[1];
        $relationModel = $matches[2];

        switch($relationType){
            case 'HAS_ONE':
                echo $relationModel.' $'.$name."\n";
            break;
            case 'BELONGS_TO':
                echo $relationModel.' $'.$name."\n";
            break;
            case 'HAS_MANY':
                echo $relationModel.'[] $'.$name."\n";
            break;
            case 'MANY_MANY':
                echo $relationModel.'[] $'.$name."\n";
            break;
            default:
                echo 'mixed $'.$name."\n";
        }
	}
    ?>
<?php endforeach; ?>
<?php endif; ?>
 */
class <?php echo $modelClass; ?> extends <?php echo $this->baseClass."\n"; ?>
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '<?php echo $tableName; ?>';
	}

	public function rules()
	{
		return array(
<?php foreach($rules as $rule): ?>
			<?php echo $rule.",\n"; ?>
<?php endforeach; ?>
			array('<?php echo implode(', ', array_keys($columns)); ?>', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
<?php foreach($relations as $name=>$relation): ?>
			<?php echo "'$name' => $relation,\n"; ?>
<?php endforeach; ?>
		);
	}

	public function attributeLabels()
	{	
		return array(
<?php foreach($labels as $name=>$label): ?>
			<?php echo "'$name' => Catalogsys::model()->getCatalog('$name'),\n"; ?>
<?php endforeach; ?>
		);
	}
	
	private function comparedb($criteria)
	{
		<?php
		foreach($columns as $name=>$column)
		{
			echo "\t\tif (isset(\$_GET['$name']))\n";
			echo "\t\t{\n";
			echo "\t\t\t\$criteria->compare('$name',\$_GET['$name'],true);\n";
			echo "\t\t}\n";
		}
		?>		
	}
	
	public function beforeSave()
	{
		<?php
		echo "//khusus untuk date time\n";
		echo "\t// \$this->field = date(Yii::app()->params['datetodb'], strtotime(\$this->\$field));\n";
		?>
		return parent::beforeSave();
	}

	<?php
	$nkolom = ''; $kolheaderid = ''; $i = 0;$isstatus = 0;
foreach($columns as $name=>$column)
{
	if ($i == 1)
	{
		$kolheaderid = $column->name;
	}
	$i += 1;
	if ($nkolom == '')
	{
		if($column->type==='string')
		{
			$nkolom = "\t\t\$criteria->compare('$name',\$this->$name,true);\n";
		}
		else
		{
			$nkolom = "\t\t\$criteria->compare('$name',\$this->$name);\n";
		}
	}
	else
	{
		if($column->type==='string')
		{
			$nkolom .= "\t\t\$criteria->compare('$name',\$this->$name,true);\n";
		}
		else
		{
			$nkolom .= "\t\t\$criteria->compare('$name',\$this->$name);\n";
		}
	}
	if ($column->name === 'recordstatus')
	{
		$isstatus = 1;
	}
}
?>

	public function search()
	{
		$criteria=new CDbCriteria;
		$this->comparedb($criteria);
<?php echo $nkolom ?>
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => '<?php echo $kolheaderid?> desc', 
    ),
		));
	}
	
	<?php if ($isstatus == 1) { ?>
	public function searchwstatus()
	{
		$criteria=new CDbCriteria;
		$criteria->condition='recordstatus=1';
		$this->comparedb($criteria);
<?php echo $nkolom ?>
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
        'defaultOrder' => '<?php echo $kolheaderid ?> desc', 
    ),
		));
	}
	
	<?php } ?>
}