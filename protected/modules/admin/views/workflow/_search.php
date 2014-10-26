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
										 "wfname" : $("#search_wfname").val(),
"wfdesc" : $("#search_wfdesc").val(),
"wfminstat" : $("#search_wfminstat").val(),
"wfmaxstat" : $("#search_wfmaxstat").val(),
"recordstatus" : $("#search_recordstatus").val()
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_wfname'><?php echo Catalogsys::model()->getCatalog('wfname') ?></label>
<div class='col-sm-6'><input type='text' id='search_wfname' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_wfdesc'><?php echo Catalogsys::model()->getCatalog('wfdesc') ?></label>
<div class='col-sm-6'><input type='text' id='search_wfdesc' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_wfminstat'><?php echo Catalogsys::model()->getCatalog('wfminstat') ?></label>
<div class='col-sm-6'><input type='text' id='search_wfminstat' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_wfmaxstat'><?php echo Catalogsys::model()->getCatalog('wfmaxstat') ?></label>
<div class='col-sm-6'><input type='text' id='search_wfmaxstat' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_recordstatus'><?php echo Catalogsys::model()->getCatalog('recordstatus') ?></label>
<div class='col-sm-6'><input type='text' id='search_recordstatus' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
