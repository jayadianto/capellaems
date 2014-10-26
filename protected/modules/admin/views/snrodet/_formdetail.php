<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'snrodid'); ?>
<?php echo $form->hiddenField($model,'snrodid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'snrodet/writedetail',
	'isCancel'=>true,'UrlCancel'=>'snrodet/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'snroid'); ?>
<?php echo $form->textFieldGroup($model, 'curdd'); ?>
<?php echo $form->textFieldGroup($model, 'curmm'); ?>
<?php echo $form->textFieldGroup($model, 'curyy'); ?>
<?php echo $form->textFieldGroup($model, 'curvalue'); ?>
<?php echo $form->textFieldGroup($model, 'curcc'); ?>
<?php echo $form->textFieldGroup($model, 'curpt'); ?>
<?php echo $form->textFieldGroup($model, 'curpp'); ?>
<?php $this->endWidget(); ?>
