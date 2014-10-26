<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'menuauthid'); ?>
<?php echo $form->hiddenField($model,'menuauthid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'menuauth/writedetail',
	'isCancel'=>true,'UrlCancel'=>'menuauth/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'menuobject'); ?>
<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
