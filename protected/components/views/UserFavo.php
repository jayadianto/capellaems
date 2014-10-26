<?php
$this->beginwidget(
		'booster.widgets.TbPanel',
		array(
				'title' => 'Favourites',
				'headerIcon' => 'home',
		)
);
?>

<?php
$menus = Groupmenu::model()->findallbysql('select a.*
	from groupmenu a
	inner join menuaccess b on b.menuaccessid = a.menuaccessid
	inner join usergroup c on c.groupaccessid = a.groupaccessid
	inner join useraccess d on d.useraccessid = c.useraccessid
	inner join userfav e on e.useraccessid = d.useraccessid and e.menuaccessid = b.menuaccessid
	where lower(d.username) = lower("'. Yii::app()->user->id.'") and a.isread = 1'); 

	foreach ($menus as $menu)
	{
	echo '<div id="icon">';
    echo "<a href='".$menu->menuaccess->menuurl."' title='".$menu->menuaccess->description."'>
		<img style='width:48px;height:48px;' src='".Yii::app()->request->baseUrl."/images/".$menu->menuaccess->menuicon."' alt='".$menu->menuaccess->description."'><label>".$menu->menuaccess->description."</label></img></a>";
	echo "</div>";
	}
?>

<?php
$this->endwidget();
?>