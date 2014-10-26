<?php
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->breadcrumbs=array(
	Catalogsys::model()->getCatalog('admin')=>array('/admin'),
	Catalogsys::model()->getCatalog('groupmenu'));

?>
<script type="text/javascript">
function adddata()
{
	<?php echo CHtml::ajax(array(
		'url'=>array('groupmenu/create'),
		'data'=> "js:$(this).serialize()",
		'type'=>'post',
		'dataType'=>'json',
		'success'=>"function(data)
		{
			if (data.status == 'success')
			{
				$('#Groupmenu_groupmenuid').val('');
$('#Groupmenu_groupaccessid').val('');
$('#Groupmenu_menuaccessid').val('');
$('#groupname').val('');
$('#menuname').val('');
$('#Groupmenu_isread').prop('checked', false);
$('#Groupmenu_iswrite').prop('checked', false);
$('#Groupmenu_ispost').prop('checked', false);
$('#Groupmenu_isreject').prop('checked', false);
$('#Groupmenu_isupload').prop('checked', false);
$('#Groupmenu_isdownload').prop('checked', false);
$('#Groupmenu_ispurge').prop('checked', false);
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
			'url'=>array('groupmenu/update'),
			'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
			'type'=>'post',
			'dataType'=>'json',
			'success'=>"function(data)
			{
				if (data.status == 'success')
				{
				$('#Groupmenu_groupmenuid').val(data.groupmenuid);
$('#Groupmenu_groupaccessid').val(data.groupaccessid);
$('#Groupmenu_menuaccessid').val(data.menuaccessid);
$('#groupname').val(data.groupname);
$('#menuname').val(data.menuname);
if (data.isread == 1) 
			{ 
				$('#Groupmenu_isread').prop('checked', true); 
			} 
			else 
			{
				$('#Groupmenu_isread').prop('checked', false);
			}
if (data.iswrite == 1) 
			{ 
				$('#Groupmenu_iswrite').prop('checked', true); 
			} 
			else 
			{
				$('#Groupmenu_iswrite').prop('checked', false);
			}
			if (data.ispost == 1) 
			{ 
				$('#Groupmenu_ispost').prop('checked', true); 
			} 
			else 
			{
				$('#Groupmenu_ispost').prop('checked', false);
			}
						if (data.isreject == 1) 
			{ 
				$('#Groupmenu_isreject').prop('checked', true); 
			} 
			else 
			{
				$('#Groupmenu_isreject').prop('checked', false);
			}
									if (data.isupload == 1) 
			{ 
				$('#Groupmenu_isupload').prop('checked', true); 
			} 
			else 
			{
				$('#Groupmenu_isupload').prop('checked', false);
			}
												if (data.isdownload == 1) 
			{ 
				$('#Groupmenu_isdownload').prop('checked', true); 
			} 
			else 
			{
				$('#Groupmenu_isdownload').prop('checked', false);
			}
															if (data.ispurge == 1) 
			{ 
				$('#Groupmenu_ispurge').prop('checked', true); 
			} 
			else 
			{
				$('#Groupmenu_ispurge').prop('checked', false);
			}

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
			'url'=>array('groupmenu/delete'),
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
			'url'=>array('groupmenu/purge'),
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
	window.open('groupmenu/downpdf?id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<script type="text/javascript">
function downexcel() {
	window.open('groupmenu/downexcel?id='+$.fn.yiiGridView.getSelection("datagrid"));
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
			'url'=>array('groupmenu/history'),
			'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
			'type'=>'post',
			'dataType'=>'json',
			'success'=>"function(data)
			{
				$.fn.yiiGridView.update('translogdatagrid', {
					data: {
						'menuname': 'groupmenu',
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
        'title' => Catalogsys::model()->getCatalog('groupmenu'),
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
               'action'=>Yii::app()->createUrl('groupmenu/upload'),
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
    ),array('name'=>'groupmenuid', 'value'=>'$data->groupmenuid','htmlOptions'=>array('width'=>'1%')),array(
				'name'=>'groupaccessid',
				'type'=>'raw',
         'value'=>'($data->groupaccess!==null)?$data->groupaccess->groupname:""'
			),array(
				'name'=>'menuaccessid',
				'type'=>'raw',
         'value'=>'($data->menuaccess!==null)?$data->menuaccess->menuname:""'
			),array(
      'class'=>'CCheckBoxColumn',
      'name'=>'isread',
			'header'=>Catalogsys::model()->getCatalog('isread'),
      'selectableRows'=>'0',
      'checked'=>'$data->isread',
    ),array(
      'class'=>'CCheckBoxColumn',
      'name'=>'iswrite',
			'header'=>Catalogsys::model()->getCatalog('iswrite'),
      'selectableRows'=>'0',
      'checked'=>'$data->iswrite',
    ),array(
      'class'=>'CCheckBoxColumn',
      'name'=>'ispost',
			'header'=>Catalogsys::model()->getCatalog('ispost'),
      'selectableRows'=>'0',
      'checked'=>'$data->ispost',
    ),array(
      'class'=>'CCheckBoxColumn',
      'name'=>'isreject',
			'header'=>Catalogsys::model()->getCatalog('isreject'),
      'selectableRows'=>'0',
      'checked'=>'$data->isreject',
    ),array(
      'class'=>'CCheckBoxColumn',
      'name'=>'isupload',
			'header'=>Catalogsys::model()->getCatalog('isupload'),
      'selectableRows'=>'0',
      'checked'=>'$data->isupload',
    ),array(
      'class'=>'CCheckBoxColumn',
      'name'=>'isdownload',
			'header'=>Catalogsys::model()->getCatalog('isdownload'),
      'selectableRows'=>'0',
      'checked'=>'$data->isdownload',
    ),array(
      'class'=>'CCheckBoxColumn',
      'name'=>'ispurge',
			'header'=>Catalogsys::model()->getCatalog('ispurge'),
      'selectableRows'=>'0',
      'checked'=>'$data->ispurge',
    )
  ),
));
?>
<?php $this->endWidget(); ?>