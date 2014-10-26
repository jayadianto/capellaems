<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'theme-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'themeid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'theme/write',
	'isCancel'=>true,'UrlCancel'=>'theme/cancelwrite','isHelpModif'=>true));
?>
	<?php echo $form->textFieldGroup($model, 'themename'); ?>
	<?php echo $form->textFieldGroup($model, 'description'); ?>
	<?php echo $form->textFieldGroup($model, 'themeprev'); ?>
	<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
