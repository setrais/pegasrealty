<?php

class m120201_141011_create_client_spaces extends CDbMigration
{
  private $_table = 'client_spaces';

    public function safeUp()
    {       
        /*$this->createTable($this->_table,                 
                            array( "id"        => "INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.записи'",
                                    "client_id" => "INT(11) DEFAULT NULL COMMENT 'Ид.клиента'",
                                    "space_id"  => "INT(11) DEFAULT NULL COMMENT 'Ид.свойства'",
                                    "PRIMARY KEY (id)"
                                  ),
                            "ENGINE = INNODB
                             AUTO_INCREMENT = 1
                             CHARACTER SET utf8
                             COLLATE utf8_general_ci
                             COMMENT = 'Свойства аренды'"
                           );*/
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}