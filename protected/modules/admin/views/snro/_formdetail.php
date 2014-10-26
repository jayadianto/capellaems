<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'snroid'); ?>
<?php echo $form->hiddenField($model,'snroid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'snro/writedetail',
	'isCancel'=>true,'UrlCancel'=>'snro/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'description'); ?>
<?php echo $form->textFieldGroup($model, 'formatdoc'); ?>
<?php echo $form->textFieldGroup($model, 'formatno'); ?>
<?php echo $form->textFieldGroup($model, 'repeatby'); ?>
<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
