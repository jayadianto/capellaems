<?php 
$emptykolom = '';$kolom='';$detailkol = '';
foreach($this->tableSchema->columns as $column)
{
	if ($emptykolom == '')
	{
		if (($column->autoIncrement) && ($this->isdetail == 1))
		{
			$detailkol = "\$.fn.yiiGridView.update('detaildatagrid', {
                    data: {
                        '".$this->modeldetail."[".$column->name."]': data.$column->name
                    }});
										$('#".$this->modeldetail."_".$column->name."').val(data.$column->name);\n";
		}
		if ($column->type==='boolean' || $column->name === 'recordstatus')
		{
			$emptykolom = "$('#".$this->model."_".$column->name."').prop('checked', false);\n";
			$kolom = "if (data.".$column->name." == 1) 
			{ 
				$('#".$this->model."_".$column->name."').prop('checked', true); 
			} 
			else 
			{
				$('#".$this->model."_".$column->name."').prop('checked', false);
			}\n";
		}
		else
		{
			$emptykolom = "$('#".$this->model."_".$column->name."').val('');\n";
			$kolom = "$('#".$this->model."_".$column->name."').val(data.".$column->name.");\n";
		}
	}
	else
	{
		if ($column->type==='boolean' || $column->name === 'recordstatus')
		{
			$emptykolom .= "$('#".$this->model."_".$column->name."').prop('checked', false);";
			$kolom .= "if (data.".$column->name." == 1) 
			{ 
				$('#".$this->model."_".$column->name."').prop('checked', true); 
			} 
			else 
			{
				$('#".$this->model."_".$column->name."').prop('checked', false);
			}\n";
		}
		else
		{
			$emptykolom .= "$('#".$this->model."_".$column->name."').val('');\n";
			$kolom .= "$('#".$this->model."_".$column->name."').val(data.".$column->name.");\n";
		}
	}
}
echo "<?php
\$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
\$this->breadcrumbs=array(
	Catalogsys::model()->getCatalog('admin')=>array('/admin'),
	Catalogsys::model()->getCatalog('".$this->controller."'));

?>
<script type=\"text/javascript\">
function adddata()
{
	<?php echo CHtml::ajax(array(
		'url'=>array('".$this->controller."/create'),
		'data'=> \"js:$(this).serialize()\",
		'type'=>'post',
		'dataType'=>'json',
		'success'=>\"function(data)
		{
			if (data.status == 'success')
			{
				".$emptykolom."\n".
				$detailkol."
				$('#createdialog').dialog('open');
			}
			else
			{
				toastr.error(data.div);
			}
		} \",
		))?>;
	return false;
}
</script>
<script type=\"text/javascript\">
function editdata()
{
	<?php
	echo CHtml::ajax(array(
			'url'=>array('".$this->controller."/update'),
			'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection(\"datagrid\")'),
			'type'=>'post',
			'dataType'=>'json',
			'success'=>\"function(data)
			{
				if (data.status == 'success')
				{
				".$kolom."\n".
				$detailkol."
					$('#createdialog').dialog('open');
				}
				else
				{
					toastr.error(data.div);;
				}
			} \",
	))?>;
	return false;
}
</script>
<script type=\"text/javascript\">
function deletedata()
{
	<?php
	echo CHtml::ajax(array(
			'url'=>array('".$this->controller."/delete'),
			'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection(\"datagrid\")'),
			'type'=>'post',
			'dataType'=>'json',
			'success'=>\"function(data)
			{
				if (data.status == 'success')
				{
						refreshdata();
				}
				else
				{
					toastr.error(data.div);;
				}
			} \",
			))?>;
	return false;
}
</script>
<script type=\"text/javascript\">
function purgedata()
{
	<?php
	echo CHtml::ajax(array(
			'url'=>array('".$this->controller."/purge'),
			'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection(\"datagrid\")'),
			'type'=>'post',
			'dataType'=>'json',
			'success'=>\"function(data)
			{
				if (data.status == 'success')
				{
						refreshdata();
				}
				else
				{
					toastr.error(data.div);;
				}
			} \",
			))?>;
	return false;
}
</script>
<script type=\"text/javascript\">
function refreshdata()
{
	\$.fn.yiiGridView.update(\"datagrid\");
	return false;
}
</script>
<script type=\"text/javascript\">
function helpdata() {
	$('#helpdialog').dialog('open');
    return false;
}
</script>
<script type=\"text/javascript\">
function helpmodifdata() {
	$('#helpmodifdialog').dialog('open');
    return false;
}
</script>
<script type=\"text/javascript\">
function downpdf() {
	window.open('".$this->controller."/downpdf?id='+$.fn.yiiGridView.getSelection(\"datagrid\"));
}
</script>
<script type=\"text/javascript\">
function downexcel() {
	window.open('".$this->controller."/downexcel?id='+$.fn.yiiGridView.getSelection(\"datagrid\"));
}
</script>
<script type=\"text/javascript\">
function searchdata()
{
	$('#searchdialog').dialog('open');
    return false;
}
</script>
<script type=\"text/javascript\">
function historydata()
{
	<?php
	echo CHtml::ajax(array(
			'url'=>array('".$this->controller."/history'),
			'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection(\"datagrid\")'),
			'type'=>'post',
			'dataType'=>'json',
			'success'=>\"function(data)
			{
				$.fn.yiiGridView.update('translogdatagrid', {
					data: {
						'menuname': '".$this->controller."',
							'tableid': data.id,
					}
				});
				$('#translogdialog').dialog('open');
			} \",
			))?>;
	return false;
}
</script>";
if ($this->isdetail == 1)
{
echo "
<script type=\"text/javascript\">
function showdetail() {
    $.fn.yiiGridView.update('indatagrid', {
                    data: {
                        '".$this->modeldetail."[".$this->getModelID()."]': $.fn.yiiGridView.getSelection(\"datagrid\")[0]
                    }
                });
    return false;
}
</script>";
}
echo "<?php \$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'createdialog',
    'options'=>array(
        'title'=>'Form Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<?php echo \$this->renderPartial('_form', array('model'=>\$model";
if ($this->isdetail == 1)
{
	echo ",'".$this->modeldetail."'=>$".$this->modeldetail;
}
echo "),true); ?>
<?php \$this->endWidget();?>
<?php \$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'searchdialog',
    'options'=>array(
        'title'=>'Search Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<?php echo \$this->renderPartial('_search',null,true); ?>
<?php \$this->endWidget();?>
<?php \$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'helpdialog',
    'options'=>array(
        'title'=>'Help',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<?php echo \$this->renderPartial('_help',null,true); ?>
<?php \$this->endWidget();?>
<?php \$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'translogdialog',
    'options'=>array(
        'title'=>'History',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<?php echo \$this->renderPartial('_history',array('translog'=>\$translog),true); ?>
<?php \$this->endWidget();?>
<?php \$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'helpmodifdialog',
    'options'=>array(
        'title'=>'Help',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<?php echo \$this->renderPartial('_helpmodif',null,true); ?>
<?php \$this->endWidget();?>";?>
<?php 
$kolom = '';$dkolom = '';
foreach($this->tableSchema->columns as $column)
{
	if ($kolom == '')
	{
		if($column->autoIncrement)
		{
				$kolom = "array('name'=>'".$column->name."', 'value'=>'\$data->$column->name','htmlOptions'=>array('width'=>'1%'))";
		}
		else
		if (stripos($column->dbType,'date')!==false)
		{
			$kolom = "array(
				'name'=>'".$column->name."',
				'type'=>'raw',
         'value'=>'(\$data->$column->name!==null)?date(Yii::app()->params[\"dateviewfromdb\"], strtotime(\$data->$column->name)):\"\"'
			)";
		}
		else
		if ($column->type==='boolean' || $column->name === 'recordstatus')
		{
			$kolom = "
			array(
      'class'=>'CCheckBoxColumn',
      'name'=>'".$column->name."',
			'header'=>Catalogsys::model()->getCatalog(".$column->name."),
      'selectableRows'=>'0',
      'checked'=>'\$data->$column->name',
    )";
		}
		else
		{
			$kolom = "array(
				'name'=>'".$column->name."',
				'type'=>'raw',
         'value'=>'\$data->$column->name'
			)";
		}
	}
	else
	{
		if($column->autoIncrement)
		{
				$kolom .= ",array('name'=>'".$column->name."', 'value'=>'\$data->$column->name','htmlOptions'=>array('width'=>'1%'))";
		}
		else
		if (stripos($column->dbType,'date')!==false)
		{
			$kolom .= ",array(
				'name'=>'".$column->name."',
				'type'=>'raw',
         'value'=>'(\$data->$column->name!==null)?date(Yii::app()->params[\"dateviewfromdb\"], strtotime(\$data->$column->name)):\"\"'
			)";
		}
		else
		if ($column->type==='boolean' || $column->name === 'recordstatus')
		{
			$kolom .= "
			,array(
      'class'=>'CCheckBoxColumn',
      'name'=>'".$column->name."',
						'header'=>Catalogsys::model()->getCatalog('".$column->name."'),
      'selectableRows'=>'0',
      'checked'=>'\$data->$column->name',
    )";
		}
		else
		{
			$kolom .= ",array(
				'name'=>'".$column->name."',
				'type'=>'raw',
         'value'=>'\$data->$column->name'
			)";
		}
	}
}
foreach($this->tableDetailSchema->columns as $column)
{
	if ($dkolom == '')
	{
		if($column->autoIncrement)
		{
				continue;
		}
		else
		if ($column->name == $this->getModelID())
		{
			continue;
			}
			else
		if (stripos($column->dbType,'date')!==false)
		{
			$dkolom = "array(
				'name'=>'".$column->name."',
				'type'=>'raw',
         'value'=>'(\$data->$column->name!==null)?date(Yii::app()->params[\"dateviewfromdb\"], strtotime(\$data->$column->name)):\"\"'
			)";
		}
		else
		if ($column->type==='boolean' || $column->name === 'recordstatus')
		{
			$dkolom = "
			array(
      'class'=>'CCheckBoxColumn',
      'name'=>'".$column->name."',
			'header'=>'".$column->name."',
      'selectableRows'=>'0',
      'checked'=>'\$data->$column->name',
    )";
		}
		else
		{
			$dkolom = "array(
				'name'=>'".$column->name."',
				'type'=>'raw',
         'value'=>'\$data->$column->name'
			)";
		}
	}
	else
	{
		if($column->autoIncrement)
		{
				continue;
		}
		else
		if (stripos($column->dbType,'date')!==false)
		{
			$dkolom .= ",array(
				'name'=>'".$column->name."',
				'type'=>'raw',
         'value'=>'(\$data->$column->name!==null)?date(Yii::app()->params[\"dateviewfromdb\"], strtotime(\$data->$column->name)):\"\"'
			)";
		}
		else
		if ($column->type==='boolean' || $column->name === 'recordstatus')
		{
			$dkolom .= "
			,array(
      'class'=>'CCheckBoxColumn',
      'name'=>'".$column->name."',
						'header'=>'".$column->name."',
      'selectableRows'=>'0',
      'checked'=>'\$data->$column->name',
    )";
		}
		else
		{
			$dkolom .= ",array(
				'name'=>'".$column->name."',
				'type'=>'raw',
         'value'=>'\$data->$column->name'
			)";
		}
	}
}
echo "<?php
\$this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => Catalogsys::model()->getCatalog('".$this->controller."'),
        'headerIcon' => 'th-list',
    	'padContent' => false,
        'htmlOptions' => array('class' => 'bootstrap-widget-table')
    )
);

 \$this->widget('ToolbarButton',array('isCreate'=>true,
	'isSearch'=>true,'isDelete'=>true,'isEdit'=>true,'isPurge'=>true,
	'isDownload'=>true,'isRefresh'=>true,'isHistory'=>true,
	'isHelp'=>true,
	'isRecordPage'=>true,'PageSize'=>\$pageSize,'OnChange'=>'$.fn.yiiGridView.update(\"datagrid\",{data:{pageSize: $(this).val() }})'));
?>
<?php \$this->widget('ext.EAjaxUpload.EAjaxUpload',
array(
        'id'=>'uploadFile',
        'config'=>array(
               'action'=>Yii::app()->createUrl('".$this->controller."/upload'),
               'allowedExtensions'=>array(\"csv\"),
               'sizeLimit'=>10*1024*1024,
							 'onComplete'=>\"js:function(id, fileName, responseJSON){ toastr.info(fileName); refreshdata(); }\",
               'messages'=>array(
                                 'typeError'=>\"{file} has invalid extension. Only {extensions} are allowed.\",
                                 'sizeError'=>\"{file} is too large, maximum file size is {sizeLimit}.\",
                                 'minSizeError'=>\"{file} is too small, minimum file size is {minSizeLimit}.\",
                                 'emptyError'=>\"{file} is empty, please select files again without it.\",
                                 'onLeave'=>\"The files are being uploaded, if you leave now the upload will be cancelled.\"
                                ),
               'showMessage'=>\"js:function(message){ toastr.info(message); }\"
              )
)); ?>
<?php
\$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datagrid',
	'dataProvider'=>\$model->search(),
	'selectableRows'=>2,";
	if ($this->isdetail == 1)
	{
	echo "
	'selectionChanged'=>'showdetail',	
	";
}	
	echo "'template'=>'{pager}<br>{items}{pager}',
	'pager' => array('cssFile' => Yii::app()->theme->baseUrl . '/css/pager.css'),
	'cssFile' => Yii::app()->theme->baseUrl . '/css/gridview.css',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),".$kolom."
  ),
));
?>
";
if ($this->isdetail == 1) {
echo"<?php
\$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indatagrid',
	'dataProvider'=>\$".$this->modeldetail."->search(),
	'template'=>'{pager}<br>{items}{pager}',
	'pager' => array('cssFile' => Yii::app()->theme->baseUrl . '/css/pager.css'),
	'cssFile' => Yii::app()->theme->baseUrl . '/css/gridview.css',		
	'columns'=>array(
	".$dkolom."
  ),
));
?>";
}
echo "<?php \$this->endWidget(); ?>";
?>