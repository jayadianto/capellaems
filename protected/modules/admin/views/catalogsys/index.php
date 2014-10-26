<?php
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->breadcrumbs=array(
	Catalogsys::model()->getCatalog('admin')=>array('/admin'),
	Catalogsys::model()->getCatalog('catalogsys'));

?>
<script type="text/javascript">
function adddata()
{
	<?php echo CHtml::ajax(array(
		'url'=>array('catalogsys/create'),
		'data'=> "js:$(this).serialize()",
		'type'=>'post',
		'dataType'=>'json',
		'success'=>"function(data)
		{
			if (data.status == 'success')
			{
				$('#Catalogsys_catalogsysid').val('');
$('#Catalogsys_languageid').val('');
$('#Catalogsys_catalogname').val('');
$('#Catalogsys_catalogval').val('');
$('#languagename').val('');


				$('#createdialog').dialog('open');
			}
			else
			{
				toastr.error(data.div);
			}
		} ",
		))?>;
	return false;
}
</script>
<script type="text/javascript">
function editdata()
{
	<?php
	echo CHtml::ajax(array(
			'url'=>array('catalogsys/update'),
			'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
			'type'=>'post',
			'dataType'=>'json',
			'success'=>"function(data)
			{
				if (data.status == 'success')
				{
				$('#Catalogsys_catalogsysid').val(data.catalogsysid);
$('#Catalogsys_languageid').val(data.languageid);
$('#Catalogsys_catalogname').val(data.catalogname);
$('#Catalogsys_catalogval').val(data.catalogval);
$('#languagename').val(data.languagename);


					$('#createdialog').dialog('open');
				}
				else
				{
					toastr.error(data.div);;
				}
			} ",
	))?>;
	return false;
}
</script>
<script type="text/javascript">
function deletedata()
{
	<?php
	echo CHtml::ajax(array(
			'url'=>array('catalogsys/delete'),
			'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
			'type'=>'post',
			'dataType'=>'json',
			'success'=>"function(data)
			{
				if (data.status == 'success')
				{
						refreshdata();
				}
				else
				{
					toastr.error(data.div);;
				}
			} ",
			))?>;
	return false;
}
</script>
<script type="text/javascript">
function purgedata()
{
	<?php
	echo CHtml::ajax(array(
			'url'=>array('catalogsys/purge'),
			'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
			'type'=>'post',
			'dataType'=>'json',
			'success'=>"function(data)
			{
				if (data.status == 'success')
				{
						refreshdata();
				}
				else
				{
					toastr.error(data.div);;
				}
			} ",
			))?>;
	return false;
}
</script>
<script type="text/javascript">
function refreshdata()
{
	$.fn.yiiGridView.update("datagrid");
	return false;
}
</script>
<script type="text/javascript">
function helpdata() {
	$('#helpdialog').dialog('open');
    return false;
}
</script>
<script type="text/javascript">
function helpmodifdata() {
	$('#helpmodifdialog').dialog('open');
    return false;
}
</script>
<script type="text/javascript">
function downpdf() {
	window.open('catalogsys/downpdf?id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<script type="text/javascript">
function downexcel() {
	window.open('catalogsys/downexcel?id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<script type="text/javascript">
function searchdata()
{
	$('#searchdialog').dialog('open');
    return false;
}
</script>
<script type="text/javascript">
function historydata()
{
	<?php
	echo CHtml::ajax(array(
			'url'=>array('catalogsys/history'),
			'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
			'type'=>'post',
			'dataType'=>'json',
			'success'=>"function(data)
			{
				$.fn.yiiGridView.update('translogdatagrid', {
					data: {
						'menuname': 'catalogsys',
							'tableid': data.id,
					}
				});
				$('#translogdialog').dialog('open');
			} ",
			))?>;
	return false;
}
</script><?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'createdialog',
    'options'=>array(
        'title'=>'Form Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<?php echo $this->renderPartial('_form', array('model'=>$model),true); ?>
<?php $this->endWidget();?>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'searchdialog',
    'options'=>array(
        'title'=>'Search Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<?php echo $this->renderPartial('_search',null,true); ?>
<?php $this->endWidget();?>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'helpdialog',
    'options'=>array(
        'title'=>'Help',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<?php echo $this->renderPartial('_help',null,true); ?>
<?php $this->endWidget();?>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'translogdialog',
    'options'=>array(
        'title'=>'History',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<?php echo $this->renderPartial('_history',array('translog'=>$translog),true); ?>
<?php $this->endWidget();?>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'helpmodifdialog',
    'options'=>array(
        'title'=>'Help',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<?php echo $this->renderPartial('_helpmodif',null,true); ?>
<?php $this->endWidget();?><?php
$this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => Catalogsys::model()->getCatalog('catalogsys'),
        'headerIcon' => 'th-list',
    	'padContent' => false,
        'htmlOptions' => array('class' => 'bootstrap-widget-table')
    )
);

 $this->widget('ToolbarButton',array('isCreate'=>true,
	'isSearch'=>true,'isDelete'=>true,'isEdit'=>true,'isPurge'=>true,
	'isDownload'=>true,'isRefresh'=>true,'isHistory'=>true,
	'isHelp'=>true,
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>'$.fn.yiiGridView.update("datagrid",{data:{pageSize: $(this).val() }})'));
?>
<?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
array(
        'id'=>'uploadFile',
        'config'=>array(
               'action'=>Yii::app()->createUrl('catalogsys/upload'),
               'allowedExtensions'=>array("csv"),
               'sizeLimit'=>10*1024*1024,
							 'onComplete'=>"js:function(id, fileName, responseJSON){ toastr.info(fileName); refreshdata(); }",
               'messages'=>array(
                                 'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                 'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                 'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                 'emptyError'=>"{file} is empty, please select files again without it.",
                                 'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                ),
               'showMessage'=>"js:function(message){ toastr.info(message); }"
              )
)); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datagrid',
	'dataProvider'=>$model->search(),
	'selectableRows'=>2,'template'=>'{pager}<br>{items}{pager}',
	'pager' => array('cssFile' => Yii::app()->theme->baseUrl . '/css/pager.css'),
	'cssFile' => Yii::app()->theme->baseUrl . '/css/gridview.css',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),array('name'=>'catalogsysid', 'value'=>'$data->catalogsysid','htmlOptions'=>array('width'=>'1%')),array(
				'name'=>'languageid',
				'type'=>'raw',
         'value'=>'($data->language!==null)?$data->language->languagename:""'
			),array(
				'name'=>'catalogname',
				'type'=>'raw',
         'value'=>'$data->catalogname'
			),array(
				'name'=>'catalogval',
				'type'=>'raw',
         'value'=>'$data->catalogval'
			)
  ),
));
?>
<?php $this->endWidget(); ?>