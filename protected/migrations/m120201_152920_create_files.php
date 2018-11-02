<?php

class m120201_152920_create_files extends CDbMigration
{
    private $_table = 'files';
    
    public function safeUp()
    {        
        /*$this->createTable( $this->_table,                 
                            array( "id"             => "INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Ид.файла'",
                                   "uid"            => "VARCHAR(75) NOT NULL COMMENT 'Уникальный ID файла'",
                                   "status"         => "ENUM('created', 'actived', 'refused', 'deleted') DEFAULT 'created' COMMENT 'Статус файла'",
                                   "name"           => "VARCHAR(255) NOT NULL COMMENT 'Имя файла, присвоенное пользователем'",
                                   "timetamp_x"     => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Орегинальная дата создания файла'",
                                   "`order`"        => "INT(11) UNSIGNED NOT NULL DEFAULT 500 COMMENT 'Порядок'",
                                   "height"         => "INT(18) UNSIGNED DEFAULT NULL COMMENT 'Высота'",
                                   "width"          => "INT(18) UNSIGNED DEFAULT NULL COMMENT 'Ширина'",
                                   "file_size"      => "INT(18) UNSIGNED DEFAULT NULL COMMENT 'Размер файла'",
                                   "ext"            => "CHAR(4) NOT NULL COMMENT 'Расширение файла'",
                                   "subdir"         => "VARCHAR(255) DEFAULT 'null' COMMENT 'Путь к файлу'",
                                   "file_name"      => "VARCHAR(255) DEFAULT 'null' COMMENT 'Имя файла на диске'",
                                   "original_name"  => "VARCHAR(255) NOT NULL COMMENT 'Орегинальное имя файла'",
                                   "content_type"   => "VARCHAR(75) DEFAULT 'IMAGE' COMMENT 'Тип контента'",
                                   "module_id"      => "VARCHAR(50) DEFAULT 'null' COMMENT 'Ид.модуля'",
                                   "handler_id"     => "VARCHAR(50) DEFAULT 'null' COMMENT 'Ид.заголовка'",
                                   "created_user"   => "INT(11) UNSIGNED NOT NULL COMMENT 'Ид.пользователя'",
                                   "updated_user"   => "INT(11) DEFAULT NULL COMMENT 'Ид.пользователя внесшего изменения'",
                                   "created"        => "DATETIME DEFAULT NULL COMMENT 'Дата создания картинки'",
                                   "updated"        => "DATETIME DEFAULT NULL COMMENT 'Дата обновления картинки'",
                                   "description"    => "VARCHAR(255) DEFAULT 'null' COMMENT 'Описание'",
                                   "PRIMARY KEY (id)" ),
                                   "ENGINE = MYISAM
                                    AUTO_INCREMENT = 79
                                    AVG_ROW_LENGTH = 130
                                    CHARACTER SET utf8
                                    COLLATE utf8_general_ci"
                           );*/
    }    
    
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}