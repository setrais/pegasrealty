<?php

class m120201_152400_create_districts extends CDbMigration
{
    private $_table = 'districts';
    
    public function safeUp()
    {        
        /*$this->createTable( $this->_table,                 
                            array(  "id"    => "INT(11) NOT NULL AUTO_INCREMENT",
                                    "sid"   => "VARCHAR(255) DEFAULT NULL COMMENT 'Cивольный Ид'",
                                    "abbr"  => "VARCHAR(255) DEFAULT NULL COMMENT 'Абривиатура района'",
                                    "title" => "VARCHAR(255) NOT NULL COMMENT 'Название района'",
                                    "sort"  => "INT(11) DEFAULT 500 COMMENT 'Сортировка'",
                                    "`desc`"=> "TEXT DEFAULT NULL COMMENT 'Описание'",
                                    "PRIMARY KEY (id)",
                                    "UNIQUE INDEX sid (sid)"),    
                                    "ENGINE = INNODB
                                     AUTO_INCREMENT = 10
                                     AVG_ROW_LENGTH = 1820
                                     CHARACTER SET utf8
                                     COLLATE utf8_general_ci
                                     COMMENT = 'Cправочник районов'"
                           );*/
    }    
    
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}