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
										 "username" : $("#search_username").val(),
"createddate" : $("#search_createddate").val(),
"useraction" : $("#search_useraction").val(),
"newdata" : $("#search_newdata").val(),
"olddata" : $("#search_olddata").val(),
"menuname" : $("#search_menuname").val(),
"tableid" : $("#search_tableid").val()
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_username'><?php echo Catalogsys::model()->getCatalog('username') ?></label>
<div class='col-sm-6'><input type='text' id='search_username' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_createddate'><?php echo Catalogsys::model()->getCatalog('createddate') ?></label>
<div class='col-sm-6'><input type='text' id='search_createddate' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_useraction'><?php echo Catalogsys::model()->getCatalog('useraction') ?></label>
<div class='col-sm-6'><input type='text' id='search_useraction' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_newdata'><?php echo Catalogsys::model()->getCatalog('newdata') ?></label>
<div class='col-sm-6'><input type='text' id='search_newdata' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_olddata'><?php echo Catalogsys::model()->getCatalog('olddata') ?></label>
<div class='col-sm-6'><input type='text' id='search_olddata' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_menuname'><?php echo Catalogsys::model()->getCatalog('menuname') ?></label>
<div class='col-sm-6'><input type='text' id='search_menuname' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_tableid'><?php echo Catalogsys::model()->getCatalog('tableid') ?></label>
<div class='col-sm-6'><input type='text' id='search_tableid' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
