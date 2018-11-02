<?php

class m120201_222045_create_users extends CDbMigration
{
    private $_table = 'users';
        
    public function safeUp()
    {        
       /*$this->createTable( $this->_table,                 
                           array( "id"              => "INT(11) NOT NULL AUTO_INCREMENT COMMENT 'ID пользователя'",
                                  "uid"             => "VARCHAR(75) DEFAULT NULL COMMENT 'Уникальный ID пользователя'",
                                  "title"           => "VARCHAR(45) DEFAULT NULL COMMENT 'Имя пользователя'",
                                  "username"        => "VARCHAR(255) DEFAULT NULL COMMENT 'Полное имя пользователя'",
                                  "`password`"      => "VARCHAR(255) DEFAULT NULL COMMENT 'Пароль пользователя'",
                                  "email"           => "VARCHAR(255) DEFAULT NULL COMMENT 'Email пользователя'",
                                  "send_email"      => "VARCHAR(255) DEFAULT NULL COMMENT 'Email отправки писем'",
                                  "register_date"   => "DATETIME DEFAULT NULL COMMENT 'Дата регистрации'",
                                  "lastvisit_date"  => "DATETIME DEFAULT NULL COMMENT 'Дата последнего визита'",
                                  "description"     => "VARCHAR(255) DEFAULT NULL COMMENT 'Описание пользователя'",
                                  "sort"            => "INT(11) DEFAULT 500 COMMENT 'Сортировка'",
                                  "del"             => "INT(11) DEFAULT 0 COMMENT 'Пометка об удалении'",
                                  "act"             => "INT(1) DEFAULT 1 COMMENT 'Пометка активности'",
                                  "create_date"     => "DATETIME DEFAULT NULL COMMENT 'Дата создания пользователя'",
                                  "update_date"     => "DATETIME DEFAULT NULL COMMENT 'Дата удаления пользователя'",
                                  "param_id"        => "INT(11) DEFAULT NULL COMMENT 'Параметры пользователя'",
                                  "param_uid"       => "VARCHAR(255) DEFAULT NULL COMMENT 'Уникальный ID параметров пользователя'",
                                  "phpBBLogin VARCHAR(75) DEFAULT NULL COMMENT 'Логин пользователя на форуме'",
                                  "PRIMARY KEY (id)",
                                  "INDEX act (act)",
                                  "INDEX datecreate (create_date)",
                                  "INDEX dateupdate (update_date)",
                                  "INDEX del (del)",
                                  "INDEX id (id)",
                                  "UNIQUE INDEX id_UNIQUE (id)",
                                  "UNIQUE INDEX iid_UNIQUE (uid)",
                                  "INDEX name (title)",
                                  "INDEX sort (sort)" ),
                                  "ENGINE = INNODB
                                   AUTO_INCREMENT = 2
                                   AVG_ROW_LENGTH = 16384
                                   CHARACTER SET utf8
                                   COLLATE utf8_general_ci
                                   COMMENT = 'List to tables systems'"
                           );*/
    }    
    
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }  
}