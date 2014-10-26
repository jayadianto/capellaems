<?php
$this->widget('ext.LiveGridView.RefreshGridView', array(
	'id'=>'gridchat',
	'dataProvider'=>$model->Search(),
	'updatingTime'=>100000,
	'pager' => array('cssFile' => Yii::app()->theme->baseUrl . '/css/pager.css'),
	'cssFile' => Yii::app()->theme->baseUrl . '/css/gridview.css',	
	'template'=>'{pager}<br>{items}{pager}',
	'hideHeader'=>true,
	'columns'=>array(
				array(
      'name'=>'tododate',
      'type'=>'raw',
         'value'=>'"<img style=\"width:50px;height:60px\" class=userfoto src=\"'.Yii::app()->baseUrl.'/images/user/$data->userfrom.jpg\"></img>
				 <label class=chatuserto>$data->userfrom</label><br/>
				 <label class=chatdate>$data->inboxdatetime</label><br/>
				 <label class=chatmessages>$data->usermessages</label>
				 "'
     ),  
  ),
));
?>
<?php $form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
				'id' => 'horizontalForm',
				'type' => 'vertical',
		)
); ?>
<?php echo $form->dropDownListGroup(
            $model,
            'username',
						array('widgetOptions'=>array(
							'data' => CHtml::listData(Useraccess::model()->findAll(), 'username', 'username'),
							'htmlOptions' => array('multiple' => true),
						))
        ); ?>
		<?php echo $form->textAreaGroup(
			$model,
			'usermessages',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'span4',
				),
				'widgetOptions' => array(
					'htmlOptions' => array('rows' => 3),
				)
			)
		); ?>		
				<?php
$this->widget('ToolbarButton',array('isSave'=>true,'UrlSave'=>'/site/writechat',
	'isHelpModif'=>true,'DialogGrid'=>'gridchat'));
?>	 		
<?php $this->endWidget(); ?>
