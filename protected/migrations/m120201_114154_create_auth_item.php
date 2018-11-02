<?php

class m120201_114154_create_auth_item extends CDbMigration
{
    private $_table = 'auth_item';

    public function safeUp()
    {
        /*$this->createTable($this->_table, 
                           array( 'name'        => 'VARCHAR(64) NOT NULL',
                                  'type'        => 'INT(11) NOT NULL',
                                  'description' => 'TEXT DEFAULT NULL',
                                  'bizrule'     => 'TEXT DEFAULT NULL',                    
                                  '`data`'      => 'TEXT DEFAULT NULL',
                                  'PRIMARY KEY (name)'                      
                                ),
                           'ENGINE = INNODB
                            AVG_ROW_LENGTH = 195
                            CHARACTER SET utf8
                            COLLATE utf8_general_ci;'
                );
        
        $this->insert($this->_table,
            array(
                    'name'=>'admin',
                    'type'=>2,
                    'description'=>'',
                    'bizrule'=>NULL,                            
                    '`data`'=>'N;',
        ));*/
        
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}