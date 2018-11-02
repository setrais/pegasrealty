<?php

class m120201_182110_create_source_messages extends CDbMigration
{
    private $_table = 'source_messages';
    
    public function safeUp()
    {        
       /*$this->createTable( $this->_table,                 
                            array( "id"         => "INT(11) NOT NULL AUTO_INCREMENT",
                                   "uid"        => "VARCHAR(75) DEFAULT NULL",
                                   "category"   => "VARCHAR(32) DEFAULT NULL",
                                   "section"    => "VARCHAR(32) DEFAULT NULL",
                                   "message"    => "TEXT DEFAULT NULL",
                                   "PRIMARY KEY (id),
                                    UNIQUE INDEX id (id)" ),
                                   "ENGINE = INNODB
                                    AUTO_INCREMENT = 49
                                    AVG_ROW_LENGTH = 341
                                    CHARACTER SET utf8
                                    COLLATE utf8_general_ci"
                           );*/
    }    
    
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}