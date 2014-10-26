<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'useraccess-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'useraccessid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'useraccess/write',
	'isCancel'=>true,'UrlCancel'=>'useraccess/cancelwrite','isHelpModif'=>true));
?>
	<?php echo $form->textFieldGroup($model, 'username'); ?>
	<?php echo $form->textFieldGroup($model, 'realname'); ?>
	<?php echo $form->passwordFieldGroup($model, 'password'); ?>
	<?php echo $form->textFieldGroup($model, 'email'); ?>
	<?php echo $form->textFieldGroup($model, 'phoneno'); ?>
			<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Useraccess','IDField'=>'languageid','ColField'=>'languagename',
			'model'=>$model,'IDDialog'=>'language_dialog','titledialog'=>'Language',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.LanguagePopUp','PopGrid'=>'language-grid')); 
	?>	
			<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Useraccess','IDField'=>'themeid','ColField'=>'themename',
			'model'=>$model,'IDDialog'=>'theme_dialog','titledialog'=>'Theme',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.ThemePopUp','PopGrid'=>'theme-grid')); 
	?>	
	<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?> 
<?php $this->endWidget(); ?>
