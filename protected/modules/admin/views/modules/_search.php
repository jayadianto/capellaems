<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', 
	array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
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
										 "modulename" : $("#search_modulename").val(),
"moduledesc" : $("#search_moduledesc").val(),
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?>
				<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_modulename'><?php echo Catalogsys::model()->getCatalog('modulename') ?></label>
<div class='col-sm-6'><input type='text' id='search_modulename' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_moduledesc'><?php echo Catalogsys::model()->getCatalog('moduledesc') ?></label>
<div class='col-sm-6'><input type='text' id='search_moduledesc' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
