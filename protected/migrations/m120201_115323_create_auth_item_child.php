<?php

class m120201_115323_create_auth_item_child extends CDbMigration
{
    private $_table = 'auth_item_child';

    public function safeUp()
    {
        $this->createTable($this->_table, array(            
                'parent'=>'VARCHAR(64) NOT NULL',
                'child'=>'VARCHAR(64) NOT NULL',
                'PRIMARY KEY (parent, child)',
                'INDEX child (child)',  
              ),
              'ENGINE = INNODB
               AVG_ROW_LENGTH = 215
               CHARACTER SET utf8
               COLLATE utf8_general_ci'
        );
                          
        $this->addForeignKey('auth_item_child_ibfk_1', 'auth_item_child', 'parent',
                                     'auth_item', 'name','CASCADE',"CASCADE");
        $this->addForeignKey('auth_item_child_ibfk_2', 'auth_item_child', 'child',
                                     'auth_item', 'name','CASCADE',"CASCADE");          
        
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}