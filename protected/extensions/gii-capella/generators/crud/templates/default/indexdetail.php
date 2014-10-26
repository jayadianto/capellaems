<?php 
if ($this->isdetail == 1)
{
$emptykolom = '';$kolom='';$detailkol = '';$dkolom = '';
foreach($this->tableDetailSchema->columns as $column)
{
	if ($emptykolom == '')
	{
		if (($column->autoIncrement) && ($this->isdetail == 1))
		{
			$detailkol = "\$.fn.yiiGridView.update('$column->name', {
                    data: {
                        '".$this->modeldetail."[".$column->name."]': data.$column->name
                    }});
										$('#".$this->modeldetail."_".$column->name."').val(data.$column->name);\n";
		}
		if ($column->name == $this->getModelID())
		{
			continue;
		}
		else
		if ($column->type==='boolean' || $column->name === 'recordstatus')
		{
			$emptykolom = "$('#".$this->model."_".$column->name."').prop('checked', false);\n";
			$kolom = "if (data.status == 1) 
			{ 
				$('#".$this->modeldetail."_".$column->name."').prop('checked', true); 
			} 
			else 
			{
				$('#".$this->modeldetail."_".$column->name."').prop('checked', false);
			}\n";
		}
		else
		{
			$emptykolom = "$('#".$this->modeldetail."_".$column->name."').val('');\n";
			$kolom = "$('#".$this->modeldetail."_".$column->name."').val(data.".$column->name.");\n";
		}
	}
	else
	{
		if ($column->name == $this->getModelID())
		{
			continue;
		}
		else 
		if ($column->type==='boolean' || $column->name === 'recordstatus')
		{
			$emptykolom .= "$('#".$this->modeldetail."_".$column->name."').prop('checked', false);";
			$kolom .= "if (data.status == 1) 
			{ 
				$('#".$this->modeldetail."_".$column->name."').prop('checked', true); 
			} 
			else 
			{
				$('#".$this->modeldetail."_".$column->name."').prop('checked', false);
			}\n";
		}
		else
		{
			$emptykolom .= "$('#".$this->modeldetail."_".$column->name."').val('');\n";
			$kolom .= "$('#".$this->modeldetail."_".$column->name."').val(data.".$column->name.");\n";
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
				//$dkolom = "array('name'=>'".$column->name."', 'value'=>'\$data->$column->name','htmlOptions'=>array('width'=>'1%'))";
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
				//$dkolom .= ",array('name'=>'".$column->name."', 'value'=>'\$data->$column->name','htmlOptions'=>array('width'=>'1%'))";
		}
				else
			if ($column->name == $this->getModelID())
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
\$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type=\"text/javascript\">
// here is the magic
function adddetail()
{
    <?php echo CHtml::ajax(array(
			'url'=>array('".$this->controller."/createdetail'),
            'data'=> \"js:$(this).serialize()\",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>\"function(data)
            {
				
                if (data.status == 'success')
                {
                    ".$emptykolom."
                          // Here is the trick: on submit-> once again this function!
                    $('#detaildialog').dialog('open');
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
function editdetail()
{
    <?php
	echo CHtml::ajax(array(
			'url'=>array('".$this->controller."/updatedetail'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection(\"detaildatagrid\")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>\"function(data)
            {

                if (data.status == 'success')
                {
                    
					".$kolom."
                          // Here is the trick: on submit-> once again this function!
                    $('#detaildialog').dialog('open');
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
function deletedetail()
{
    <?php
	echo CHtml::ajax(array(
			'url'=>array('supplier/deleteaddress'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection(\"detaildatagrid\")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>\"function(data)
            {
if (data.status == 'success')
				{
						refreshdetail();
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
function refreshdetail()
{
    $.fn.yiiGridView.update('detaildatagrid');
    return false;
}
</script>
<script type=\"text/javascript\">
function helpmodifaddress() {
	$('#helpmodifaddressdialog').dialog('open');
    return false;
}
</script>
<script type=\"text/javascript\">
function helpaddress(){
	$('#helpaddressdialog').dialog('open');
    return false;
}
</script>
<?php \$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'helpaddressdialog',
    'options'=>array(
        'title'=>'Help',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<?php echo \$this->renderPartial('_helpdetail'); ?>
<?php \$this->endWidget();?>
<?php \$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'helpmodifaddressdialog',
    'options'=>array(
        'title'=>'Help Modif',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<?php echo \$this->renderPartial('_helpdetailmodif'); ?>
<?php \$this->endWidget();?>
<?php \$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'detaildialog',
    'options'=>array(
        'title'=>'Detail Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<?php echo \$this->renderPartial('_formdetail', array('model'=>\$".$this->modeldetail.")); ?>
<?php \$this->endWidget();?>
<?php
\$this->widget('ToolbarButton',array('isCreate'=>true,'UrlCreate'=>'adddetail()',
	'isDelete'=>true,'UrlDelete'=>'deletedetail()','isEdit'=>true,'UrlEdit'=>'editdetail()',
	'isRefresh'=>true,'UrlRefresh'=>'refreshdetail()','isHelp'=>true,'UrlHelp'=>'helpaddress()','DialogGrid'=>'detaildatagrid',
	'isRecordPage'=>true,'PageSize'=>\$pageSize,'OnChange'=>\"$.fn.yiiGridView.update('detaildatagrid',{data:{pageSize: $(this).val() }})\"));
?>
<?php
\$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detaildatagrid',
	'dataProvider'=> \$".$this->modeldetail."->search(),
  'selectableRows'=>2,
	'template'=>'{pager}<br>{items}{pager}',
	'pager' => array('cssFile' => Yii::app()->theme->baseUrl . '/css/pager.css'),
	'cssFile' => Yii::app()->theme->baseUrl . '/css/gridview.css',				
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
		".$dkolom."
  ),
));
?>";
}?>
