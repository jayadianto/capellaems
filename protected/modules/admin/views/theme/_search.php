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
										 "themename" : $("#search_themename").val(),
"description" : $("#search_description").val(),
"themeprev" : $("#search_themeprev").val(),
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_themename'><?php echo Catalogsys::model()->getCatalog('themename') ?></label>
<div class='col-sm-6'><input type='text' id='search_themename' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_description'><?php echo Catalogsys::model()->getCatalog('description') ?></label>
<div class='col-sm-6'><input type='text' id='search_description' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_themeprev'><?php echo Catalogsys::model()->getCatalog('themeprev') ?></label>
<div class='col-sm-6'><input type='text' id='search_themeprev' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
