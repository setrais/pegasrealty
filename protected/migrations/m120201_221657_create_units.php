<?php

class m120201_221657_create_units extends CDbMigration
{
    private $_table = 'units';
        
    public function safeUp()
    {        
       /*$this->createTable( $this->_table,                 
                           array( "id"      => "INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид. единицы измерения'",
                                  "title"   => "VARCHAR(255) DEFAULT NULL COMMENT 'Название единицы измерения'",
                                  "short_title" => "VARCHAR(255) DEFAULT NULL COMMENT 'Короткое название ед.измерения'",
                                  "sort"        => "INT(11) DEFAULT NULL COMMENT 'Сортировка'",
                                  "act"         => "TINYINT(1) DEFAULT NULL COMMENT 'Активность'",
                                  "del"         => "TINYINT(1) DEFAULT NULL COMMENT 'Пометка об удалении'",
                                  "`desc`"      => "TEXT DEFAULT NULL COMMENT 'Описание'",
                                  "PRIMARY KEY (id)" ),
                                  "ENGINE = INNODB
                                   AUTO_INCREMENT = 4
                                   AVG_ROW_LENGTH = 5461
                                   CHARACTER SET utf8
                                   COLLATE utf8_general_ci"
                           );*/
    }    
    
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }  
}