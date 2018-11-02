<?php

class m120201_185139_create_space_foto_types extends CDbMigration
{
    private $_table = 'space_foto_types';
        
    public function safeUp()
    {        
       /*$this->createTable( $this->_table,                 
                            array( "id"     => "INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.планировки'",
                                   "abbr"   => "VARCHAR(255) DEFAULT NULL COMMENT 'Абривиатура'",
                                   "title"  => "VARCHAR(255) DEFAULT NULL COMMENT 'Наименование планировки'",
                                   "sort"   => "INT(11) DEFAULT NULL COMMENT 'Сортировка'",
                                   "act"    => "TINYINT(1) DEFAULT NULL COMMENT 'Активность'",
                                   "del"    => "TINYINT(1) DEFAULT NULL COMMENT 'Cтатус удаления'",
                                   "`desc`" => "TEXT DEFAULT NULL COMMENT 'Описание'",
                                   "date_create"    => "TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата создания'",
                                   "date_update"    => "TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата обновления'",
                                   "PRIMARY KEY (id)"),
                                   "ENGINE = INNODB
                                    AUTO_INCREMENT = 1
                                    CHARACTER SET utf8"
                           );*/
    }    
    
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }   
}