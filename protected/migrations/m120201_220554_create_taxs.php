<?php

class m120201_220554_create_taxs extends CDbMigration
{
    private $_table = 'taxs';
        
    public function safeUp()
    {        
       /*$this->createTable( $this->_table,                 
                           array( "id"      => "INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.налого облажения'",
                                  "abbr"    => "VARCHAR(255) DEFAULT NULL COMMENT 'Абривиатура'",
                                  "title"   => "VARCHAR(255) DEFAULT NULL COMMENT 'Наименование'",
                                  "sort"    => "INT(11) DEFAULT 500 COMMENT 'Сортировка'",
                                  "act"     => "TINYINT(1) DEFAULT NULL COMMENT 'Статус активности'",
                                  "del"     => "TINYINT(1) DEFAULT NULL COMMENT 'Статус удаления'",
                                  "create_date" => "TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата создания'",
                                  "update_date" => "TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата обновления'",
                                  "`desc`"      => "TEXT DEFAULT NULL COMMENT 'Описание'",
                                  "PRIMARY KEY (id)" ),
                                  "ENGINE = INNODB
                                   AUTO_INCREMENT = 3
                                   AVG_ROW_LENGTH = 8192
                                   CHARACTER SET utf8
                                   COLLATE utf8_general_ci
                                   COMMENT = 'Справочник налогооблажений'"
                           );*/
    }    
    
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }  
}