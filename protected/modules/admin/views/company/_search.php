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
										 "companyname" : $("#search_companyname").val(),
"address" : $("#search_address").val(),
"city" : $("#search_city").val(),
"zipcode" : $("#search_zipcode").val(),
"taxno" : $("#search_taxno").val(),
"currencyid" : $("#search_currencyid").val(),
"faxno" : $("#search_faxno").val(),
"phoneno" : $("#search_phoneno").val(),
"webaddress" : $("#search_webaddress").val(),
"email" : $("#search_email").val(),
"leftlogofile" : $("#search_leftlogofile").val(),
"rightlogofile" : $("#search_rightlogofile").val(),
"recordstatus" : $("#search_recordstatus").val()
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_companyname'><?php echo Catalogsys::model()->getCatalog('companyname') ?></label>
<div class='col-sm-6'><input type='text' id='search_companyname' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_address'><?php echo Catalogsys::model()->getCatalog('address') ?></label>
<div class='col-sm-6'><input type='text' id='search_address' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_city'><?php echo Catalogsys::model()->getCatalog('city') ?></label>
<div class='col-sm-6'><input type='text' id='search_city' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_zipcode'><?php echo Catalogsys::model()->getCatalog('zipcode') ?></label>
<div class='col-sm-6'><input type='text' id='search_zipcode' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_taxno'><?php echo Catalogsys::model()->getCatalog('taxno') ?></label>
<div class='col-sm-6'><input type='text' id='search_taxno' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_currencyid'><?php echo Catalogsys::model()->getCatalog('currencyid') ?></label>
<div class='col-sm-6'><input type='text' id='search_currencyid' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_faxno'><?php echo Catalogsys::model()->getCatalog('faxno') ?></label>
<div class='col-sm-6'><input type='text' id='search_faxno' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_phoneno'><?php echo Catalogsys::model()->getCatalog('phoneno') ?></label>
<div class='col-sm-6'><input type='text' id='search_phoneno' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_webaddress'><?php echo Catalogsys::model()->getCatalog('webaddress') ?></label>
<div class='col-sm-6'><input type='text' id='search_webaddress' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_email'><?php echo Catalogsys::model()->getCatalog('email') ?></label>
<div class='col-sm-6'><input type='text' id='search_email' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_leftlogofile'><?php echo Catalogsys::model()->getCatalog('leftlogofile') ?></label>
<div class='col-sm-6'><input type='text' id='search_leftlogofile' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_rightlogofile'><?php echo Catalogsys::model()->getCatalog('rightlogofile') ?></label>
<div class='col-sm-6'><input type='text' id='search_rightlogofile' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_recordstatus'><?php echo Catalogsys::model()->getCatalog('recordstatus') ?></label>
<div class='col-sm-6'><input type='text' id='search_recordstatus' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
