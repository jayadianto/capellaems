<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'groupmenuauth-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'groupmenuauthid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'groupmenuauth/write',
	'isCancel'=>true,'UrlCancel'=>'groupmenuauth/cancelwrite','isHelpModif'=>true));
?>
		<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Groupmenuauth','IDField'=>'groupaccessid','ColField'=>'groupname',
			'model'=>$model,'IDDialog'=>'groupaccess_dialog','titledialog'=>'Groupaccess',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.GroupaccessPopUp','PopGrid'=>'groupaccess-grid')); 
	?>
		<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Groupmenuauth','IDField'=>'menuauthid','ColField'=>'menuobject',
			'model'=>$model,'IDDialog'=>'menuauth_dialog','titledialog'=>'Menu Object',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.MenuauthPopUp','PopGrid'=>'menuauth-grid')); 
	?>
	<?php echo $form->textFieldGroup($model, 'menuvalueid'); ?>
<?php $this->endWidget(); ?>
