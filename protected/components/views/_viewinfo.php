<div id="userinfo">
<img style="width:60px;height:64px" src="<?php echo Yii::app()->baseUrl; ?>/images/user/<?php echo $model->username?>.jpg"></img>
<div class="realname"><?php echo Catalogsys::model()->getCatalog('realname')?>:<?php $this->widget(
    'booster.widgets.TbEditableField',
    array(
        'type' => 'text',
        'model' => $model,
        'attribute' => 'realname', // $model->name will be editable
        'url' => array('/site/changerealname'), //url for submit data
    )
); ?></div>
<div class="userpass"><?php echo Catalogsys::model()->getCatalog('Password')?>: <?php $this->widget(
    'booster.widgets.TbEditableField',
    array(
        'type' => 'text',
        'model' => $model,
        'attribute' => 'password', // $model->name will be editable
        'url' => array('/site/changepass'), //url for submit data
    )
); ?></div>
<div class="useremail"><?php echo Catalogsys::model()->getCatalog('Email')?>: <?php $this->widget(
    'booster.widgets.TbEditableField',
    array(
        'type' => 'text',
        'model' => $model,
        'attribute' => 'email', // $model->name will be editable
        'url' => array('/site/changeemail'), //url for submit data
    )
); ?></div>
<div class="userhp"><?php echo Catalogsys::model()->getCatalog('phoneno')?>: <?php $this->widget(
    'booster.widgets.TbEditableField',
    array(
        'type' => 'text',
        'model' => $model,
        'attribute' => 'phoneno', // $model->name will be editable
        'url' => array('/site/changephoneno'), //url for submit data
    )
); ?></div>
<div class="usertheme"><?php echo Catalogsys::model()->getCatalog('Theme')?>: <?php $this->widget(
    'booster.widgets.TbEditableField',
    array(
        'type' => 'select2',
        'model' => $model,
        'attribute' => 'themeid', // $model->name will be editable
        'url' => array('/site/changethemes'), //url for submit data
				'source'=>CHTML::listdata(Theme::model()->findAllbysql('select * from theme where recordstatus = 1'),'themeid','themename')
    )
); ?></div>
<div class="userlang"><?php echo Catalogsys::model()->getCatalog('Language')?>: <?php $this->widget(
    'booster.widgets.TbEditableField',
    array(
        'type' => 'select2',
        'model' => $model,
        'attribute' => 'languageid', // $model->name will be editable
        'url' => array('/site/changephoneno'), //url for submit data
				'source'=>CHTML::listdata(Language::model()->findAllbysql('select * from language where recordstatus = 1'),'languageid','languagename')
    )
); ?></div>
</div>