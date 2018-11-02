<?php

class m120201_153703_create_iblocks extends CDbMigration
{
    private $_table = 'iblocks';
    
    public function safeUp()
    {        
        /*$this->createTable( $this->_table,                 
                            array( "id"         => "INT(11) NOT NULL AUTO_INCREMENT",
                                   "uid"        => "VARCHAR(75) NOT NULL COMMENT 'Уникальный ID инфоблока'",
                                   "grid"       => "INT(11) DEFAULT NULL COMMENT 'ID группы инфоблоков'",
                                   "name"       => "VARCHAR(75) DEFAULT NULL COMMENT 'Название инфоблока (новости, раздела новостей, предложений, раздела предложений'",
                                   "visname"    => "VARCHAR(255) DEFAULT NULL",
                                   "title"      => "VARCHAR(255) DEFAULT NULL COMMENT 'Заголовкок SEO  (новостей, разделов, предложений и т.д.)'",
                                   "keywords"   => "TEXT DEFAULT NULL COMMENT 'Ключевые слова SEO'",
                                   "description"=> "TEXT DEFAULT NULL COMMENT 'Описание инфоблока SEO'",
                                   "anons"      => "VARCHAR(257) DEFAULT NULL COMMENT 'Анонс инфоблока'",
                                   "pic_anons"  => "VARCHAR(255) DEFAULT NULL COMMENT 'Путь к картинке анонса'",
                                   "pic_detile" => "TEXT DEFAULT NULL COMMENT 'Путь к картинке детально'",
                                   "act"        => "TINYINT(1) DEFAULT NULL COMMENT 'Пометка активации'",
                                   "del"        => "TINYINT(1) DEFAULT NULL COMMENT 'Пометка удаления'",
                                   "createusers"=> "INT(11) DEFAULT NULL COMMENT 'Id Пользователя создавшего запись'",
                                   "createdate" => "DATETIME DEFAULT NULL COMMENT 'Дата создания'",
                                   "updateusers"=> "INT(11) DEFAULT NULL COMMENT 'Пользователь обновившый запись'",
                                   "updatedate" => "DATETIME DEFAULT NULL COMMENT 'Дата обновления'",
                                   "detile"     => "TEXT DEFAULT NULL COMMENT 'Детальная информация'",
                                   "sort"       => "INT(11) DEFAULT NULL COMMENT 'Сортировка инфоблоков'",
                                   "cid"        => "VARCHAR(75) DEFAULT NULL COMMENT 'Дополнительные свойства инфоблока - ( props ->exts) '",
                                   "is_main"    => "TINYINT(1) DEFAULT NULL COMMENT 'Пометка показывать на главной'",
                                   "is_pay"     => "TINYINT(1) DEFAULT NULL COMMENT 'Пометка о покупке'",
                                   "is_arhiv"   => "TINYINT(1) DEFAULT NULL COMMENT 'Пометка об помещении в архив'",
                                   "is_use"     => "TINYINT(1) DEFAULT NULL COMMENT 'Пометка об использовании'",
                                   "maps_id"    => "VARCHAR(75) DEFAULT NULL COMMENT 'ID Карта проведения акции'",
                                   "types_iblocks_id"   => "INT(11) DEFAULT NULL COMMENT 'Ид типа инфоблока'",
                                   "iurl"               => "VARCHAR(255) DEFAULT NULL COMMENT 'URL Инфоблока'",
                                   "url"                => "TEXT DEFAULT NULL COMMENT 'Url страницы или раздела'",
                                   "city"               => "INT(11) NOT NULL COMMENT 'Город к которому принадлежит инфоблок'",
                                   "visible"            => "VARCHAR(255) DEFAULT NULL",
                                   "`action`"           => "VARCHAR(255) DEFAULT NULL",
                                   "PRIMARY KEY (id),
                                    INDEX city (city),
                                    UNIQUE INDEX id (id),
                                    UNIQUE INDEX maps_id (maps_id),
                                    UNIQUE INDEX uid (uid)"),
                                   "ENGINE = INNODB
                                    AUTO_INCREMENT = 8
                                    AVG_ROW_LENGTH = 2340
                                    CHARACTER SET utf8
                                    COLLATE utf8_general_ci
                                    COMMENT = 'Таблица инфоблоков'"
                           );*/
    }    
    
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}