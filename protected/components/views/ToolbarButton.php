<?php 
$this->widget(
'booster.widgets.TbButtonGroup',
array(
		'buttons' => array(
			array(
				'label' => Catalogsys::model()->getCatalog('CreateData'), 
				'icon'=>'glyphicon glyphicon-new-window',
				'visible'=>$this->isCreate,
				'htmlOptions'=>array('onclick'=> $this->UrlCreate),
				'url' => '#'),
			)
		)
);
$this->widget(
'booster.widgets.TbButtonGroup',
array(
		'buttons' => array(			
		array(
				'label' => Catalogsys::model()->getCatalog('EditData'), 
				'icon' => 'glyphicon glyphicon-edit',
				'visible'=>$this->isEdit,
				'htmlOptions'=>array('onclick'=> $this->UrlEdit),
				'url' => '#'),
		)
));
$this->widget(
'booster.widgets.TbButtonGroup',
array(
		'buttons' => array(		
			array(
				'label' => Catalogsys::model()->getCatalog('DeleteData'), 
				'icon' => 'glyphicon glyphicon-remove',
				'visible'=>$this->isDelete,
				'htmlOptions'=>array('onclick'=> $this->UrlDelete),
				'url' => '#'),
)));
$this->widget(
'booster.widgets.TbButtonGroup',
array(
		'buttons' => array(		
			array(
				'label' => Catalogsys::model()->getCatalog('PurgeData'), 
				'icon' => 'glyphicon glyphicon-trash',
				'visible'=>$this->isPurge,
				'htmlOptions'=>array('onclick'=> $this->UrlPurge),
				'url' => '#'))));
$this->widget(
'booster.widgets.TbButtonGroup',
array(
		'buttons' => array(		
			array(
				'label' => Catalogsys::model()->getCatalog('UploadData'), 
				'icon' => 'glyphicon glyphicon-upload',
				'visible'=>$this->isUpload,
				'htmlOptions'=>array('onclick'=> $this->UrlUpload),
				'url' => '#'),
		)));
$this->widget(
'booster.widgets.TbButtonGroup',
array(
		'buttons' => array(		
			array(
				'label' => Catalogsys::model()->getCatalog('DownloadData'), 
				'icon' => 'glyphicon glyphicon-download-alt',
				'visible'=>$this->isDownload,
				'url'=>'#',
				'items'=>array(
					array(
						'label' => Catalogsys::model()->getCatalog('PDF'), 
						'visible'=>$this->isDownload,
						'itemOptions'=>array('onclick'=> $this->UrlDownPDF),
						'url' => '#'),
					array(
						'label' => Catalogsys::model()->getCatalog('Excel'), 
						'visible'=>$this->isDownload,
						'itemOptions'=>array('onclick'=> $this->UrlDownExcel),
						'url' => '#'),
				)))));
$this->widget(
'booster.widgets.TbButtonGroup',
array(				
		'buttons' => array(		
			array(
				'label' => Catalogsys::model()->getCatalog('SearchData'), 
				'icon' => 'glyphicon glyphicon-search',
				'visible'=>$this->isSearch,
				'htmlOptions'=>array('onclick'=> $this->UrlSearch),
				'url' => '#'))));
$this->widget(
'booster.widgets.TbButtonGroup',
array(
		'buttons' => array(		
			array(
				'label' => Catalogsys::model()->getCatalog('RefreshData'), 
				'icon' => 'glyphicon glyphicon-refresh',
				'visible'=>$this->isRefresh,
				'htmlOptions'=>array('onclick'=> $this->UrlRefresh),
				'url' => '#'))));
$this->widget(
'booster.widgets.TbButtonGroup',
array(
		'buttons' => array(						
			array(
				'label' => Catalogsys::model()->getCatalog('HistoryData'), 
				'icon' => 'glyphicon glyphicon-th',
				'visible'=>$this->isHistory,
				'htmlOptions'=>array('onclick'=> $this->UrlHistory),
				'url' => '#'))));
$this->widget(
'booster.widgets.TbButtonGroup',
array(
		'buttons' => array(		
			array(
				'label' => Catalogsys::model()->getCatalog('HelpData'), 
				'icon' => 'glyphicon glyphicon-question-sign',
				'visible'=>$this->isHelp,
				'htmlOptions'=>array('onclick'=> $this->UrlHelp),
				'url' => '#'),
		)
	)
);
							
$this->widget(
	'booster.widgets.TbMenu',
	array(
		'type' => 'list',
		'items' => array(
			
		),
	)
);
?>	<?php
	if ($this->isRecordPage == true) {
	?><?php echo CHtml::textField('',Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),array('size'=>'5',
			// change 'user-grid' to the actual id of your grid!!
			'onchange'=>$this->OnChange,
						'id'=>'recordpage',
						'title'=>Catalogsys::model()->getcatalog('recordpage')
		  ));
	?><?php };?>
<?php 
if ($this->isSave == true) 
{
echo '<div class="form-actions">';
};
?>
	<?php
	if ($this->isSave == true) {
		$this->widget(
			'booster.widgets.TbButton',
			array(
				'label' => Catalogsys::model()->getcatalog('save'),
				'icon' => 'glyphicon glyphicon-floppy-save',
				'buttonType'=>'ajaxButton',
				'url' => $this->UrlSave,
				'ajaxOptions'=>array( 
					'live'=>false,
					'type'=>'post',
					'dataType'=>'json',
					'success'=>'function(data)
						{
							if (data.status == "success")
							{
								$.fn.yiiGridView.update("'.$this->DialogGrid.'");
								$("#'.$this->DialogID.'").dialog("close");
								toastr.info(data.div);
							}
							else
							{
								toastr.error(data.div);
							}
						}'),
			 )
		 );
	};
	if ($this->isCancel == true) {
		$this->widget(
			'booster.widgets.TbButton',
			array(
				'label' => Catalogsys::model()->getcatalog('cancel'),
				'icon' => 'glyphicon glyphicon-remove-circle',
				'buttonType'=>'ajaxButton',
				'url' => $this->UrlCancel,
				'ajaxOptions'=>array( 
					'live'=>false,
					'type'=>'post',
					'dataType'=>'json',
					'success'=>'function(data)
						{
							$("#'.$this->DialogID.'").dialog("close");
						}'),
			 )
		 );
	};
	if ($this->isHelpModif == true) {
		$this->widget(
            'booster.widgets.TbButton',
            array(
                'label' => Catalogsys::model()->getcatalog('helpdata'),
								'icon' => 'glyphicon glyphicon-question-sign',
                'url' => '#',
                'htmlOptions' => array('onclick' => $this->UrlHelpModif),
            )
        );
	};
;	
	?>
<?php 
if ($this->isSave == true)
{
echo "</div>";
};
?><br/><br/>

