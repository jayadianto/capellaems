<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>
<div class="form-actions">
<?php
$this->widget(
			'booster.widgets.TbButton',
			array(
				'label' => Catalogsys::model()->getcatalog('searchdata'),
				'icon' => 'glyphicon glyphicon-search',
				'url' => '#',
				'htmlOptions'=>array(
						'onclick'=>'{
				$.fn.yiiGridView.update("datagrid", {
                    data: {
                        "languagename": $("#search_languagename").val(),
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));
		?>
</div>  
<div class="form-group">
	<label class="col-sm-3 control-label required" for="search_languagename">Language</label>
  <div class="col-sm-9"><input type="text" id="search_languagename" class="form-control"></div>
</div>
<?php $this->endWidget(); ?>