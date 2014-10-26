<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'workflowid'); ?>
<?php echo $form->hiddenField($model,'workflowid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'workflow/writedetail',
	'isCancel'=>true,'UrlCancel'=>'workflow/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'wfname'); ?>
<?php echo $form->textFieldGroup($model, 'wfdesc'); ?>
<?php echo $form->textFieldGroup($model, 'wfminstat'); ?>
<?php echo $form->textFieldGroup($model, 'wfmaxstat'); ?>
<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
