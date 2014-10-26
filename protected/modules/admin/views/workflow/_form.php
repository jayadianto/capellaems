<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'workflow-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'workflowid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'workflow/write',
	'isCancel'=>true,'UrlCancel'=>'workflow/cancelwrite','isHelpModif'=>true));
?>
	<?php echo $form->textFieldGroup($model, 'wfname'); ?>
	<?php echo $form->textFieldGroup($model, 'wfdesc'); ?>
	<?php echo $form->textFieldGroup($model, 'wfminstat'); ?>
	<?php echo $form->textFieldGroup($model, 'wfmaxstat'); ?>
	<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
