<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'provinceid'); ?>
<?php echo $form->hiddenField($model,'provinceid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'province/writedetail',
	'isCancel'=>true,'UrlCancel'=>'province/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'countryid'); ?>
<?php echo $form->textFieldGroup($model, 'provincecode'); ?>
<?php echo $form->textFieldGroup($model, 'provincename'); ?>
<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
