<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'groupmenuid'); ?>
<?php echo $form->hiddenField($model,'groupmenuid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'groupmenu/writedetail',
	'isCancel'=>true,'UrlCancel'=>'groupmenu/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'groupaccessid'); ?>
<?php echo $form->textFieldGroup($model, 'menuaccessid'); ?>
<?php echo $form->textFieldGroup($model, 'isread'); ?>
<?php echo $form->textFieldGroup($model, 'iswrite'); ?>
<?php echo $form->textFieldGroup($model, 'ispost'); ?>
<?php echo $form->textFieldGroup($model, 'isreject'); ?>
<?php echo $form->textFieldGroup($model, 'isupload'); ?>
<?php echo $form->textFieldGroup($model, 'isdownload'); ?>
<?php echo $form->textFieldGroup($model, 'ispurge'); ?>
<?php $this->endWidget(); ?>
