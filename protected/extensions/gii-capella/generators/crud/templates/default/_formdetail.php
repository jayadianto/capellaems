<?php echo "<?php \$form = \$this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo \$form->hiddenField(\$model,'".$this->getModelDetailID()."'); ?>
<?php echo \$form->hiddenField(\$model,'".$this->getModelID()."'); ?>";

foreach($this->tableDetailSchema->columns as $column)
{
	if($column->autoIncrement)
	{
		//continue;
				echo "<?php
\$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'".$this->getControllerID()."/writedetail',
	'isCancel'=>true,'UrlCancel'=>'".$this->getControllerID()."/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>\n";
	}
	else
	if ($column->name == $this->getModelID())
	{
		continue;
	}
	else {
	if ($column->type==='boolean' || $column->name === 'recordstatus')
	{
		echo "<?php echo \$form->checkBoxGroup(
            \$model,
            '".$column->name."'
        ); ?> \n";	
	}
	else
	if (preg_match('/^(password|pass|passwd|passcode)$/i',$column->name))
	{
		echo "<?php echo echo \$form->passwordFieldGroup(\$model, '".$column->name."'); ?>\n";
	}
	else
	if (stripos($column->dbType,'text')!==false)
	{
		echo "<?php echo \$form->textAreaGroup(\$model, '".$column->name."'); ?>\n";
	}
	else
	if (stripos($column->dbType,'char')!==false)
	{
		echo "<?php echo \$form->textFieldGroup(\$model, '".$column->name."'); ?>\n";
	}
	else
	if (stripos($column->dbType,'date')!==false)
	{
		echo "<div class='form-group'>
	<label class='col-sm-3 control-label required' for='".$this->model."_".$column->name."'>Date</label>
	<div class='col-sm-6'><?php \$this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'attribute'=>'".$column->name."',
              'model'=>\$model,
              // additional javascript options for the date picker plugin
             'options'=>array(
                  'showAnim'=>'fold',
				  'dateFormat'=>Yii::app()->params['dateviewcjui'],
				  'changeYear'=>true,
				  'changeMonth'=>true,
                                  'yearRange'=>'-10:+10'
              ),
              'htmlOptions'=>array(
									'class'=>'form-control'
              ),
          ));?></div></div>\n";
	}
	else
	{
		echo "<?php echo \$form->textFieldGroup(\$model, '".$column->name."'); ?>\n";
	}
}
}
echo "<?php \$this->endWidget(); ?>\n";
