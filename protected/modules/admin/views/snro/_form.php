<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'snro-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'snroid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'snro/write',
	'isCancel'=>true,'UrlCancel'=>'snro/cancelwrite','isHelpModif'=>true));
?>
	<?php echo $form->textFieldGroup($model, 'description'); ?>
	<?php echo $form->textFieldGroup($model, 'formatdoc'); ?>
	<?php echo $form->textFieldGroup($model, 'formatno'); ?>
	<?php echo $form->textFieldGroup($model, 'repeatby'); ?>
	<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
