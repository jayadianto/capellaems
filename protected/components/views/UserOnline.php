<?php
$this->beginwidget(
		'booster.widgets.TbPanel',
		array(
				'title' => 'User Online',
				'headerIcon' => 'home',
		)
);
?>
<div id="useronline">
<?php
$menus = Useraccess::model()->findallbysql('select username,realname from useraccess where isonline = 1'); 

	foreach ($menus as $menu)
	{
	echo '<div class="users">';
	echo '<img style="width:32px;height:36px" src="'.Yii::app()->baseUrl.'/images/user/'.$menu->username.'.jpg"><label class="realname">'.$menu->realname.'</label></img>';
	echo '</div>';
	}
?>
</div>
<?php
$this->endwidget();
?>