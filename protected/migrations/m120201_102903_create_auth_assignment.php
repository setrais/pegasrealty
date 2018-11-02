<?php

class m120201_102903_create_auth_assignment extends CDbMigration
{
    private $_table = 'auth_assignment';

    public function safeUp()
    {
        /*$this->createTable($this->_table, array(
              'itemname'    => 'VARCHAR(64) NOT NULL',
              'userid'      => 'VARCHAR(64) NOT NULL',
              'bizrule'     => 'TEXT DEFAULT NULL',
              '`data`'      => 'TEXT DEFAULT NULL',
              'PRIMARY KEY (itemname, userid)
               CONSTRAINT auth_assignment_ibfk_1 FOREIGN KEY (itemname)
               REFERENCES auth_item (name) ON DELETE CASCADE ON UPDATE CASCADE'            
        ));*/
        
        /*$this->insert($this->_table,
            array(
                    'itemname'=>'admin',
                    'userid'=>'1',
                    'bizrule'=>'',
                    '`data`'=>'s:0:"";',
        ));*/
        
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}