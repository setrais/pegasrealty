<?php

class m120201_140443_create_client_types extends CDbMigration
{
    private $_table = 'client_types';

    public function safeUp()
    {       
        /*$this->createTable($this->_table,                 
                             array( "id"=>"INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.налого облажения'",
                                    "abbr"=>"VARCHAR(255) DEFAULT NULL COMMENT 'Абривиатура'",
                                    "title"=>"VARCHAR(255) DEFAULT NULL COMMENT 'Наименование'",
                                    "sort"=>"INT(11) DEFAULT 500 COMMENT 'Сортировка'",
                                    "act"=>"TINYINT(1) DEFAULT NULL COMMENT 'Статус активности'",
                                    "del"=>"TINYINT(1) DEFAULT NULL COMMENT 'Статус удаления'",
                                    "create_date"=>"TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата создания'",
                                    "update_date"=>"TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата обновления'",
                                    "`desc`"=>"TEXT DEFAULT NULL COMMENT 'Описание'",                                 
                                    "PRIMARY KEY (id)"),
                                    "ENGINE = INNODB
                                     AUTO_INCREMENT = 4
                                     AVG_ROW_LENGTH = 5461
                                     CHARACTER SET utf8
                                     COLLATE utf8_general_ci
                                     COMMENT = 'Типы контрактов'"                               
                           );*/
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}