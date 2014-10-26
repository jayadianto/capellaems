<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'parameter-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'parameterid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'parameter/write',
	'isCancel'=>true,'UrlCancel'=>'parameter/cancelwrite','isHelpModif'=>true));
?>
	<?php echo $form->textFieldGroup($model, 'paramname'); ?>
	<?php echo $form->textFieldGroup($model, 'paramvalue'); ?>
	<?php echo $form->textFieldGroup($model, 'description'); ?>
		<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Parameter','IDField'=>'moduleid','ColField'=>'modulename',
			'model'=>$model,'IDDialog'=>'module_dialog','titledialog'=>'Module',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.ModulesPopUp','PopGrid'=>'module-grid')); 
	?>	
	<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
