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
										 "description" : $("#search_description").val(),
"formatdoc" : $("#search_formatdoc").val(),
"formatno" : $("#search_formatno").val(),
"repeatby" : $("#search_repeatby").val(),
"recordstatus" : $("#search_recordstatus").val()
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_description'><?php echo Catalogsys::model()->getCatalog('description') ?></label>
<div class='col-sm-6'><input type='text' id='search_description' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_formatdoc'><?php echo Catalogsys::model()->getCatalog('formatdoc') ?></label>
<div class='col-sm-6'><input type='text' id='search_formatdoc' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_formatno'><?php echo Catalogsys::model()->getCatalog('formatno') ?></label>
<div class='col-sm-6'><input type='text' id='search_formatno' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_repeatby'><?php echo Catalogsys::model()->getCatalog('repeatby') ?></label>
<div class='col-sm-6'><input type='text' id='search_repeatby' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_recordstatus'><?php echo Catalogsys::model()->getCatalog('recordstatus') ?></label>
<div class='col-sm-6'><input type='text' id='search_recordstatus' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
