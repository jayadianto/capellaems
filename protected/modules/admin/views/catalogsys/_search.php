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
										 "languagename" : $("#search_languagename").val(),
"catalogname" : $("#search_catalogname").val(),
"catalogval" : $("#search_catalogval").val()
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_languagename'><?php echo Catalogsys::model()->getCatalog('languagename') ?></label>
<div class='col-sm-6'><input type='text' id='search_languagename' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_catalogname'><?php echo Catalogsys::model()->getCatalog('catalogname') ?></label>
<div class='col-sm-6'><input type='text' id='search_catalogname' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_catalogval'><?php echo Catalogsys::model()->getCatalog('catalogval') ?></label>
<div class='col-sm-6'><input type='text' id='search_catalogval' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
