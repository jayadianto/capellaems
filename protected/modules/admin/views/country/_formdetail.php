<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'countryid'); ?>
<?php echo $form->hiddenField($model,'countryid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'country/writedetail',
	'isCancel'=>true,'UrlCancel'=>'country/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'countrycode'); ?>
<?php echo $form->textFieldGroup($model, 'countryname'); ?>
<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
