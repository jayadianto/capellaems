<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'province-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'provinceid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'province/write',
	'isCancel'=>true,'UrlCancel'=>'province/cancelwrite','isHelpModif'=>true));
?>
	<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Province','IDField'=>'countryid','ColField'=>'countryname',
			'model'=>$model,'IDDialog'=>'country_dialog','titledialog'=>'Country',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.CountryPopUp','PopGrid'=>'country-grid')); 
	?>
	<?php echo $form->textFieldGroup($model, 'provincecode'); ?>
	<?php echo $form->textFieldGroup($model, 'provincename'); ?>
	<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
