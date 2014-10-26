<?php

public createtableadmin = array(
"
CREATE TABLE `useraccess` (
	`useraccessid` INT(11) NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(50) NULL DEFAULT NULL,
	`realname` VARCHAR(100) NULL DEFAULT NULL,
	`password` VARCHAR(128) NULL DEFAULT NULL,
	`salt` VARCHAR(128) NULL DEFAULT NULL,
	`email` VARCHAR(100) NULL DEFAULT NULL,
	`phoneno` VARCHAR(50) NULL DEFAULT NULL,
	`languageid` INT(11) NULL DEFAULT NULL,
	`themeid` INT(11) NULL DEFAULT NULL,
	`isonline` TINYINT(4) NULL DEFAULT NULL,
	`recordstatus` TINYINT(1) NULL DEFAULT NULL,
	PRIMARY KEY (`useraccessid`) USING BTREE,
	UNIQUE INDEX `uq_useraccess_name` (`username`),
	INDEX `ix_useraccess_lang` (`languageid`),
	INDEX `ix_useraccess` (`useraccessid`, `username`, `realname`, `password`, `salt`, `email`, `phoneno`, `recordstatus`, `languageid`, `themeid`, `isonline`),
	INDEX `fk_useraccess_theme` (`themeid`),
	CONSTRAINT `fk_useraccess_theme` FOREIGN KEY (`themeid`) REFERENCES `theme` (`themeid`),
	CONSTRAINT `fk_useraccess_lang` FOREIGN KEY (`languageid`) REFERENCES `language` (`languageid`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;
",
"
CREATE TABLE `groupaccess` (
	`groupaccessid` INT(11) NOT NULL AUTO_INCREMENT,
	`groupname` VARCHAR(50) NULL DEFAULT NULL,
	`recordstatus` TINYINT(4) NULL DEFAULT NULL,
	PRIMARY KEY (`groupaccessid`),
	UNIQUE INDEX `uq_groupaccess_group` (`groupname`),
	INDEX `ix_groupaccess` (`groupaccessid`, `groupname`, `recordstatus`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;
",
"CREATE TABLE `menuaccess` (
	`menuaccessid` INT(11) NOT NULL AUTO_INCREMENT,
	`menuname` VARCHAR(50) NULL DEFAULT NULL,
	`description` VARCHAR(50) NULL DEFAULT NULL,
	`menuurl` VARCHAR(50) NULL DEFAULT NULL,
	`menuicon` VARCHAR(50) NULL DEFAULT NULL,
	`parentid` INT(10) NULL DEFAULT NULL,
	`recordstatus` TINYINT(4) NULL DEFAULT NULL,
	PRIMARY KEY (`menuaccessid`),
	INDEX `ix_menuaccess` (`menuaccessid`, `menuname`, `description`, `menuurl`, `recordstatus`, `menuicon`, `parentid`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;
"
);

?>