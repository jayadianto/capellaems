<?php echo Catalogsys::model()->getcatalog('languagehelp'); ?>
<?php
$this->widget('ext.jwplayer.Jwplayer',array(
    'width'=>'auto',
    'height'=>360,
    'file'=>Yii::app()->baseUrl.'/images/language.flv', // the file of the player, if null we use demo file of jwplayer
    'options'=>array(
        'controlbar'=>'bottom'
    )
));
?>