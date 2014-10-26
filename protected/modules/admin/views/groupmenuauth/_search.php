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
										 "groupaccessid" : $("#search_groupaccessid").val(),
"menuauthid" : $("#search_menuauthid").val(),
"menuvalueid" : $("#search_menuvalueid").val()
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_groupaccessid'><?php echo Catalogsys::model()->getCatalog('groupaccessid') ?></label>
<div class='col-sm-6'><input type='text' id='search_groupaccessid' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_menuauthid'><?php echo Catalogsys::model()->getCatalog('menuauthid') ?></label>
<div class='col-sm-6'><input type='text' id='search_menuauthid' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_menuvalueid'><?php echo Catalogsys::model()->getCatalog('menuvalueid') ?></label>
<div class='col-sm-6'><input type='text' id='search_menuvalueid' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
