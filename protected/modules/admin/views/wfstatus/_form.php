<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'wfstatus-form',
	'type'=>'horizontal',
)); ?>
<?php echo $form->hiddenField($model,'wfstatusid'); ?>
<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'wfstatus/write',
	'isCancel'=>true,'UrlCancel'=>'wfstatus/cancelwrite','isHelpModif'=>true));
?>
		<?php $this->widget('DataPopUp',
		array('id'=>'Widget','Prefix'=>'Wfstatus','IDField'=>'workflowid','ColField'=>'wfdesc',
			'model'=>$model,'IDDialog'=>'workflow_dialog','titledialog'=>'Workflow',
			'form'=>$form,'PopUpName'=>'application.modules.admin.components.views.WorkflowPopUp','PopGrid'=>'workflow-grid')); 
	?>	
	<?php echo $form->textFieldGroup($model, 'wfstat'); ?>
	<?php echo $form->textFieldGroup($model, 'wfstatusname'); ?>
<?php $this->endWidget(); ?>
