<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'wfgroupid'); ?>
<?php echo $form->hiddenField($model,'wfgroupid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'wfgroup/writedetail',
	'isCancel'=>true,'UrlCancel'=>'wfgroup/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'workflowid'); ?>
<?php echo $form->textFieldGroup($model, 'groupaccessid'); ?>
<?php echo $form->textFieldGroup($model, 'wfbefstat'); ?>
<?php echo $form->textFieldGroup($model, 'wfrecstat'); ?>
<?php $this->endWidget(); ?>
