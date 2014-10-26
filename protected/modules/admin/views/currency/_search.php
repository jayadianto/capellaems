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
										 "countryname" : $("#search_countryname").val(),
"currencyname" : $("#search_currencyname").val(),
"symbol" : $("#search_symbol").val(),
"recordstatus" : $("#search_recordstatus").val(),
"i18n" : $("#search_i18n").val()
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_countryname'><?php echo Catalogsys::model()->getCatalog('countryname') ?></label>
<div class='col-sm-6'><input type='text' id='search_countryname' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_currencyname'><?php echo Catalogsys::model()->getCatalog('currencyname') ?></label>
<div class='col-sm-6'><input type='text' id='search_currencyname' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_symbol'><?php echo Catalogsys::model()->getCatalog('symbol') ?></label>
<div class='col-sm-6'><input type='text' id='search_symbol' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_recordstatus'><?php echo Catalogsys::model()->getCatalog('recordstatus') ?></label>
<div class='col-sm-6'><input type='text' id='search_recordstatus' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_i18n'><?php echo Catalogsys::model()->getCatalog('i18n') ?></label>
<div class='col-sm-6'><input type='text' id='search_i18n' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
