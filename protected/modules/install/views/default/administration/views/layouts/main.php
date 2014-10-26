<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap<?php echo (!YII_DEBUG ? ".min" : "") . ".css"; ?>"/>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<?php 
$this->widget(
    'booster.widgets.TbNavbar',
    array(
        'brand' => 'Capella EMS Indonesia',
        'fixed' => false,
    	'fluid' => true,
        'items' => array(
            array(
                'class' => 'booster.widgets.TbMenu',
            	'type' => 'navbar',
                'items' => Menuaccess::model()->getItems()
            )
        )
    )
);?>
<div class="container">
		<?php echo $content?>
</div>
<?php
    $this->widget('ext.etoastr.EToastr',array(
        'flashMessagesOnly'=>true, 
        'message'=>'will be ignored', 
        'options'=>array(
            'positionClass'=>'toast-bottom-full-width',
            'fadeOut'   =>  1000,
            'timeOut'   =>  5000,
            'fadeIn'    =>  1000
            )
        ));
    ?>
</body>
</html>
