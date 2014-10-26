<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php \$form=\$this->beginWidget('booster.widgets.TbActiveForm', 
	array(
				'id' => 'horizontalForm',
				'type' => 'horizontal',
		)
); ?>\n"; ?>
<div class="form-actions">
<?php 
$kolom = '';
foreach($this->tableSchema->columns as $column)
{
if($column->autoIncrement)
	{
	continue;
	}
	else
	if ($kolom == '') 
	{
		$kolom = "\"".$column->name."\" : $(\"#search_".$column->name."\").val()";
	}
	else
	{
		$kolom = $kolom. ",\n\"".$column->name."\" : $(\"#search_".$column->name."\").val()";
	}
}
echo "<?php \$this->widget(
			'booster.widgets.TbButton',
			array(
				'label' => Catalogsys::model()->getcatalog('searchdata'),
				'icon' => 'glyphicon glyphicon-search',
				'url' => '#',
				'htmlOptions'=>array(
		   'onclick'=>'{
				$.fn.yiiGridView.update(\"datagrid\", {
                    data: {
										 ".$kolom."
                    }
					});
				$(\"#searchdialog\").dialog(\"close\");
		   }'
				)));?> </div>" ?>
		<?php foreach($this->tableSchema->columns as $column)
{
if($column->autoIncrement)
	{
	continue;
	}
	else
	{
echo "<div class='form-group'>\n";
echo "<label class='col-sm-3 control-label required' for='search_".$column->name."'><?php echo Catalogsys::model()->getCatalog('$column->name') ?></label>\n";
echo "<div class='col-sm-6'><input type='text' id='search_".$column->name."' class='form-control'></div>\n";
echo "</div>\n";
}
}?>
<?php echo "<?php \$this->endWidget(); ?>\n"; ?>