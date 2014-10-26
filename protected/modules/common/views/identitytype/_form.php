<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'identitytype-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'identitytypeid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'identitytype/write',
	'isCancel'=>true,'UrlCancel'=>'identitytype/cancelwrite','isHelpModif'=>true));
?>
	<?php echo $form->textFieldGroup($model, 'identitytypename'); ?>
	<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
