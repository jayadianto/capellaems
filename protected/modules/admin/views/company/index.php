<?php
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->breadcrumbs=array(
	Catalogsys::model()->getCatalog('admin')=>array('/admin'),
	Catalogsys::model()->getCatalog('company'));

?>
<script type="text/javascript">
function adddata()
{
	<?php echo CHtml::ajax(array(
		'url'=>array('company/create'),
		'data'=> "js:$(this).serialize()",
		'type'=>'post',
		'dataType'=>'json',
		'success'=>"function(data)
		{
			if (data.status == 'success')
			{
				$('#Company_companyid').val('');
$('#Company_companyname').val('');
$('#Company_address').val('');
$('#Company_city').val('');
$('#Company_zipcode').val('');
$('#Company_taxno').val('');
$('#Company_currencyid').val('');
$('#Company_faxno').val('');
$('#Company_phoneno').val('');
$('#Company_webaddress').val('');
$('#Company_email').val('');
$('#Company_leftlogofile').val('');
$('#Company_rightlogofile').val('');
$('#Company_recordstatus').prop('checked', false);

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
			'url'=>array('company/update'),
			'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
			'type'=>'post',
			'dataType'=>'json',
			'success'=>"function(data)
			{
				if (data.status == 'success')
				{
				$('#Company_companyid').val(data.companyid);
$('#Company_companyname').val(data.companyname);
$('#Company_address').val(data.address);
$('#Company_city').val(data.city);
$('#Company_zipcode').val(data.zipcode);
$('#Company_taxno').val(data.taxno);
$('#Company_currencyid').val(data.currencyid);
$('#currencyname').val(data.currencyname);
$('#Company_faxno').val(data.faxno);
$('#Company_phoneno').val(data.phoneno);
$('#Company_webaddress').val(data.webaddress);
$('#Company_email').val(data.email);
$('#Company_leftlogofile').val(data.leftlogofile);
$('#Company_rightlogofile').val(data.rightlogofile);
if (data.recordstatus == 1) 
			{ 
				$('#Company_recordstatus').prop('checked', true); 
			} 
			else 
			{
				$('#Company_recordstatus').prop('checked', false);
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
			'url'=>array('company/delete'),
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
function deletedata()
{
	<?php
	echo CHtml::ajax(array(
			'url'=>array('company/purge'),
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
			'url'=>array('company/purge'),
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
	window.open('company/downpdf?id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<script type="text/javascript">
function downexcel() {
	window.open('company/downexcel?id='+$.fn.yiiGridView.getSelection("datagrid"));
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
			'url'=>array('company/history'),
			'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
			'type'=>'post',
			'dataType'=>'json',
			'success'=>"function(data)
			{
				$.fn.yiiGridView.update('translogdatagrid', {
					data: {
						'menuname': 'company',
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
        'title' => Catalogsys::model()->getCatalog('company'),
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
               'action'=>Yii::app()->createUrl('company/upload'),
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
    ),array('name'=>'companyid', 'value'=>'$data->companyid','htmlOptions'=>array('width'=>'1%')),array(
				'name'=>'companyname',
				'type'=>'raw',
         'value'=>'$data->companyname'
			),array(
				'name'=>'address',
				'type'=>'raw',
         'value'=>'$data->address'
			),array(
				'name'=>'city',
				'type'=>'raw',
         'value'=>'$data->city'
			),array(
				'name'=>'zipcode',
				'type'=>'raw',
         'value'=>'$data->zipcode'
			),array(
				'name'=>'taxno',
				'type'=>'raw',
         'value'=>'$data->taxno'
			),array(
				'name'=>'currencyid',
				'type'=>'raw',
         'value'=>'($data->currency!==null)?$data->currency->currencyname:""'
			),array(
				'name'=>'faxno',
				'type'=>'raw',
         'value'=>'$data->faxno'
			),array(
				'name'=>'phoneno',
				'type'=>'raw',
         'value'=>'$data->phoneno'
			)
			,array(
      'class'=>'CCheckBoxColumn',
      'name'=>'recordstatus',
						'header'=>Catalogsys::model()->getCatalog('recordstatus'),
      'selectableRows'=>'0',
      'checked'=>'$data->recordstatus',
    )
  ),
));
?>
<?php $this->endWidget(); ?>