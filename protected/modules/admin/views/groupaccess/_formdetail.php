<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'groupaccessid'); ?>
<?php echo $form->hiddenField($model,'groupaccessid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'groupaccess/writedetail',
	'isCancel'=>true,'UrlCancel'=>'groupaccess/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'groupname'); ?>
<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
