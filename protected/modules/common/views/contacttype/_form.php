<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'contacttype-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'contacttypeid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'contacttype/write',
	'isCancel'=>true,'UrlCancel'=>'contacttype/cancelwrite','isHelpModif'=>true));
?>
	<?php echo $form->textFieldGroup($model, 'contacttypename'); ?>
	<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
