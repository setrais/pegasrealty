<?php

class m120201_212606_create_spaces extends CDbMigration
{
    private $_table = 'spaces';
        
    public function safeUp()
    {        
       /*$this->createTable( $this->_table,                 
                            array( "id"             => "INT(11) NOT NULL AUTO_INCREMENT",
                                   "district_id"    => "INT(11) DEFAULT NULL COMMENT 'Ид. административного округа'",
                                   "map_latitude"   => "VARCHAR(255) DEFAULT NULL COMMENT 'Латитуда на карте'",
                                   "map_longitude"  => "VARCHAR(255) DEFAULT NULL COMMENT 'Лонгитуда на карте'",
                                   "pic_scr_id"     => "VARCHAR(255) DEFAULT NULL COMMENT 'Картинка скриншота'",
                                   "number_tax"     => "INT(11) UNSIGNED DEFAULT NULL COMMENT 'Номер налоговой'",
                                   "area"           => "DECIMAL(10, 2) UNSIGNED NOT NULL COMMENT 'Площадь'",
                                   "price"          => "DECIMAL(10, 2) UNSIGNED NOT NULL COMMENT 'Стоимость квадратного метра'",
                                   "pic_scr_id"     => "VARCHAR(255) DEFAULT NULL COMMENT 'Картинка скриншота'",
                                   "pic_anons_id"   => "VARCHAR(255) DEFAULT NULL COMMENT 'Картинка анонса'",
                                   "pic_detile_id"  => "VARCHAR(255) DEFAULT NULL COMMENT 'Детальная картинка'",
                                   "remoteness"     => "DECIMAL(10, 2) UNSIGNED DEFAULT NULL COMMENT 'Удаленность'",
                                   "unit_id"        => "INT(11) UNSIGNED DEFAULT NULL COMMENT 'Единица измерения'",
                                   "unit_value"     => "DECIMAL(10, 2) UNSIGNED DEFAULT NULL COMMENT 'Значение ед.измерения'",
                                   "date_rang"      => "TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата прозвона'",
                                   "date_release"   => "TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата освобождения'",
                                   "in_stock"       => "TINYINT(1) DEFAULT NULL COMMENT 'В наличии'",
                                   "metro_id"       => "INT(11) DEFAULT NULL COMMENT 'Ид.метро'",
                                   "planning_id"    => "INT(11) DEFAULT NULL COMMENT 'Ид.планировки'",
                                   "tax_id"         => "INT(11) DEFAULT NULL COMMENT 'Ид.налогооблажения'",
                                   "parking_id"     => "INT(11) DEFAULT NULL COMMENT 'Ид.парковки'",
                                   "cnt_parking_place" => "INT(11) DEFAULT NULL COMMENT 'Количество машино мест '",
                                   "telephone"      => "VARCHAR(255) DEFAULT NULL COMMENT 'Телефон'",
                                   "site"           => "VARCHAR(255) DEFAULT NULL COMMENT 'Cайт'",
                                   "representative_id" => "VARCHAR(255) DEFAULT NULL COMMENT 'Представитель'",
                                   "commission_id"  => "INT(11) DEFAULT NULL COMMENT 'Ид. коммисии'",
                                   "procent_commission" => "SMALLINT(3) DEFAULT NULL COMMENT 'Процент коммиссии'",
                                   "contract_type_id"   => "INT(11) DEFAULT NULL COMMENT 'Ид.типа контракта'",
                                   "contract_number"    => "VARCHAR(255) DEFAULT NULL COMMENT 'Номер контракта'",
                                   "tax_number"     => "VARCHAR(255) DEFAULT NULL COMMENT 'Номер налоговой'",
                                   "fav"            => "TINYINT(1) DEFAULT NULL COMMENT 'Cтатус избранного'",
                                   "space_type_id"  => "VARCHAR(255) DEFAULT NULL COMMENT 'Тип аренды'",
                                   "title"          => "VARCHAR(75) DEFAULT NULL COMMENT 'Название недвижемости'",
                                   "space_class_id" => "INT(11) DEFAULT NULL COMMENT 'Класс аренды'",
                                   "space_vid_id"   => "INT(11) DEFAULT NULL COMMENT 'Вид жилплощади'",
                                   "anons"          => "TEXT DEFAULT NULL COMMENT 'Анонс жилплощади'",
                                   "detile"         => "TEXT DEFAULT NULL COMMENT 'Детально о жилплощади'",
                                   "`desc`"         => "TEXT DEFAULT NULL COMMENT 'Общее описание'",
                                   "PRIMARY KEY (id)" ),
                                   "ENGINE = INNODB
                                    AUTO_INCREMENT = 1
                                    CHARACTER SET utf8
                                    COLLATE utf8_general_ci
                                    COMMENT = 'Аренда'"
                           );*/
    }    
    
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }  
}