<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'companyid'); ?>
<?php echo $form->hiddenField($model,'currencyid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'currency/writedetail',
	'isCancel'=>true,'UrlCancel'=>'currency/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'companyname'); ?>
<?php echo $form->textFieldGroup($model, 'address'); ?>
<?php echo $form->textFieldGroup($model, 'city'); ?>
<?php echo $form->textFieldGroup($model, 'zipcode'); ?>
<?php echo $form->textFieldGroup($model, 'taxno'); ?>
<?php echo $form->textFieldGroup($model, 'faxno'); ?>
<?php echo $form->textFieldGroup($model, 'phoneno'); ?>
<?php echo $form->textFieldGroup($model, 'webaddress'); ?>
<?php echo $form->textFieldGroup($model, 'email'); ?>
<?php echo $form->textFieldGroup($model, 'leftlogofile'); ?>
<?php echo $form->textFieldGroup($model, 'rightlogofile'); ?>
<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
