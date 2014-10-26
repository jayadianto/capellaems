<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'moduleid'); ?>
<?php echo $form->hiddenField($model,'moduleid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'modules/writedetail',
	'isCancel'=>true,'UrlCancel'=>'modules/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'modulename'); ?>
<?php echo $form->textFieldGroup($model, 'moduledesc'); ?>
<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
