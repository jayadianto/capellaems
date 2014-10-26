<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'userfavid'); ?>
<?php echo $form->hiddenField($model,'userfavid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'userfav/writedetail',
	'isCancel'=>true,'UrlCancel'=>'userfav/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'useraccessid'); ?>
<?php echo $form->textFieldGroup($model, 'menuaccessid'); ?>
<?php $this->endWidget(); ?>
