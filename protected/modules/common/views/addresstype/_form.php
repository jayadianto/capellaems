<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'addresstype-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'addresstypeid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'addresstype/write',
	'isCancel'=>true,'UrlCancel'=>'addresstype/cancelwrite','isHelpModif'=>true));
?>
	<?php echo $form->textFieldGroup($model, 'addresstypename'); ?>
	<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
