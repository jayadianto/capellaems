<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'contacttypeid'); ?>
<?php echo $form->hiddenField($model,'contacttypeid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'contacttype/writedetail',
	'isCancel'=>true,'UrlCancel'=>'contacttype/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'contacttypename'); ?>
<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
