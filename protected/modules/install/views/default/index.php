<?php $this->pageTitle=Yii::app()->name . ' - Installation' ?>
<?php
$this->widget(
    'booster.widgets.TbWizard',
    array(
        'type' => 'pills', // 'tabs' or 'pills'
        'tabs' => array(
            array(
                'label' => 'Mulai',
                'content' => $this->renderPartial('home',null,true),
                'active' => true
            ),
						array(
                'label' => 'Install Modul',
                'content' => $this->renderPartial('modul',array('modules'=>$modules),true),
            ),
						array(
                'label' => 'Selesai',
                'content' => $this->renderPartial('finish',null,true),
            ),
        ),
    )
);
?>