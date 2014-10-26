<?php $this->beginContent('//layouts/mainadmin'); ?>
<div class="col-sm-3 col-xs-12 bs-docs-sidebar">
<?php
$this->widget('UserInfo');
$this->widget('UserFavo');
$this->widget('UserTo');
?>
</div>
<div class="col-sm-7 col-xs-12">
	<?php echo $content; ?>
</div>
<div class="col-sm-2 col-xs-12">
<?php $this->widget('UserChat'); 
$this->widget('UserOnline');
?>
</div>
<?php $this->endContent(); ?>