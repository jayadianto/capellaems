<?php
$this->pageTitle=Yii::app()->name . ' - Sign Up';
$this->breadcrumbs=array(
	'Login'
);
?>
<?php $form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => 'verticalForm',
        'htmlOptions' => array('class' => 'well'), // for inset effect
    )
);
	echo $form->textFieldGroup($model, 'username');
	echo $form->passwordFieldGroup($model, 'password');
	echo $form->checkboxGroup($model, 'rememberMe');
	$this->widget(
    'booster.widgets.TbButton',
    array('buttonType' => 'submit', 'label' => 'Sign Up')
	);
$this->endWidget();
unset($form);?>