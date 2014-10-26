<?php
$this->widget('ext.LiveGridView.RefreshGridView', array(
	'id'=>'gridtodo',
	'dataProvider'=>$model->Search(),
	'updatingTime'=>100000,
	'pager' => array('cssFile' => Yii::app()->theme->baseUrl . '/css/pager.css'),
	'cssFile' => Yii::app()->theme->baseUrl . '/css/gridview.css',	
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
		array(
      'name'=>'tododate',
      'type'=>'raw',
         'value'=>'(($data->tododate!==null)?date(Yii::app()->params["dateviewfromdb"], strtotime($data->tododate)):"")."<br/>".
				 $data->menuname."<br/>".
				 $data->description."<br/>".
				 $data->docno'
     ),    
	),
));
?>