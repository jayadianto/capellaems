<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'modules-form',
	'type'=>'vertical',
)); ?>
<?php echo $form->hiddenField($model,'moduleid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'modules/write',
	'isCancel'=>true,'UrlCancel'=>'modules/cancelwrite','isHelpModif'=>true));
?>
	<?php echo $form->textFieldGroup($model, 'modulename'); ?>
	<?php echo $form->textFieldGroup($model, 'moduledesc'); ?>
	<?php echo $form->textFieldGroup($model, 'moduleicon'); ?>
		<?php echo $form->checkBoxGroup(
            $model,
            'isinstall'
        ); ?> 
	<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
