<?php

class m120201_180053_create_plannings extends CDbMigration
{
    private $_table = 'plannings';
    
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
                                   "PRIMARY KEY (id)" ),
                                   "ENGINE = INNODB
                                    AUTO_INCREMENT = 7
                                    AVG_ROW_LENGTH = 2730
                                    CHARACTER SET utf8
                                    COLLATE utf8_general_ci"
                           );*/
    }    
    
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}