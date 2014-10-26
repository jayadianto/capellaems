<?php

class m141017_023830_initial extends CDbMigration
{
	public function up()
	{
		 $this->createTable('catalogsys', array(
        'catalogsysid'=>'pk',
        'languageid'=>'int(11) DEFAULT NULL',
        'catalogname'=>'varchar(150) DEFAULT NULL',
        'catalogval'=>'text DEFAULT NULL',
        'recordstatus'=>'tinyint(4) DEFAULT NULL',
    ), '');

    $this->createIndex('idx_languageid', 'catalogsys', 'languageid', FALSE);

    $this->createTable('city', array(
        'cityid'=>'pk',
        'provinceid'=>'int(11) DEFAULT NULL',
        'citycode'=>'varchar(5) DEFAULT NULL',
        'cityname'=>'varchar(50) DEFAULT NULL',
        'recordstatus'=>'tinyint(4) DEFAULT NULL',
    ), '');

    $this->createIndex('idx_provinceid', 'city', 'provinceid', FALSE);

    $this->createTable('company', array(
        'companyid'=>'pk',
        'companyname'=>'varchar(50) DEFAULT NULL',
        'address'=>'varchar(250) DEFAULT NULL',
        'city'=>'varchar(50) DEFAULT NULL',
        'zipcode'=>'varchar(10) DEFAULT NULL',
        'taxno'=>'varchar(50) DEFAULT NULL',
        'currencyid'=>'int(11) DEFAULT NULL',
        'faxno'=>'varchar(50) DEFAULT NULL',
        'phoneno'=>'varchar(50) DEFAULT NULL',
        'webaddress'=>'varchar(100) DEFAULT NULL',
        'email'=>'varchar(100) DEFAULT NULL',
        'leftlogofile'=>'varchar(50) DEFAULT NULL',
        'rightlogofile'=>'varchar(50) DEFAULT NULL',
        'recordstatus'=>'tinyint(4) DEFAULT NULL',
    ), '');

    $this->createTable('country', array(
        'countryid'=>'pk',
        'countrycode'=>'varchar(5) DEFAULT NULL',
        'countryname'=>'varchar(50) DEFAULT NULL',
        'recordstatus'=>'tinyint(4) DEFAULT NULL',
    ), '');

    $this->createTable('groupaccess', array(
        'groupaccessid'=>'pk',
        'groupname'=>'varchar(50) DEFAULT NULL',
        'recordstatus'=>'tinyint(4) DEFAULT NULL',
    ), '');

    $this->createTable('groupmenu', array(
        'groupmenuid'=>'pk',
        'groupaccessid'=>'int(11) DEFAULT NULL',
        'menuaccessid'=>'int(11) DEFAULT NULL',
        'isread'=>'tinyint(4) DEFAULT NULL',
        'iswrite'=>'tinyint(4) DEFAULT NULL',
        'ispost'=>'tinyint(4) DEFAULT NULL',
        'isreject'=>'tinyint(4) DEFAULT NULL',
        'isupload'=>'tinyint(4) DEFAULT NULL',
        'isdownload'=>'tinyint(4) DEFAULT NULL',
        'ispurge'=>'tinyint(4) DEFAULT NULL',
    ), '');

    $this->createIndex('idx_groupaccessid', 'groupmenu', 'groupaccessid', FALSE);

    $this->createIndex('idx_menuaccessid', 'groupmenu', 'menuaccessid', FALSE);

    $this->createTable('language', array(
        'languageid'=>'pk',
        'languagename'=>'varchar(30) DEFAULT NULL',
        'recordstatus'=>'tinyint(3) unsigned DEFAULT NULL',
    ), '');

    $this->createTable('menuaccess', array(
        'menuaccessid'=>'pk',
        'menuname'=>'varchar(50) DEFAULT NULL',
        'description'=>'varchar(50) DEFAULT NULL',
        'menuurl'=>'varchar(50) DEFAULT NULL',
        'menuicon'=>'varchar(50) DEFAULT NULL',
        'parentid'=>'int(10) DEFAULT NULL',
        'recordstatus'=>'tinyint(4) DEFAULT NULL',
    ), '');

    $this->createTable('modules', array(
        'moduleid'=>'pk',
        'modulename'=>'varchar(30) DEFAULT NULL',
        'moduleicon'=>'varchar(50) DEFAULT NULL',
        'isinstall'=>'tinyint(4) DEFAULT NULL',
        'moduledesc'=>'varchar(150) DEFAULT NULL',
        'recordstatus'=>'tinyint(4) DEFAULT NULL',
    ), '');

    $this->createTable('parameter', array(
        'parameterid'=>'pk',
        'paramname'=>'varchar(30) DEFAULT NULL',
        'paramvalue'=>'varchar(50) DEFAULT NULL',
        'description'=>'varchar(50) DEFAULT NULL',
        'recordstatus'=>'int(11) DEFAULT NULL',
    ), '');

    $this->createTable('province', array(
        'provinceid'=>'pk',
        'countryid'=>'int(11) DEFAULT NULL',
        'provincecode'=>'varchar(5) DEFAULT NULL',
        'provincename'=>'varchar(100) DEFAULT NULL',
        'recordstatus'=>'tinyint(4) DEFAULT NULL',
    ), '');

    $this->createIndex('idx_countryid', 'province', 'countryid', FALSE);

    $this->createTable('snro', array(
        'snroid'=>'pk',
        'description'=>'varchar(50) DEFAULT NULL',
        'formatdoc'=>'varchar(50) DEFAULT NULL',
        'formatno'=>'varchar(10) DEFAULT NULL',
        'repeatby'=>'varchar(30) DEFAULT NULL',
        'recordstatus'=>'tinyint(4) DEFAULT NULL',
    ), '');

    $this->createTable('snrodet', array(
        'snrodid'=>'pk',
        'snroid'=>'int(11) DEFAULT NULL',
        'curdd'=>'int(11) DEFAULT NULL',
        'curmm'=>'int(11) DEFAULT NULL',
        'curyy'=>'int(11) DEFAULT NULL',
        'curvalue'=>'int(11) DEFAULT NULL',
        'curcc'=>'varchar(5) DEFAULT NULL',
        'curpt'=>'varchar(5) DEFAULT NULL',
        'curpp'=>'varchar(5) DEFAULT NULL',
    ), '');

    $this->createIndex('idx_snroid', 'snrodet', 'snroid', FALSE);

    $this->createTable('theme', array(
        'themeid'=>'pk',
        'themename'=>'varchar(50) DEFAULT NULL',
        'themedesc'=>'varchar(150) DEFAULT NULL',
        'themeprev'=>'varchar(150) DEFAULT NULL',
    ), '');

    $this->createTable('translog', array(
        'translogid'=>'pk',
        'username'=>'varchar(50) DEFAULT NULL',
        'createddate'=>'timestamp NOT NULL',
        'useraction'=>'varchar(50) DEFAULT NULL',
        'newdata'=>'text DEFAULT NULL',
        'olddata'=>'text DEFAULT NULL',
        'menuname'=>'varchar(50) DEFAULT NULL',
        'tableid'=>'int(11) DEFAULT NULL',
    ), '');

    $this->createTable('useraccess', array(
        'useraccessid'=>'pk',
        'username'=>'varchar(50) DEFAULT NULL',
        'realname'=>'varchar(100) DEFAULT NULL',
        'password'=>'varchar(128) DEFAULT NULL',
        'salt'=>'varchar(128) DEFAULT NULL',
        'email'=>'varchar(100) DEFAULT NULL',
        'phoneno'=>'varchar(50) DEFAULT NULL',
        'languageid'=>'int(11) DEFAULT NULL',
        'themeid'=>'int(11) DEFAULT NULL',
        'isonline'=>'tinyint(4) DEFAULT NULL',
        'recordstatus'=>'tinyint(1) DEFAULT NULL',
    ), '');

    $this->createIndex('idx_themeid', 'useraccess', 'themeid', FALSE);

    $this->createIndex('idx_languageid', 'useraccess', 'languageid', FALSE);

    $this->createTable('usergroup', array(
        'usergroupid'=>'pk',
        'useraccessid'=>'int(11) NOT NULL',
        'groupaccessid'=>'int(11) NOT NULL',
    ), '');

    $this->createIndex('idx_groupaccessid', 'usergroup', 'groupaccessid', FALSE);

    $this->createIndex('idx_useraccessid', 'usergroup', 'useraccessid', FALSE);

    $this->createTable('wfgroup', array(
        'wfgroupid'=>'pk',
        'workflowid'=>'int(11) NOT NULL',
        'groupaccessid'=>'int(11) NOT NULL',
        'wfbefstat'=>'tinyint(4) NOT NULL',
        'wfrecstat'=>'tinyint(4) NOT NULL',
    ), '');

    $this->createIndex('idx_groupaccessid', 'wfgroup', 'groupaccessid', FALSE);

    $this->createIndex('idx_workflowid', 'wfgroup', 'workflowid', FALSE);

    $this->createTable('wfstatus', array(
        'wfstatusid'=>'pk',
        'workflowid'=>'int(11) NOT NULL',
        'wfstat'=>'tinyint(4) NOT NULL',
        'wfstatusname'=>'varchar(50) NOT NULL',
    ), '');

    $this->createTable('workflow', array(
        'workflowid'=>'pk',
        'wfname'=>'varchar(20) NOT NULL',
        'wfdesc'=>'varchar(50) NOT NULL',
        'wfminstat'=>'tinyint(4) NOT NULL',
        'wfmaxstat'=>'tinyint(4) NOT NULL',
        'recordstatus'=>'tinyint(4) NOT NULL',
    ), '');

    $this->createTable('yiisession', array(
        'id'=>'char(32) NOT NULL',
        'expire'=>'int(11) DEFAULT NULL',
        'data'=>'longblob DEFAULT NULL',
    ), '');

    $this->addPrimaryKey('pk_yiisession', 'yiisession', 'id');

    $this->addForeignKey('fk_catalogsys_language_languageid', 'catalogsys', 'languageid', 'language', 'languageid', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_city_province_provinceid', 'city', 'provinceid', 'province', 'provinceid', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_groupmenu_groupaccess_groupaccessid', 'groupmenu', 'groupaccessid', 'groupaccess', 'groupaccessid', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_groupmenu_menuaccess_menuaccessid', 'groupmenu', 'menuaccessid', 'menuaccess', 'menuaccessid', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_province_country_countryid', 'province', 'countryid', 'country', 'countryid', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_snrodet_snro_snroid', 'snrodet', 'snroid', 'snro', 'snroid', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_useraccess_theme_themeid', 'useraccess', 'themeid', 'theme', 'themeid', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_useraccess_language_languageid', 'useraccess', 'languageid', 'language', 'languageid', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_usergroup_groupaccess_groupaccessid', 'usergroup', 'groupaccessid', 'groupaccess', 'groupaccessid', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_usergroup_useraccess_useraccessid', 'usergroup', 'useraccessid', 'useraccess', 'useraccessid', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_wfgroup_groupaccess_groupaccessid', 'wfgroup', 'groupaccessid', 'groupaccess', 'groupaccessid', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_wfgroup_workflow_workflowid', 'wfgroup', 'workflowid', 'workflow', 'workflowid', 'NO ACTION', 'NO ACTION');
	}

	public function down()
	{
		$this->dropForeignKey('fk_catalogsys_language_languageid', 'catalogsys');

    $this->dropForeignKey('fk_city_province_provinceid', 'city');

    $this->dropForeignKey('fk_groupmenu_groupaccess_groupaccessid', 'groupmenu');

    $this->dropForeignKey('fk_groupmenu_menuaccess_menuaccessid', 'groupmenu');

    $this->dropForeignKey('fk_province_country_countryid', 'province');

    $this->dropForeignKey('fk_snrodet_snro_snroid', 'snrodet');

    $this->dropForeignKey('fk_useraccess_theme_themeid', 'useraccess');

    $this->dropForeignKey('fk_useraccess_language_languageid', 'useraccess');

    $this->dropForeignKey('fk_usergroup_groupaccess_groupaccessid', 'usergroup');

    $this->dropForeignKey('fk_usergroup_useraccess_useraccessid', 'usergroup');

    $this->dropForeignKey('fk_wfgroup_groupaccess_groupaccessid', 'wfgroup');

    $this->dropForeignKey('fk_wfgroup_workflow_workflowid', 'wfgroup');

    $this->dropTable('catalogsys');
    $this->dropTable('city');
    $this->dropTable('company');
    $this->dropTable('country');
    $this->dropTable('groupaccess');
    $this->dropTable('groupmenu');
    $this->dropTable('language');
    $this->dropTable('menuaccess');
    $this->dropTable('modules');
    $this->dropTable('parameter');
    $this->dropTable('province');
    $this->dropTable('snro');
    $this->dropTable('snrodet');
    $this->dropTable('theme');
    $this->dropTable('translog');
    $this->dropTable('useraccess');
    $this->dropTable('usergroup');
    $this->dropTable('wfgroup');
    $this->dropTable('wfstatus');
    $this->dropTable('workflow');
    $this->dropTable('yiisession');
	}
}