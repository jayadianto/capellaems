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
										 "menuobject" : $("#search_menuobject").val(),
"recordstatus" : $("#search_recordstatus").val()
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_menuobject'><?php echo Catalogsys::model()->getCatalog('menuobject') ?></label>
<div class='col-sm-6'><input type='text' id='search_menuobject' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_recordstatus'><?php echo Catalogsys::model()->getCatalog('recordstatus') ?></label>
<div class='col-sm-6'><input type='text' id='search_recordstatus' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
