<?php

class m120201_221044_create_tbl_migration extends CDbMigration
{
    private $_table = 'tbl_migration';
        
    public function safeUp()
    {        
       /*$this->createTable( $this->_table,                 
                           array( "version"     => "VARCHAR(255) NOT NULL",
                                  "apply_time"  => "INT(11) DEFAULT NULL",
                                  "PRIMARY KEY (version)" ),
                                  "ENGINE = MYISAM
                                   AVG_ROW_LENGTH = 46
                                   CHARACTER SET utf8
                                   COLLATE utf8_general_ci"
                           );*/
    }    
    
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }  
}