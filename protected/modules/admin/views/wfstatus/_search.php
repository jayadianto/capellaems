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
										 "wfdesc" : $("#search_wfdesc").val(),
"wfstat" : $("#search_wfstat").val(),
"wfstatusname" : $("#search_wfstatusname").val()
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_wfdesc'><?php echo Catalogsys::model()->getCatalog('wfdesc') ?></label>
<div class='col-sm-6'><input type='text' id='search_wfdesc' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_wfstat'><?php echo Catalogsys::model()->getCatalog('wfstat') ?></label>
<div class='col-sm-6'><input type='text' id='search_wfstat' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_wfstatusname'><?php echo Catalogsys::model()->getCatalog('wfstatusname') ?></label>
<div class='col-sm-6'><input type='text' id='search_wfstatusname' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
