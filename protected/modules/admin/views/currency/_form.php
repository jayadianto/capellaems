<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'currency-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'currencyid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'currency/write',
	'isCancel'=>true,'UrlCancel'=>'currency/cancelwrite','isHelpModif'=>true));
?>
		<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Currency','IDField'=>'countryid','ColField'=>'countryname',
			'model'=>$model,'IDDialog'=>'country_dialog','titledialog'=>'Country',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.CountryPopUp','PopGrid'=>'country-grid')); 
	?>
	<?php echo $form->textFieldGroup($model, 'currencyname'); ?>
	<?php echo $form->textFieldGroup($model, 'symbol'); ?>
	<?php echo $form->textFieldGroup($model, 'i18n'); ?>
	<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
