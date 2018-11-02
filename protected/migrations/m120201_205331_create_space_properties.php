<?php

class m120201_205331_create_space_properties extends CDbMigration
{
    private $_table = 'space_properties';
        
    public function safeUp()
    {        
       /*$this->createTable( $this->_table,                 
                            array( "id"         => "INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.записи'",
                                   "space_id"   => "INT(11) DEFAULT NULL COMMENT 'Ид.аренды'",
                                   "property_id"=> "INT(11) DEFAULT NULL COMMENT 'Ид.свойства'",
                                   "PRIMARY KEY (id)" ),
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