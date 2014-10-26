<?php 
echo CHtml::openTag('div', array('class' => 'row-fluid'));
$this->widget(
    'booster.widgets.TbThumbnails',
    array(
        'dataProvider' => $modules,
        'template' => "{items}\n{pager}",
        'itemView' => 'application.modules.install.views.default.thumb',
    )
);
echo CHtml::closeTag('div');
?>