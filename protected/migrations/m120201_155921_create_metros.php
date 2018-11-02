<?php

class m120201_155921_create_metros extends CDbMigration
{
    private $_table = 'metros';
    
    public function safeUp()
    {        
        /*$this->createTable( $this->_table,                 
                            array( "id"           => "INT(11) NOT NULL AUTO_INCREMENT",
                                   "city_id"      => "INT(11) NOT NULL",
                                   "title"        => "VARCHAR(255) DEFAULT NULL",
                                   "map_latitude" => "VARCHAR(255) DEFAULT NULL",
                                   "map_longitude"=> "VARCHAR(255) DEFAULT NULL",
                                   "street"       => "VARCHAR(100) DEFAULT NULL",
                                   "house"        => "VARCHAR(10) DEFAULT NULL",
                                   "PRIMARY KEY (id)",
                                   "INDEX metro_city_ibfk_1 (city_id)" ),
                            "ENGINE = INNODB
                             AUTO_INCREMENT = 180
                             AVG_ROW_LENGTH = 226
                             CHARACTER SET utf8
                             COLLATE utf8_general_ci"
                           );*/
    }    
    
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}