	<?php
	$this->widget(
			'booster.widgets.TbPanel',
			array(
					'title' => 'User Information',
					'headerIcon' => 'home',
					'content' => $this->render('_viewinfo',array('model'=>$model),true)
			)
	);
	?>	