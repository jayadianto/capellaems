<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'cityid'); ?>
<?php echo $form->hiddenField($model,'cityid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'city/writedetail',
	'isCancel'=>true,'UrlCancel'=>'city/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'provinceid'); ?>
<?php echo $form->textFieldGroup($model, 'citycode'); ?>
<?php echo $form->textFieldGroup($model, 'cityname'); ?>
<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
