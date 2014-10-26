<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'wfgroup-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'wfgroupid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'wfgroup/write',
	'isCancel'=>true,'UrlCancel'=>'wfgroup/cancelwrite','isHelpModif'=>true));
?>
		<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Wfgroup','IDField'=>'workflowid','ColField'=>'wfdesc',
			'model'=>$model,'IDDialog'=>'workflow_dialog','titledialog'=>'Workflow',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.WorkflowPopUp','PopGrid'=>'workflow-grid')); 
	?>
			<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Wfgroup','IDField'=>'groupaccessid','ColField'=>'groupname',
			'model'=>$model,'IDDialog'=>'groupaccess_dialog','titledialog'=>'Group Access',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.GroupaccessPopUp','PopGrid'=>'groupaccess-grid')); 
	?>
	<?php echo $form->textFieldGroup($model, 'wfbefstat'); ?>
	<?php echo $form->textFieldGroup($model, 'wfrecstat'); ?>
<?php $this->endWidget(); ?>
