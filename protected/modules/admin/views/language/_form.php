<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
		<?php echo $form->hiddenField($model,'languageid'); ?>
				<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'language/write',
'isCancel'=>true,'UrlCancel'=>'language/cancelwrite','isHelpModif'=>true));
?>
		<?php echo $form->textFieldGroup($model, 'languagename'); ?>
		<?php echo $form->checkBoxGroup(
            $model,
            'recordstatus'
        ); ?>
<?php $this->endWidget(); ?>
