<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'catalogsysid'); ?>
<?php echo $form->hiddenField($model,'catalogsysid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'catalogsys/writedetail',
	'isCancel'=>true,'UrlCancel'=>'catalogsys/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'languageid'); ?>
<?php echo $form->textFieldGroup($model, 'catalogname'); ?>
<?php echo $form->textAreaGroup($model, 'catalogval'); ?>
<?php $this->endWidget(); ?>
