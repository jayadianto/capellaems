<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'wfstatusid'); ?>
<?php echo $form->hiddenField($model,'wfstatusid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'wfstatus/writedetail',
	'isCancel'=>true,'UrlCancel'=>'wfstatus/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'workflowid'); ?>
<?php echo $form->textFieldGroup($model, 'wfstat'); ?>
<?php echo $form->textFieldGroup($model, 'wfstatusname'); ?>
<?php $this->endWidget(); ?>
