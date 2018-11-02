<?php

class m120201_185645_create_space_fotos extends CDbMigration
{
    private $_table = 'space_fotos';
        
    public function safeUp()
    {        
       /*$this->createTable( $this->_table,                 
                            array( "id" => "INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.записи'",
                                   "space_id"  => "INT(11) DEFAULT NULL COMMENT 'Ид.аренды'",
                                   "file_id"   => "INT(11) DEFAULT NULL COMMENT 'Ид.фотографии'",
                                   "space_foto_type_id" => "INT(11) DEFAULT NULL COMMENT 'Ид. типа фотографии'",
                                   "PRIMARY KEY (id)" ),
                                   "ENGINE = INNODB
                                    AUTO_INCREMENT = 1
                                    CHARACTER SET utf8
                                    COLLATE utf8_general_ci
                                    COMMENT = 'Свойства фотографий'"
                           );*/       
    }    
    
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }   
}