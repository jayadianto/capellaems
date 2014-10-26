<?php
$this->pageTitle=Yii::app()->name . ' - Sign Up';
$this->breadcrumbs=array(
	'Sign Up'
);
?>
<?php $form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => 'verticalForm',
        'htmlOptions' => array('class' => 'well'), // for inset effect
    )
);
	echo $form->textFieldGroup($model, 'realname');
	echo $form->textFieldGroup($model, 'username');
	echo $form->passwordFieldGroup($model, 'password');
	echo $form->textFieldGroup($model, 'email');
	echo $form->dropDownListGroup(
			$model,
			'languageid',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
	   			'widgetOptions' => array(
	   				'data' => CHtml::listData(Language::model()->findAll(), 
                'languageid', 'languagename')
				)
			)
		); 
	echo $form->dropDownListGroup(
			$model,
			'themeid',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
	   			'widgetOptions' => array(
	   				'data' => CHtml::listData(Theme::model()->findAll(), 
                'themeid', 'themename')
				)
			)
		); 
	$this->widget(
    'booster.widgets.TbButton',
    array('buttonType' => 'submit', 'label' => 'Sign Up')
	);
$this->endWidget();
unset($form);?>