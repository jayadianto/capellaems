<div class="form-group">
	<label class="<?php echo $this->classtype ?> control-label" for="<?php echo $this->ColField; ?>"><?php echo $this->titledialog ?>
		<?php if ($this->IsRequired == true) { ?>
			<span class="required">*</span>
		<?php } ?>
	</label>
	<div class="<?php echo $this->classtypebox ?>">
	<div class="input-group">
	<input name="<?php echo $this->Prefix.'['.$this->IDField.']' ?>" id="<?php echo $this->Prefix.'_'.$this->IDField ?>" type="hidden" value="">
	<input type="text" id="<?php echo $this->ColField ?>" readonly class="form-control" >
			<?php
				$this->beginWidget('zii.widgets.jui.CJuiDialog',
				 array(   'id'=>$this->IDDialog,
									// additional javascript options for the dialog plugin
									'options'=>array(
																	'title'=>Yii::t('app',$this->titledialog),
																	'width'=>'auto',
																	'autoOpen'=>false,
																	'modal'=>true,
																	),
													));
	$city=new City('searchwstatus');
			$city->unsetAttributes();  // clear any default values
			if(isset($_GET['City']))
			$city->attributes=$_GET['City'];
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>$this->PopGrid,
				'dataProvider'=>$city->Searchwstatus(),
				'filter'=>$city,
				'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
	'pager' => array('cssFile' => Yii::app()->theme->baseUrl . '/css/pager.css'),
	'cssFile' => Yii::app()->theme->baseUrl . '/css/gridview.css',				
				'columns'=>array(
					array(
						'header'=>'',
						'type'=>'raw',
					/* Here is The Button that will send the Data to The MAIN FORM */
						'value'=>'CHtml::Button("+",
						array("name" => "send_product",
						"id" => "send_product",
						"onClick" => "$(\"#'.$this->IDDialog.'\").dialog(\"close\"); $(\"#'.$this->ColField.'\").val(\"$data->cityname\"); $(\"#'.$this->Prefix.'_'.$this->IDField.'\").val(\"$data->cityid\");
						'.$this->onaftersign.'
				"))',
						),
		array('name'=>'cityid', 'value'=>'$data->cityid','htmlOptions'=>array('width'=>'1%')),
					'cityname',
					),
			));

			$this->endWidget('zii.widgets.jui.CJuiDialog');?>			
			<span class="input-group-addon">
				<input onclick='$.fn.yiiGridView.update("<?php echo $this->PopGrid?>"<?php echo $this->onclicksign ?>);$("#<?php echo $this->IDDialog ?>").dialog("open"); return false;' name="<?php echo $this->Prefix.'_'.$this->ColField ?>" type="button" value="" 
					style='
					background: no-repeat url(<?php echo Yii::app()->request->baseUrl."/images/submit.png" ?>);
					width:20px;border:none;
					'>
			</span>
			</div>
		</div>
</div>