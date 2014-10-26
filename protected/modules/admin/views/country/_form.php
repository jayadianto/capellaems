<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'country-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'countryid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'country/write',
	'isCancel'=>true,'UrlCancel'=>'country/cancelwrite','isHelpModif'=>true));
?>
	<?php echo $form->textFieldGroup($model, 'countrycode'); ?>
	<?php echo $form->textFieldGroup($model, 'countryname'); ?>
	<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
