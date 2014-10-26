<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<?php echo $form->hiddenField($model,'addresstypeid'); ?>
<?php echo $form->hiddenField($model,'addresstypeid'); ?><?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'addresstype/writedetail',
	'isCancel'=>true,'UrlCancel'=>'addresstype/cancelwritedetail','isHelpForm'=>true,'UrlHelp'=>'helpmodifdata()',
	'DialogID'=>'detaildialog','DialogGrid'=>'detaildatagrid'));
?>
<?php echo $form->textFieldGroup($model, 'addresstypename'); ?>
<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
