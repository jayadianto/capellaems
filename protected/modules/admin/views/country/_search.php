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
										 "countrycode" : $("#search_countrycode").val(),
"countryname" : $("#search_countryname").val(),
"recordstatus" : $("#search_recordstatus").val()
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_countrycode'><?php echo Catalogsys::model()->getCatalog('countrycode') ?></label>
<div class='col-sm-6'><input type='text' id='search_countrycode' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_countryname'><?php echo Catalogsys::model()->getCatalog('countryname') ?></label>
<div class='col-sm-6'><input type='text' id='search_countryname' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_recordstatus'><?php echo Catalogsys::model()->getCatalog('recordstatus') ?></label>
<div class='col-sm-6'><input type='text' id='search_recordstatus' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
