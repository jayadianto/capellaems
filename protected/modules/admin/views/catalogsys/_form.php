<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'catalogsys-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'catalogsysid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'catalogsys/write',
	'isCancel'=>true,'UrlCancel'=>'catalogsys/cancelwrite','isHelpModif'=>true));
?>
		<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Catalogsys','IDField'=>'languageid','ColField'=>'languagename',
			'model'=>$model,'IDDialog'=>'language_dialog','titledialog'=>'Language',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.LanguagePopUp','PopGrid'=>'language-grid')); 
	?>	
	<?php echo $form->textFieldGroup($model, 'catalogname'); ?>
	<?php echo $form->textAreaGroup($model, 'catalogval'); ?>
<?php $this->endWidget(); ?>
