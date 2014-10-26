<?php 
	$this->widget(
			'booster.widgets.TbPanel',
			array(
					'title' => 'Chat',
					'headerIcon' => 'home',
					'content' => $this->render('_viewchat',array('model'=>$model),true)
			)
	);
?>