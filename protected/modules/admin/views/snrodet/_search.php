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
										 "snroid" : $("#search_snroid").val(),
"curdd" : $("#search_curdd").val(),
"curmm" : $("#search_curmm").val(),
"curyy" : $("#search_curyy").val(),
"curvalue" : $("#search_curvalue").val(),
"curcc" : $("#search_curcc").val(),
"curpt" : $("#search_curpt").val(),
"curpp" : $("#search_curpp").val()
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_snroid'><?php echo Catalogsys::model()->getCatalog('snroid') ?></label>
<div class='col-sm-6'><input type='text' id='search_snroid' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_curdd'><?php echo Catalogsys::model()->getCatalog('curdd') ?></label>
<div class='col-sm-6'><input type='text' id='search_curdd' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_curmm'><?php echo Catalogsys::model()->getCatalog('curmm') ?></label>
<div class='col-sm-6'><input type='text' id='search_curmm' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_curyy'><?php echo Catalogsys::model()->getCatalog('curyy') ?></label>
<div class='col-sm-6'><input type='text' id='search_curyy' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_curvalue'><?php echo Catalogsys::model()->getCatalog('curvalue') ?></label>
<div class='col-sm-6'><input type='text' id='search_curvalue' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_curcc'><?php echo Catalogsys::model()->getCatalog('curcc') ?></label>
<div class='col-sm-6'><input type='text' id='search_curcc' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_curpt'><?php echo Catalogsys::model()->getCatalog('curpt') ?></label>
<div class='col-sm-6'><input type='text' id='search_curpt' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_curpp'><?php echo Catalogsys::model()->getCatalog('curpp') ?></label>
<div class='col-sm-6'><input type='text' id='search_curpp' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
