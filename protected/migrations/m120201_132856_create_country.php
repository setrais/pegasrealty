<?php

class m120201_132856_create_country extends CDbMigration
{
    private $_table = 'country';
    
    public function safeUp()
    {        
        $this->createTable( $this->_table,                 
                            array( 'id'     => "MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Ид.страны'",
                                   'name'   => "VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Наименование страны'",
                                   'PRIMARY KEY (id)'),
                                   'ENGINE = INNODB
                                    AUTO_INCREMENT = 219
                                    AVG_ROW_LENGTH = 75
                                    CHARACTER SET utf8
                                    COLLATE utf8_general_ci;'
                           );
                          
    }    
    
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}