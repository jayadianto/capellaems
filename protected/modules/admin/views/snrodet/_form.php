<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'snrodet-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'snrodid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'snrodet/write',
	'isCancel'=>true,'UrlCancel'=>'snrodet/cancelwrite','isHelpModif'=>true));
?>
		<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Snrodet','IDField'=>'snroid','ColField'=>'description',
			'model'=>$model,'IDDialog'=>'snro_dialog','titledialog'=>'SNRO',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.SnroPopUp','PopGrid'=>'snro-grid')); 
	?>
	<?php echo $form->textFieldGroup($model, 'curdd'); ?>
	<?php echo $form->textFieldGroup($model, 'curmm'); ?>
	<?php echo $form->textFieldGroup($model, 'curyy'); ?>
	<?php echo $form->textFieldGroup($model, 'curvalue'); ?>
	<?php echo $form->textFieldGroup($model, 'curcc'); ?>
	<?php echo $form->textFieldGroup($model, 'curpt'); ?>
	<?php echo $form->textFieldGroup($model, 'curpp'); ?>
<?php $this->endWidget(); ?>
