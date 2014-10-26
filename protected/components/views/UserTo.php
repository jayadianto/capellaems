<?php 
	$this->widget(
			'booster.widgets.TbPanel',
			array(
					'title' => 'To Do',
					'headerIcon' => 'home',
					'content' => $this->render('_viewtodo',array('model'=>$model),true)
			)
	);
?>