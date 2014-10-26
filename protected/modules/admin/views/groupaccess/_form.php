<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'groupaccess-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'groupaccessid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'groupaccess/write',
	'isCancel'=>true,'UrlCancel'=>'groupaccess/cancelwrite','isHelpModif'=>true));
?>
	<?php echo $form->textFieldGroup($model, 'groupname'); ?>
	<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
