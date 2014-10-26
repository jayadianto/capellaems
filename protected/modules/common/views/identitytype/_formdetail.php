<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'identitytypeid'); ?>
<?php echo $form->hiddenField($model,'identitytypeid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'identitytype/writedetail',
	'isCancel'=>true,'UrlCancel'=>'identitytype/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'identitytypename'); ?>
<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
