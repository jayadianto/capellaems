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
										 "groupname" : $("#search_groupname").val(),
"menuname" : $("#search_menuname").val(),
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_groupname'><?php echo Catalogsys::model()->getCatalog('groupname') ?></label>
<div class='col-sm-6'><input type='text' id='search_groupname' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_menuname'><?php echo Catalogsys::model()->getCatalog('menuname') ?></label>
<div class='col-sm-6'><input type='text' id='search_menuname' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
