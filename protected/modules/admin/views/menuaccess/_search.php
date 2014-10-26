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
										 "menuname" : $("#search_menuname").val(),
"description" : $("#search_description").val(),
"menuurl" : $("#search_menuurl").val(),
"menuicon" : $("#search_menuicon").val(),
"parentname" : $("#search_parentname").val(),
"modulename" : $("#search_modulename").val(),
"sortorder" : $("#search_sortorder").val(),
"recordstatus" : $("#search_recordstatus").val()
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_menuname'><?php echo Catalogsys::model()->getCatalog('menuname') ?></label>
<div class='col-sm-6'><input type='text' id='search_menuname' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_description'><?php echo Catalogsys::model()->getCatalog('description') ?></label>
<div class='col-sm-6'><input type='text' id='search_description' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_menuurl'><?php echo Catalogsys::model()->getCatalog('menuurl') ?></label>
<div class='col-sm-6'><input type='text' id='search_menuurl' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_menuicon'><?php echo Catalogsys::model()->getCatalog('menuicon') ?></label>
<div class='col-sm-6'><input type='text' id='search_menuicon' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_parentname'><?php echo Catalogsys::model()->getCatalog('parentname') ?></label>
<div class='col-sm-6'><input type='text' id='search_parentname' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_modulename'><?php echo Catalogsys::model()->getCatalog('modulename') ?></label>
<div class='col-sm-6'><input type='text' id='search_modulename' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_sortorder'><?php echo Catalogsys::model()->getCatalog('sortorder') ?></label>
<div class='col-sm-6'><input type='text' id='search_sortorder' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_recordstatus'><?php echo Catalogsys::model()->getCatalog('recordstatus') ?></label>
<div class='col-sm-6'><input type='text' id='search_recordstatus' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
