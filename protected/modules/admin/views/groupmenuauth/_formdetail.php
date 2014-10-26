<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'groupmenuauthid'); ?>
<?php echo $form->hiddenField($model,'groupmenuauthid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'groupmenuauth/writedetail',
	'isCancel'=>true,'UrlCancel'=>'groupmenuauth/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'groupaccessid'); ?>
<?php echo $form->textFieldGroup($model, 'menuauthid'); ?>
<?php echo $form->textFieldGroup($model, 'menuvalueid'); ?>
<?php $this->endWidget(); ?>
