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
										 "useraccessid" : $("#search_useraccessid").val(),
"menuaccessid" : $("#search_menuaccessid").val()
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_useraccessid'><?php echo Catalogsys::model()->getCatalog('useraccessid') ?></label>
<div class='col-sm-6'><input type='text' id='search_useraccessid' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_menuaccessid'><?php echo Catalogsys::model()->getCatalog('menuaccessid') ?></label>
<div class='col-sm-6'><input type='text' id='search_menuaccessid' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
