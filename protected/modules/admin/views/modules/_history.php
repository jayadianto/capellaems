<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'translogdatagrid',
	'dataProvider'=>$translog->search(),
	'filter'=>$translog,
	'template'=>'{pager}<br>{items}{pager}',
	'pager' => array('cssFile' => Yii::app()->theme->baseUrl . '/css/pager.css'),
	'cssFile' => Yii::app()->theme->baseUrl . '/css/gridview.css',				
	'columns'=>array(
		'username',
		'createddate',
		'useraction',
		'newdata',
		'olddata'
	),
));?>