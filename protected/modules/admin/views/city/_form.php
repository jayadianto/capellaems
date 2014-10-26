<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'city-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'cityid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'city/write',
	'isCancel'=>true,'UrlCancel'=>'city/cancelwrite','isHelpModif'=>true));
?>
		<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'City','IDField'=>'provinceid','ColField'=>'provincename',
			'model'=>$model,'IDDialog'=>'province_dialog','titledialog'=>'Province',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.ProvincePopUp','PopGrid'=>'province-grid')); 
	?>
	<?php echo $form->textFieldGroup($model, 'citycode'); ?>
	<?php echo $form->textFieldGroup($model, 'cityname'); ?>
	<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
