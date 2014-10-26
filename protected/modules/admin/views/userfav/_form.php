<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'userfav-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'userfavid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'userfav/write',
	'isCancel'=>true,'UrlCancel'=>'userfav/cancelwrite','isHelpModif'=>true));
?>
		<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Userfav','IDField'=>'useraccessid','ColField'=>'username',
			'model'=>$model,'IDDialog'=>'useraccess_dialog','titledialog'=>'User Access',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.UseraccessPopUp','PopGrid'=>'useraccess-grid')); 
	?>	
			<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Userfav','IDField'=>'menuaccessid','ColField'=>'menuname',
			'model'=>$model,'IDDialog'=>'menuaccess_dialog','titledialog'=>'Menu Access',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.MenuaccessPopUp','PopGrid'=>'menuaccess-grid')); 
	?>	
<?php $this->endWidget(); ?>
