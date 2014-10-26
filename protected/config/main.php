<?php
return array(
	'theme'=>'slate',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Capella EMS Indonesia',
	'preload'=>array(
		//'log',
		'booster'
	),
		'aliases' => array(
    	'booster' => realpath(__DIR__ . '/../extensions/yiibooster'),
		),	
	
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.controllers.*',
		'application.extensions.fpdf.*',
		'application.extensions.yii-mail.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'ext.gii-capella.GiiModule',
			'generatorPaths'=>array(
					'ext.gii-capella'
				),
			'password'=>'123456',
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'install'=>array(),
		'admin'=>array(),
		'common'=>array()
	),	
	
	'components'=>array(
		'authManager' => array(
			'class' => 'CDbAuthManager',
			'connectionID' => 'db',
    ),
		'booster' => array(
			'class' => 'ext.yiibooster.components.Booster',
			'responsiveCss'=>true,
			'fontAwesomeCss'=> true,
			'minify'=>true,
			'coreCss'=>false,
		),
		'session'=>array(
      'class' => 'system.web.CDbHttpSession',
      'connectionID' => 'db',
			'autoStart' => true
    ),
		'user'=>array(
			'allowAutoLogin'=>true,
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
			),
			'showScriptName'=>false,
     'caseSensitive'=>false,  
		 'urlSuffix'=>'.pda'
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
			'connectionString' => 'mysql:host=localhost;port=5000;dbname=capellaems',
			'emulatePrepare' => true,
			'username' => 'capellaems',
			'password' => 'capellaems',
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
		'install'=>false
	),
);