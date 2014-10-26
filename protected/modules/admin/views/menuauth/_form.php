<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'menuauth-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'menuauthid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'menuauth/write',
	'isCancel'=>true,'UrlCancel'=>'menuauth/cancelwrite','isHelpModif'=>true));
?>
	<?php echo $form->textFieldGroup($model, 'menuobject'); ?>
	<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
