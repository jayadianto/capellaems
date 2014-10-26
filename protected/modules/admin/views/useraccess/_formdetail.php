<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'useraccessid'); ?>
<?php echo $form->hiddenField($model,'useraccessid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'useraccess/writedetail',
	'isCancel'=>true,'UrlCancel'=>'useraccess/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'username'); ?>
<?php echo $form->textFieldGroup($model, 'realname'); ?>
<?php echo echo $form->passwordFieldGroup($model, 'password'); ?>
<?php echo $form->textFieldGroup($model, 'email'); ?>
<?php echo $form->textFieldGroup($model, 'phoneno'); ?>
<?php echo $form->textFieldGroup($model, 'languageid'); ?>
<?php echo $form->textFieldGroup($model, 'themeid'); ?>
<?php echo $form->textFieldGroup($model, 'isonline'); ?>
<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
