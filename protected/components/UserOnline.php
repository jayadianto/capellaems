<?php
Yii::import('zii.widgets.CPortlet');
class UserOnline extends CPortlet
{
    protected function renderContent()
    {
				   $this->render('UserOnline');
    }
}