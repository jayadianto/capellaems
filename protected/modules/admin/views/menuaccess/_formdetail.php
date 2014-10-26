<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'menuaccessid'); ?>
<?php echo $form->hiddenField($model,'menuaccessid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'menuaccess/writedetail',
	'isCancel'=>true,'UrlCancel'=>'menuaccess/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'menuname'); ?>
<?php echo $form->textFieldGroup($model, 'description'); ?>
<?php echo $form->textFieldGroup($model, 'menuurl'); ?>
<?php echo $form->textFieldGroup($model, 'menuicon'); ?>
<?php echo $form->textFieldGroup($model, 'parentid'); ?>
<?php echo $form->textFieldGroup($model, 'moduleid'); ?>
<?php echo $form->textFieldGroup($model, 'sortorder'); ?>
<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
