<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'themeid'); ?>
<?php echo $form->hiddenField($model,'themeid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'theme/writedetail',
	'isCancel'=>true,'UrlCancel'=>'theme/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'themename'); ?>
<?php echo $form->textFieldGroup($model, 'description'); ?>
<?php echo $form->textFieldGroup($model, 'themeprev'); ?>
<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
