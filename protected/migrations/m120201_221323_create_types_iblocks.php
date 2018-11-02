<?php

class m120201_221323_create_types_iblocks extends CDbMigration
{
    private $_table = 'types_iblocks';
        
    public function safeUp()
    {        
       /*$this->createTable( $this->_table,                 
                           array( "id"      => "INT(11) NOT NULL AUTO_INCREMENT",
                                  "grid"    => "INT(11) DEFAULT NULL COMMENT 'Предок типа инфоблока'",
                                  "name"    => "VARCHAR(75) DEFAULT NULL COMMENT 'Наименование типа инфоблока'",
                                  "`desc`"  => "VARCHAR(75) DEFAULT NULL COMMENT 'Описание инфоблока'",
                                  "act"     => "TINYINT(1) DEFAULT NULL COMMENT 'Отметка активности'",
                                  "del"     => "TINYINT(1) DEFAULT NULL COMMENT 'Пометка удаления'",
                                  "PRIMARY KEY (id)",
                                  "UNIQUE INDEX id (id)" ),
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