<?php

class m120201_155314_create_messages extends CDbMigration
{
    private $_table = 'messages';
    
    public function safeUp()
    {        
        /*$this->createTable( $this->_table,                 
                            array( "id"         => "INT(11) NOT NULL DEFAULT 0",
                                   "language"   => "VARCHAR(16) NOT NULL DEFAULT ''",
                                   "translation"=> "TEXT DEFAULT NULL",
                                   "PRIMARY KEY (id, language)",
                                   "INDEX id (id)" ),
                                   "ENGINE = INNODB
                                    AVG_ROW_LENGTH = 113
                                    CHARACTER SET utf8
                                    COLLATE utf8_general_ci"
                           );*/
    }    
    
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}