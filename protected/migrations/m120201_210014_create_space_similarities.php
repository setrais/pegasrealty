<?php

class m120201_210014_create_space_similarities extends CDbMigration
{
    private $_table = 'space_similarities';
        
    public function safeUp()
    {        
       /*$this->createTable( $this->_table,                 
                            array( "id"             => "INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.записи'",
                                   "space_id"       => "INT(11) DEFAULT NULL COMMENT 'Ид.аренды'",
                                   "similaries_id"  => "INT(11) DEFAULT NULL COMMENT 'Ид.свойства'",
                                   "PRIMARY KEY (id)" ),
                                   "ENGINE = INNODB
                                    AUTO_INCREMENT = 1
                                    CHARACTER SET utf8
                                    COLLATE utf8_general_ci
                                    COMMENT = 'Родственная жилплощадь'"
                           );*/
    }    
    
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }   
}