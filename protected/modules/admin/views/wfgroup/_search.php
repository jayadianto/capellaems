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
"groupname" : $("#search_groupname").val(),
"wfbefstat" : $("#search_wfbefstat").val(),
"wfrecstat" : $("#search_wfrecstat").val()
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_wfdesc'><?php echo Catalogsys::model()->getCatalog('wfdesc') ?></label>
<div class='col-sm-6'><input type='text' id='search_wfdesc' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_groupname'><?php echo Catalogsys::model()->getCatalog('groupname') ?></label>
<div class='col-sm-6'><input type='text' id='search_groupname' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_wfbefstat'><?php echo Catalogsys::model()->getCatalog('wfbefstat') ?></label>
<div class='col-sm-6'><input type='text' id='search_wfbefstat' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_wfrecstat'><?php echo Catalogsys::model()->getCatalog('wfrecstat') ?></label>
<div class='col-sm-6'><input type='text' id='search_wfrecstat' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
