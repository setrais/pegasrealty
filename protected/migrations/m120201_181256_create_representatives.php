<?php

class m120201_181256_create_representatives extends CDbMigration
{
    private $_table = 'representatives';
    
    public function safeUp()
    {        
       /*$this->createTable( $this->_table,                 
                            array( "id"         => "INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.налого облажения'",
                                   "space_id"   => "VARCHAR(255) DEFAULT NULL COMMENT 'Ид.аренды'",
                                   "name"       => "VARCHAR(255) DEFAULT NULL COMMENT 'Наименование'",
                                   "fio"        => "VARCHAR(255) DEFAULT NULL",
                                   "site"       => "VARCHAR(255) DEFAULT NULL COMMENT 'Сайт представителя'",
                                   "telephone"  => "VARCHAR(255) DEFAULT NULL COMMENT 'Телефон представителя'",
                                   "sort"       => "INT(11) DEFAULT 500 COMMENT 'Сортировка'",
                                   "act"        => "TINYINT(1) DEFAULT NULL COMMENT 'Статус активности'",
                                   "del"        => "TINYINT(1) DEFAULT NULL COMMENT 'Статус удаления'",
                                   "create_date"=> "TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата создания'",
                                   "update_date"=> "TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата обновления'",
                                   "`desc`"     => "TEXT DEFAULT NULL COMMENT 'Описание'",
                                   "PRIMARY KEY (id)" ),
                                   "ENGINE = INNODB
                                    AUTO_INCREMENT = 4
                                    CHARACTER SET utf8
                                    COLLATE utf8_general_ci
                                    COMMENT = 'Представители'"
                           );*/
    }    
    
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}