<?php
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Capella ERP Indonesia',
	
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.controllers.*',
		'application.extensions.fpdf.*',
		'application.extensions.yii-mail.*',
	),

	'components'=>array(
		'authManager' => array(
			'class' => 'CDbAuthManager',
			'connectionID' => 'db',
    ),
		'commandMap'=>array(
        'migrate'=>array(
            'class'=>'system.cli.commands.MigrateCommand',
            'migrationPath'=>'application.migrations',
            'migrationTable'=>'tbl_migration',
            'connectionID'=>'db',
            'templateFile'=>'application.migrations.template',
        ),
    ),
		'mail' => array(
                'class' => 'ext.yii-mail.YiiMail',
                'transportType'=>'smtp',
                'transportOptions'=>array(
                        'host'=>'tescoindomaritim.com',
                        'username'=>'romy',
                        'password'=>'123456',
                        'port'=>'25',                       
                ),
                'viewPath' => 'application.views.mail',             
        ),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;port=5000;dbname=capella',
			'emulatePrepare' => true,
			'username' => 'capella',
			'password' => 'capella',
			'charset' => 'utf8',
			'initSQLs'=>array('set names utf8'),
			'schemaCachingDuration' => 3600,
			'enableProfiling'=>true
		),
		'errorHandler'=>array(
            'errorAction'=>'site/error',
    ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					//'class'=>'CWebLogRoute',
					//'levels'=>'error, warning',
					'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                'ipFilters'=>array('127.0.0.1','192.168.0.102'),
				),
			),
		),
	),

	'params'=>array(
		'adminEmail'=>'siskalandre@yahoo.com',
		'defaultPageSize'=>10,
		'defaultYearFrom'=>date('Y')-1,
		'defaultYearTo'=>date('Y'),
		'sizeLimit'=>10*1024*1024,
		'allowedext'=>array("xls","csv","xlsx","vsd","pdf","gdb","doc","docx","jpg","gif","png","rar","zip","jpeg"),
		'language'=>1,
		'defaultnumberqty'=>'#,##0.00',
		'defaultnumberprice'=>'#,##0.00',
		'dateviewfromdb'=>'d-M-Y',
		'dateviewcjui'=>'dd-mm-yy',
		'dateviewgrid'=>'dd-MM-yyyy',
		'datetodb'=>'Y-m-d',
		'timeviewfromdb'=>'h:m',
		'datetimeviewfromdb'=>'d-M-Y h:i',
		'timeviewcjui'=>'h:m',
		'datetimeviewgrid'=>'dd-MM-yyyy H:m',
		'datetimetodb'=>'Y-m-d h:i',
	),
);