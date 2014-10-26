<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'parameterid'); ?>
<?php echo $form->hiddenField($model,'parameterid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'parameter/writedetail',
	'isCancel'=>true,'UrlCancel'=>'parameter/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'paramname'); ?>
<?php echo $form->textFieldGroup($model, 'paramvalue'); ?>
<?php echo $form->textFieldGroup($model, 'description'); ?>
<?php echo $form->textFieldGroup($model, 'moduleid'); ?>
<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
