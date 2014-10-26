<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'menuaccess-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'menuaccessid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'menuaccess/write',
	'isCancel'=>true,'UrlCancel'=>'menuaccess/cancelwrite','isHelpModif'=>true));
?>
	<?php echo $form->textFieldGroup($model, 'menuname'); ?>
	<?php echo $form->textFieldGroup($model, 'description'); ?>
	<?php echo $form->textFieldGroup($model, 'menuurl'); ?>
	<?php echo $form->textFieldGroup($model, 'menuicon'); ?>
			<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Menuaccess','IDField'=>'parentid','ColField'=>'parentname',
			'model'=>$model,'IDDialog'=>'menuaccess_dialog','titledialog'=>'Menuaccess',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.MenuaccessPopUp','PopGrid'=>'menuaccess-grid')); 
	?>
			<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Menuaccess','IDField'=>'moduleid','ColField'=>'modulename',
			'model'=>$model,'IDDialog'=>'module_dialog','titledialog'=>'Modules',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.ModulesPopUp','PopGrid'=>'modules-grid')); 
	?>
	<?php echo $form->textFieldGroup($model, 'sortorder'); ?>
	<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
