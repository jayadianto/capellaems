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
										 "username" : $("#search_username").val(),
"realname" : $("#search_realname").val(),
"password" : $("#search_password").val(),
"email" : $("#search_email").val(),
"phoneno" : $("#search_phoneno").val(),
"languageid" : $("#search_languageid").val(),
"themeid" : $("#search_themeid").val(),
"isonline" : $("#search_isonline").val(),
"recordstatus" : $("#search_recordstatus").val()
                    }
					});
				$("#searchdialog").dialog("close");
		   }'
				)));?> </div>		<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_username'><?php echo Catalogsys::model()->getCatalog('username') ?></label>
<div class='col-sm-6'><input type='text' id='search_username' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_realname'><?php echo Catalogsys::model()->getCatalog('realname') ?></label>
<div class='col-sm-6'><input type='text' id='search_realname' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_password'><?php echo Catalogsys::model()->getCatalog('password') ?></label>
<div class='col-sm-6'><input type='text' id='search_password' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_email'><?php echo Catalogsys::model()->getCatalog('email') ?></label>
<div class='col-sm-6'><input type='text' id='search_email' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_phoneno'><?php echo Catalogsys::model()->getCatalog('phoneno') ?></label>
<div class='col-sm-6'><input type='text' id='search_phoneno' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_languageid'><?php echo Catalogsys::model()->getCatalog('languageid') ?></label>
<div class='col-sm-6'><input type='text' id='search_languageid' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_themeid'><?php echo Catalogsys::model()->getCatalog('themeid') ?></label>
<div class='col-sm-6'><input type='text' id='search_themeid' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_isonline'><?php echo Catalogsys::model()->getCatalog('isonline') ?></label>
<div class='col-sm-6'><input type='text' id='search_isonline' class='form-control'></div>
</div>
<div class='form-group'>
<label class='col-sm-3 control-label required' for='search_recordstatus'><?php echo Catalogsys::model()->getCatalog('recordstatus') ?></label>
<div class='col-sm-6'><input type='text' id='search_recordstatus' class='form-control'></div>
</div>
<?php $this->endWidget(); ?>
