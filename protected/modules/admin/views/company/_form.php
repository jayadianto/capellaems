<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'company-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'companyid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'company/write',
	'isCancel'=>true,'UrlCancel'=>'company/cancelwrite','isHelpModif'=>true));
?>
	<?php echo $form->textFieldGroup($model, 'companyname'); ?>
	<?php echo $form->textFieldGroup($model, 'address'); ?>
	<?php echo $form->textFieldGroup($model, 'city'); ?>
	<?php echo $form->textFieldGroup($model, 'zipcode'); ?>
	<?php echo $form->textFieldGroup($model, 'taxno'); ?>
		<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Company','IDField'=>'currencyid','ColField'=>'currencyname',
			'model'=>$model,'IDDialog'=>'currency_dialog','titledialog'=>'Currency',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.CurrencyPopUp','PopGrid'=>'currency-grid')); 
	?>	
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
