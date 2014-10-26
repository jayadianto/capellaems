<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'groupmenu-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'groupmenuid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'groupmenu/write',
	'isCancel'=>true,'UrlCancel'=>'groupmenu/cancelwrite','isHelpModif'=>true));
?>
		<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Groupmenu','IDField'=>'groupaccessid','ColField'=>'groupname',
			'model'=>$model,'IDDialog'=>'groupaccess_dialog','titledialog'=>'Group Access',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.GroupaccessPopUp','PopGrid'=>'groupaccess-grid')); 
	?>	
		<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Groupmenu','IDField'=>'menuaccessid','ColField'=>'menuname',
			'model'=>$model,'IDDialog'=>'menuaccess_dialog','titledialog'=>'Menu Access',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.MenuaccessPopUp','PopGrid'=>'menuaccess-grid')); 
	?>	
		<?php echo $form->checkBoxGroup(
            $model,
            'isread'
        ); ?> 
					<?php echo $form->checkBoxGroup(
            $model,
            'iswrite'
        ); ?> 
					<?php echo $form->checkBoxGroup(
            $model,
            'ispost'
        ); ?> 
					<?php echo $form->checkBoxGroup(
            $model,
            'isreject'
        ); ?> 
					<?php echo $form->checkBoxGroup(
            $model,
            'isupload'
        ); ?> 
					<?php echo $form->checkBoxGroup(
            $model,
            'isdownload'
        ); ?> 
					<?php echo $form->checkBoxGroup(
            $model,
            'ispurge'
        ); ?> 
<?php $this->endWidget(); ?>
