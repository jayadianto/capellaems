<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', 
	array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<div class="form-actions">
<?php $this->widget(
			'booster.widgets.TbButton',
			array(
				'label' => Catalogsys::model()->getcatalog('searchdata'),
				'icon' => 'glyphicon glyphicon-search',
				'url' => '#',
				'htmlOptions'=>array(
		   'onclick'=>'{
				$.fn.yiiGridView.update("datagrid", {
                    data: {
										 "paramname" : $("#search_paramname").val(),
"paramvalue" : $("#search_paramvalue").val(),
"description" : $("#search_description").val(),
"modulename" : $("#search_modulename").val(),
"recordstatus" : $("#search_recordstatus").val()
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_paramname'><?php echo Catalogsys::model()->getCatalog('paramname') ?></label>
<div class='col-sm-6'><input type='text' id='search_paramname' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_paramvalue'><?php echo Catalogsys::model()->getCatalog('paramvalue') ?></label>
<div class='col-sm-6'><input type='text' id='search_paramvalue' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_description'><?php echo Catalogsys::model()->getCatalog('description') ?></label>
<div class='col-sm-6'><input type='text' id='search_description' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_modulename'><?php echo Catalogsys::model()->getCatalog('modulename') ?></label>
<div class='col-sm-6'><input type='text' id='search_modulename' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_recordstatus'><?php echo Catalogsys::model()->getCatalog('recordstatus') ?></label>
<div class='col-sm-6'><input type='text' id='search_recordstatus' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
