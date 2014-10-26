<?php $form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => $data->modulename.'Form',
    )
);?>
<?php echo CHtml::HiddenField('id', $data->modulename); ?>
<?php echo CHtml::HiddenField('text'.$data->modulename, 'install'); ?>
<div class="col-sm-8 col-md-2">
    <div class="thumbnail">
        <img style="width:64px;height:64px" src="<?php echo Yii::app()->baseUrl.'/images/'.$data->moduleicon;?>" alt="<?php echo $data->modulename;?>">
        <div class="caption">
            <p><?php echo $data->moduledesc ?></p>
						<?php echo CHtml::ajaxSubmitButton(($data->isinstall==0)?'Install':'Uninstall',
			array('installmodul'),
		  array(
				'success'=>'function(data)
				{
					var x = eval("(" + data + ")");
					if (x.status == "success")
					{
						$("#'.$data->modulename.'button").val(x.text);
						$("#text'.$data->modulename.'").val(x.text);
						toastr.info(x.div);
					}
					else
					{
						toastr.error(x.div);
					}
				}'),
			array('id'=>$data->modulename.'button'));
$this->endWidget();
unset($form);
?>		
        </div>
    </div>
</div>