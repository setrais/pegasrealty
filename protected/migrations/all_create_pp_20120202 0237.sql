-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 5.0.63.1
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 02.02.2012 2:42:38
-- Версия сервера: 5.1.49-3-log
-- Версия клиента: 4.1

DROP DATABASE IF EXISTS pp;
CREATE DATABASE IF NOT EXISTS pp
CHARACTER SET utf8
COLLATE utf8_general_ci;

USE pp;

CREATE TABLE IF NOT EXISTS auth_item(
  name VARCHAR(64) NOT NULL,
  type INT(11) NOT NULL,
  description TEXT DEFAULT NULL,
  bizrule TEXT DEFAULT NULL,
  `data` TEXT DEFAULT NULL,
  PRIMARY KEY (name)
)
ENGINE = INNODB
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS client_types(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.налого облажения',
  abbr VARCHAR(255) DEFAULT NULL COMMENT 'Абривиатура',
  title VARCHAR(255) DEFAULT NULL COMMENT 'Наименование',
  sort INT(11) DEFAULT 500 COMMENT 'Сортировка',
  act TINYINT(1) DEFAULT NULL COMMENT 'Статус активности',
  del TINYINT(1) DEFAULT NULL COMMENT 'Статус удаления',
  create_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата создания',
  update_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата обновления',
  `desc` TEXT DEFAULT NULL COMMENT 'Описание',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Типы контрактов';

CREATE TABLE IF NOT EXISTS commissions(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.налого облажения',
  abbr VARCHAR(255) DEFAULT NULL COMMENT 'Абривиатура',
  title VARCHAR(255) DEFAULT NULL COMMENT 'Наименование',
  sort INT(11) DEFAULT 500 COMMENT 'Сортировка',
  act TINYINT(1) DEFAULT NULL COMMENT 'Статус активности',
  del TINYINT(1) DEFAULT NULL COMMENT 'Статус удаления',
  create_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата создания',
  update_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата обновления',
  `desc` TEXT DEFAULT NULL COMMENT 'Описание',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Справочник коммисий';

CREATE TABLE IF NOT EXISTS contract_types(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.налого облажения',
  abbr VARCHAR(255) DEFAULT NULL COMMENT 'Абривиатура',
  title VARCHAR(255) DEFAULT NULL COMMENT 'Наименование',
  sort INT(11) DEFAULT 500 COMMENT 'Сортировка',
  act TINYINT(1) DEFAULT NULL COMMENT 'Статус активности',
  del TINYINT(1) DEFAULT NULL COMMENT 'Статус удаления',
  create_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата создания',
  update_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата обновления',
  `desc` TEXT DEFAULT NULL COMMENT 'Описание',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Типы контрактов';

CREATE TABLE IF NOT EXISTS country(
  id MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Ид.страны',
  name VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Наименование страны',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 219
AVG_ROW_LENGTH = 75
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS districts(
  id INT(11) NOT NULL AUTO_INCREMENT,
  sid VARCHAR(255) DEFAULT NULL COMMENT 'Cивольный Ид',
  abbr VARCHAR(255) DEFAULT NULL COMMENT 'Абривиатура района',
  title VARCHAR(255) NOT NULL COMMENT 'Название района',
  sort INT(11) DEFAULT 500 COMMENT 'Сортировка',
  `desc` TEXT DEFAULT NULL COMMENT 'Описание',
  PRIMARY KEY (id),
  UNIQUE INDEX sid (sid)
)
ENGINE = INNODB
AUTO_INCREMENT = 10
AVG_ROW_LENGTH = 1820
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Cправочник районов';

CREATE TABLE IF NOT EXISTS files(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.файла',
  uid VARCHAR(75) NOT NULL COMMENT 'Уникальный ID файла',
  status ENUM('created', 'actived', 'refused', 'deleted') DEFAULT 'created' COMMENT 'Статус файла',
  name VARCHAR(255) NOT NULL COMMENT 'Имя файла, присвоенное пользователем',
  timetamp_x TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Орегинальная дата создания файла',
  `order` INT(11) UNSIGNED NOT NULL DEFAULT 500 COMMENT 'Порядок',
  height INT(18) UNSIGNED DEFAULT NULL COMMENT 'Высота',
  width INT(18) UNSIGNED DEFAULT NULL COMMENT 'Ширина',
  file_size INT(18) UNSIGNED DEFAULT NULL COMMENT 'Размер файла',
  ext CHAR(4) NOT NULL COMMENT 'Расширение файла',
  subdir VARCHAR(255) DEFAULT 'null' COMMENT 'Путь к файлу',
  file_name VARCHAR(255) DEFAULT 'null' COMMENT 'Имя файла на диске',
  original_name VARCHAR(255) NOT NULL COMMENT 'Орегинальное имя файла',
  content_type VARCHAR(75) DEFAULT 'IMAGE' COMMENT 'Тип контента',
  module_id VARCHAR(50) DEFAULT 'null' COMMENT 'Ид.модуля',
  handler_id VARCHAR(50) DEFAULT 'null' COMMENT 'Ид.заголовка',
  created_user INT(11) UNSIGNED NOT NULL COMMENT 'Ид.пользователя',
  updated_user INT(11) DEFAULT NULL COMMENT 'Ид.пользователя внесшего изменения',
  created DATETIME DEFAULT NULL COMMENT 'Дата создания картинки',
  updated DATETIME DEFAULT NULL COMMENT 'Дата обновления картинки',
  description VARCHAR(255) DEFAULT 'null' COMMENT 'Описание',
  PRIMARY KEY (id),
  UNIQUE INDEX UK_files_id (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Файлы';

CREATE TABLE IF NOT EXISTS iblocks(
  id INT(11) NOT NULL AUTO_INCREMENT,
  uid VARCHAR(75) NOT NULL COMMENT 'Уникальный ID инфоблока',
  grid INT(11) DEFAULT NULL COMMENT 'ID группы инфоблоков',
  name VARCHAR(75) DEFAULT NULL COMMENT 'Название инфоблока (новости, раздела новостей, предложений, раздела предложений',
  visname VARCHAR(255) DEFAULT NULL,
  title VARCHAR(255) DEFAULT NULL COMMENT 'Заголовкок SEO  (новостей, разделов, предложений и т.д.)',
  keywords TEXT DEFAULT NULL COMMENT 'Ключевые слова SEO',
  description TEXT DEFAULT NULL COMMENT 'Описание инфоблока SEO',
  anons VARCHAR(257) DEFAULT NULL COMMENT 'Анонс инфоблока',
  pic_anons VARCHAR(255) DEFAULT NULL COMMENT 'Путь к картинке анонса',
  pic_detile TEXT DEFAULT NULL COMMENT 'Путь к картинке детально',
  act TINYINT(1) DEFAULT NULL COMMENT 'Пометка активации',
  del TINYINT(1) DEFAULT NULL COMMENT 'Пометка удаления',
  createusers INT(11) DEFAULT NULL COMMENT 'Id Пользователя создавшего запись',
  createdate DATETIME DEFAULT NULL COMMENT 'Дата создания',
  updateusers INT(11) DEFAULT NULL COMMENT 'Пользователь обновившый запись',
  updatedate DATETIME DEFAULT NULL COMMENT 'Дата обновления',
  detile TEXT DEFAULT NULL COMMENT 'Детальная информация',
  sort INT(11) DEFAULT NULL COMMENT 'Сортировка инфоблоков',
  cid VARCHAR(75) DEFAULT NULL COMMENT 'Дополнительные свойства инфоблока - ( props ->exts) ',
  is_main TINYINT(1) DEFAULT NULL COMMENT 'Пометка показывать на главной',
  is_pay TINYINT(1) DEFAULT NULL COMMENT 'Пометка о покупке',
  is_arhiv TINYINT(1) DEFAULT NULL COMMENT 'Пометка об помещении в архив',
  is_use TINYINT(1) DEFAULT NULL COMMENT 'Пометка об использовании',
  maps_id VARCHAR(75) DEFAULT NULL COMMENT 'ID Карта проведения акции',
  types_iblocks_id INT(11) DEFAULT NULL COMMENT 'Ид типа инфоблока',
  iurl VARCHAR(255) DEFAULT NULL COMMENT 'URL Инфоблока',
  url TEXT DEFAULT NULL COMMENT 'Url страницы или раздела',
  city INT(11) NOT NULL COMMENT 'Город к которому принадлежит инфоблок',
  visible VARCHAR(255) DEFAULT NULL,
  `action` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id),
  INDEX city (city),
  UNIQUE INDEX id (id),
  UNIQUE INDEX maps_id (maps_id),
  UNIQUE INDEX uid (uid)
)
ENGINE = INNODB
AUTO_INCREMENT = 8
AVG_ROW_LENGTH = 2340
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Таблица инфоблоков';

CREATE TABLE IF NOT EXISTS messages(
  id INT(11) NOT NULL DEFAULT 0,
  language VARCHAR(16) NOT NULL DEFAULT '',
  translation TEXT DEFAULT NULL,
  PRIMARY KEY (id, language),
  INDEX id (id)
)
ENGINE = INNODB
AVG_ROW_LENGTH = 113
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS metros(
  id INT(11) NOT NULL AUTO_INCREMENT,
  city_id INT(11) NOT NULL,
  title VARCHAR(255) DEFAULT NULL,
  map_latitude VARCHAR(255) DEFAULT NULL,
  map_longitude VARCHAR(255) DEFAULT NULL,
  street VARCHAR(100) DEFAULT NULL,
  house VARCHAR(10) DEFAULT NULL,
  PRIMARY KEY (id),
  INDEX metro_city_ibfk_1 (city_id)
)
ENGINE = INNODB
AUTO_INCREMENT = 180
AVG_ROW_LENGTH = 226
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS parkings(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.налого облажения',
  abbr VARCHAR(255) DEFAULT NULL COMMENT 'Абривиатура',
  title VARCHAR(255) DEFAULT NULL COMMENT 'Наименование',
  sort INT(11) DEFAULT 500 COMMENT 'Сортировка',
  act TINYINT(1) DEFAULT NULL COMMENT 'Статус активности',
  del TINYINT(1) DEFAULT NULL COMMENT 'Статус удаления',
  create_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата создания',
  update_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата обновления',
  `desc` TEXT DEFAULT NULL COMMENT 'Описание',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Справочник паркинга';

CREATE TABLE IF NOT EXISTS plannings(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.планировки',
  abbr VARCHAR(255) DEFAULT NULL COMMENT 'Абривиатура',
  title VARCHAR(255) DEFAULT NULL COMMENT 'Наименование планировки',
  sort INT(11) DEFAULT NULL COMMENT 'Сортировка',
  act TINYINT(1) DEFAULT NULL COMMENT 'Активность',
  del TINYINT(1) DEFAULT NULL COMMENT 'Cтатус удаления',
  `desc` TEXT DEFAULT NULL COMMENT 'Описание',
  date_create TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата создания',
  date_update TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата обновления',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 7
AVG_ROW_LENGTH = 2730
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS properties(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.налого облажения',
  abbr VARCHAR(255) DEFAULT NULL COMMENT 'Абривиатура',
  title VARCHAR(255) DEFAULT NULL COMMENT 'Наименование',
  sort INT(11) DEFAULT 500 COMMENT 'Сортировка',
  act TINYINT(1) DEFAULT NULL COMMENT 'Статус активности',
  del TINYINT(1) DEFAULT NULL COMMENT 'Статус удаления',
  create_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата создания',
  update_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата обновления',
  `desc` TEXT DEFAULT NULL COMMENT 'Описание',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Свойства';

CREATE TABLE IF NOT EXISTS representatives(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.налого облажения',
  space_id VARCHAR(255) DEFAULT NULL COMMENT 'Ид.аренды',
  name VARCHAR(255) DEFAULT NULL COMMENT 'Наименование',
  fio VARCHAR(255) DEFAULT NULL,
  site VARCHAR(255) DEFAULT NULL COMMENT 'Сайт представителя',
  telephone VARCHAR(255) DEFAULT NULL COMMENT 'Телефон представителя',
  sort INT(11) DEFAULT 500 COMMENT 'Сортировка',
  act TINYINT(1) DEFAULT NULL COMMENT 'Статус активности',
  del TINYINT(1) DEFAULT NULL COMMENT 'Статус удаления',
  create_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата создания',
  update_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата обновления',
  `desc` TEXT DEFAULT NULL COMMENT 'Описание',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Представители';

CREATE TABLE IF NOT EXISTS source_messages(
  id INT(11) NOT NULL AUTO_INCREMENT,
  uid VARCHAR(75) DEFAULT NULL,
  category VARCHAR(32) DEFAULT NULL,
  section VARCHAR(32) DEFAULT NULL,
  message TEXT DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX id (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 49
AVG_ROW_LENGTH = 341
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS space_classes(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.налого облажения',
  abbr VARCHAR(255) DEFAULT NULL COMMENT 'Абривиатура',
  title VARCHAR(255) DEFAULT NULL COMMENT 'Наименование',
  sort INT(11) DEFAULT 500 COMMENT 'Сортировка',
  act TINYINT(1) DEFAULT NULL COMMENT 'Статус активности',
  del TINYINT(1) DEFAULT NULL COMMENT 'Статус удаления',
  create_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата создания',
  update_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата обновления',
  `desc` TEXT DEFAULT NULL COMMENT 'Описание',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 13
AVG_ROW_LENGTH = 2730
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Справочник паркинга';

CREATE TABLE IF NOT EXISTS space_foto_types(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.планировки',
  abbr VARCHAR(255) DEFAULT NULL COMMENT 'Абривиатура',
  title VARCHAR(255) DEFAULT NULL COMMENT 'Наименование планировки',
  sort INT(11) DEFAULT NULL COMMENT 'Сортировка',
  act TINYINT(1) DEFAULT NULL COMMENT 'Активность',
  del TINYINT(1) DEFAULT NULL COMMENT 'Cтатус удаления',
  `desc` TEXT DEFAULT NULL COMMENT 'Описание',
  date_create TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата создания',
  date_update TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата обновления',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS space_types(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.налого облажения',
  abbr VARCHAR(255) DEFAULT NULL COMMENT 'Абривиатура',
  title VARCHAR(255) DEFAULT NULL COMMENT 'Наименование',
  sort INT(11) DEFAULT 500 COMMENT 'Сортировка',
  act TINYINT(1) DEFAULT NULL COMMENT 'Статус активности',
  del TINYINT(1) DEFAULT NULL COMMENT 'Статус удаления',
  create_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата создания',
  update_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата обновления',
  `desc` TEXT DEFAULT NULL COMMENT 'Описание',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 6
AVG_ROW_LENGTH = 3276
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Справочник паркинга';

CREATE TABLE IF NOT EXISTS space_vids(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.налого облажения',
  abbr VARCHAR(255) DEFAULT NULL COMMENT 'Абривиатура',
  title VARCHAR(255) DEFAULT NULL COMMENT 'Наименование',
  sort INT(11) DEFAULT 500 COMMENT 'Сортировка',
  act TINYINT(1) DEFAULT NULL COMMENT 'Статус активности',
  del TINYINT(1) DEFAULT NULL COMMENT 'Статус удаления',
  create_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата создания',
  update_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата обновления',
  `desc` TEXT DEFAULT NULL COMMENT 'Описание',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 17
AVG_ROW_LENGTH = 1638
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Справочник паркинга';

CREATE TABLE IF NOT EXISTS taxs(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.налого облажения',
  abbr VARCHAR(255) DEFAULT NULL COMMENT 'Абривиатура',
  title VARCHAR(255) DEFAULT NULL COMMENT 'Наименование',
  sort INT(11) DEFAULT 500 COMMENT 'Сортировка',
  act TINYINT(1) DEFAULT NULL COMMENT 'Статус активности',
  del TINYINT(1) DEFAULT NULL COMMENT 'Статус удаления',
  create_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата создания',
  update_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата обновления',
  `desc` TEXT DEFAULT NULL COMMENT 'Описание',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Справочник налогооблажений';

CREATE TABLE IF NOT EXISTS tbl_migration(
  version VARCHAR(255) NOT NULL,
  apply_time INT(11) DEFAULT NULL,
  PRIMARY KEY (version)
)
ENGINE = MYISAM
AVG_ROW_LENGTH = 45
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS types_iblocks(
  id INT(11) NOT NULL AUTO_INCREMENT,
  grid INT(11) DEFAULT NULL COMMENT 'Предок типа инфоблока',
  name VARCHAR(75) DEFAULT NULL COMMENT 'Наименование типа инфоблока',
  `desc` VARCHAR(75) DEFAULT NULL COMMENT 'Описание инфоблока',
  act TINYINT(1) DEFAULT NULL COMMENT 'Отметка активности',
  del TINYINT(1) DEFAULT NULL COMMENT 'Пометка удаления',
  PRIMARY KEY (id),
  UNIQUE INDEX id (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS units(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид. единицы измерения',
  title VARCHAR(255) DEFAULT NULL COMMENT 'Название единицы измерения',
  short_title VARCHAR(255) DEFAULT NULL COMMENT 'Короткое название ед.измерения',
  sort INT(11) DEFAULT NULL COMMENT 'Сортировка',
  act TINYINT(1) DEFAULT NULL COMMENT 'Активность',
  del TINYINT(1) DEFAULT NULL COMMENT 'Пометка об удалении',
  `desc` TEXT DEFAULT NULL COMMENT 'Описание',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS users(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'ID пользователя',
  uid VARCHAR(75) DEFAULT NULL COMMENT 'Уникальный ID пользователя',
  title VARCHAR(45) DEFAULT NULL COMMENT 'Имя пользователя',
  username VARCHAR(255) DEFAULT NULL COMMENT 'Полное имя пользователя',
  `password` VARCHAR(255) DEFAULT NULL COMMENT 'Пароль пользователя',
  email VARCHAR(255) DEFAULT NULL COMMENT 'Email пользователя',
  send_email VARCHAR(255) DEFAULT NULL COMMENT 'Email отправки писем',
  register_date DATETIME DEFAULT NULL COMMENT 'Дата регистрации',
  lastvisit_date DATETIME DEFAULT NULL COMMENT 'Дата последнего визита',
  description VARCHAR(255) DEFAULT NULL COMMENT 'Описание пользователя',
  sort INT(11) DEFAULT 500 COMMENT 'Сортировка',
  del INT(11) DEFAULT 0 COMMENT 'Пометка об удалении',
  act INT(1) DEFAULT 1 COMMENT 'Пометка активности',
  create_date DATETIME DEFAULT NULL COMMENT 'Дата создания пользователя',
  update_date DATETIME DEFAULT NULL COMMENT 'Дата удаления пользователя',
  param_id INT(11) DEFAULT NULL COMMENT 'Параметры пользователя',
  param_uid VARCHAR(255) DEFAULT NULL COMMENT 'Уникальный ID параметров пользователя',
  phpBBLogin VARCHAR(75) DEFAULT NULL COMMENT 'Логин пользователя на форуме',
  PRIMARY KEY (id),
  INDEX act (act),
  INDEX datecreate (create_date),
  INDEX dateupdate (update_date),
  INDEX del (del),
  INDEX id (id),
  UNIQUE INDEX id_UNIQUE (id),
  UNIQUE INDEX iid_UNIQUE (uid),
  INDEX name (title),
  INDEX sort (sort)
)
ENGINE = INNODB
AUTO_INCREMENT = 2
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'List to tables systems';

CREATE TABLE IF NOT EXISTS auth_assignment(
  itemname VARCHAR(64) NOT NULL,
  userid VARCHAR(64) NOT NULL,
  bizrule TEXT DEFAULT NULL,
  `data` TEXT DEFAULT NULL,
  PRIMARY KEY (itemname, userid),
  CONSTRAINT auth_assignment_ibfk_1 FOREIGN KEY (itemname)
  REFERENCES auth_item (name) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS auth_item_child(
  parent VARCHAR(64) NOT NULL,
  child VARCHAR(64) NOT NULL,
  PRIMARY KEY (parent, child),
  INDEX child (child),
  CONSTRAINT auth_item_child_ibfk_1 FOREIGN KEY (parent)
  REFERENCES auth_item (name) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT auth_item_child_ibfk_2 FOREIGN KEY (child)
  REFERENCES auth_item (name) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS clients(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.налого облажения',
  abbr VARCHAR(255) DEFAULT NULL COMMENT 'Абривиатура',
  title VARCHAR(255) DEFAULT NULL COMMENT 'Наименование',
  sort INT(11) DEFAULT 500 COMMENT 'Сортировка',
  act TINYINT(1) DEFAULT NULL COMMENT 'Статус активности',
  del TINYINT(1) DEFAULT NULL COMMENT 'Статус удаления',
  create_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата создания',
  update_date TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата обновления',
  `desc` TEXT DEFAULT NULL COMMENT 'Описание',
  client_type_id INT(11) DEFAULT NULL COMMENT 'Ид. типа клиента',
  PRIMARY KEY (id),
  INDEX clients_client_types_fk1 (client_type_id),
  CONSTRAINT clients_client_types_fk1 FOREIGN KEY (client_type_id)
  REFERENCES client_types (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 4
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Справочник паркинга';

CREATE TABLE IF NOT EXISTS region(
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Ид.региона',
  country_id MEDIUMINT(8) UNSIGNED NOT NULL COMMENT 'Ид.страны',
  name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Нименование региона',
  PRIMARY KEY (id),
  INDEX country_id (country_id),
  CONSTRAINT region_country_fk_1 FOREIGN KEY (country_id)
  REFERENCES country (id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AUTO_INCREMENT = 1612
AVG_ROW_LENGTH = 64
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS spaces(
  id INT(11) NOT NULL AUTO_INCREMENT,
  district_id INT(11) DEFAULT NULL COMMENT 'Ид. административного округа',
  number_tax INT(11) UNSIGNED DEFAULT NULL COMMENT 'Номер налоговой',
  area DECIMAL(10, 2) UNSIGNED NOT NULL COMMENT 'Площадь',
  price DECIMAL(10, 2) UNSIGNED NOT NULL COMMENT 'Стоимость квадратного метра',
  pic_scr_id INT(11) DEFAULT NULL COMMENT 'Картинка скриншота',
  pic_anons_id INT(11) DEFAULT NULL COMMENT 'Картинка анонса',
  pic_detile_id INT(11) DEFAULT NULL COMMENT 'Детальная картинка',
  remoteness DECIMAL(10, 2) UNSIGNED DEFAULT NULL COMMENT 'Удаленность',
  unit_id INT(11) DEFAULT NULL COMMENT 'Единица измерения',
  unit_value DECIMAL(10, 2) UNSIGNED DEFAULT NULL COMMENT 'Значение ед.измерения',
  date_rang TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата прозвона',
  date_release TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата освобождения',
  in_stock TINYINT(1) DEFAULT NULL COMMENT 'В наличии',
  metro_id INT(11) DEFAULT NULL COMMENT 'Ид.метро',
  planning_id INT(11) DEFAULT NULL COMMENT 'Ид.планировки',
  tax_id INT(11) DEFAULT NULL COMMENT 'Ид.налогооблажения',
  parking_id INT(11) DEFAULT NULL COMMENT 'Ид.парковки',
  cnt_parking_place INT(11) DEFAULT NULL COMMENT 'Количество машино мест ',
  telephone VARCHAR(255) DEFAULT NULL COMMENT 'Телефон',
  site VARCHAR(255) DEFAULT NULL COMMENT 'Cайт',
  representative_id INT(11) DEFAULT NULL COMMENT 'Представитель',
  commission_id INT(11) DEFAULT NULL COMMENT 'Ид. коммисии',
  procent_commission SMALLINT(3) DEFAULT NULL COMMENT 'Процент коммиссии',
  contract_type_id INT(11) DEFAULT NULL COMMENT 'Ид.типа контракта',
  contract_number VARCHAR(255) DEFAULT NULL COMMENT 'Номер контракта',
  tax_number VARCHAR(255) DEFAULT NULL COMMENT 'Номер налоговой',
  fav TINYINT(1) DEFAULT NULL COMMENT 'Cтатус избранного',
  space_type_id INT(11) DEFAULT NULL COMMENT 'Тип аренды',
  title VARCHAR(75) DEFAULT NULL COMMENT 'Название недвижемости',
  space_class_id INT(11) DEFAULT NULL COMMENT 'Класс аренды',
  space_vid_id INT(11) DEFAULT NULL COMMENT 'Вид жилплощади',
  anons TEXT DEFAULT NULL COMMENT 'Анонс жилплощади',
  detile TEXT DEFAULT NULL COMMENT 'Детально о жилплощади',
  `desc` TEXT DEFAULT NULL COMMENT 'Общее описание',
  map_latitude VARCHAR(255) DEFAULT NULL COMMENT 'Латитуда на карте',
  map_longitude VARCHAR(255) DEFAULT NULL COMMENT 'Лонгитуда на карте',
  PRIMARY KEY (id),
  INDEX spaces_commissions_fk12 (commission_id),
  INDEX spaces_contract_types_fk13 (contract_type_id),
  INDEX spaces_districts_fk1 (district_id),
  INDEX spaces_files_fk3 (pic_scr_id),
  INDEX spaces_files_fk4 (pic_anons_id),
  INDEX spaces_files_fk5 (pic_detile_id),
  INDEX spaces_metros_fk7 (metro_id),
  INDEX spaces_parkings_fk10 (parking_id),
  INDEX spaces_plannings_fk8 (planning_id),
  INDEX spaces_representatives_fk11 (representative_id),
  INDEX spaces_space_classes_fk15 (space_class_id),
  INDEX spaces_space_types_fk14 (space_type_id),
  INDEX spaces_space_vids_fk16 (space_vid_id),
  INDEX spaces_taxs_fk9 (tax_id),
  INDEX spaces_units_fk6 (unit_id),
  CONSTRAINT spaces_commissions_fk12 FOREIGN KEY (commission_id)
  REFERENCES commissions (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT spaces_contract_types_fk13 FOREIGN KEY (contract_type_id)
  REFERENCES contract_types (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT spaces_districts_fk1 FOREIGN KEY (district_id)
  REFERENCES districts (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT spaces_files_fk3 FOREIGN KEY (pic_scr_id)
  REFERENCES files (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT spaces_files_fk4 FOREIGN KEY (pic_anons_id)
  REFERENCES files (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT spaces_files_fk5 FOREIGN KEY (pic_detile_id)
  REFERENCES files (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT spaces_metros_fk7 FOREIGN KEY (metro_id)
  REFERENCES metros (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT spaces_parkings_fk10 FOREIGN KEY (parking_id)
  REFERENCES parkings (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT spaces_plannings_fk8 FOREIGN KEY (planning_id)
  REFERENCES plannings (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT spaces_representatives_fk11 FOREIGN KEY (representative_id)
  REFERENCES representatives (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT spaces_space_classes_fk15 FOREIGN KEY (space_class_id)
  REFERENCES space_classes (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT spaces_space_types_fk14 FOREIGN KEY (space_type_id)
  REFERENCES space_types (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT spaces_space_vids_fk16 FOREIGN KEY (space_vid_id)
  REFERENCES space_vids (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT spaces_taxs_fk9 FOREIGN KEY (tax_id)
  REFERENCES taxs (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT spaces_units_fk6 FOREIGN KEY (unit_id)
  REFERENCES units (id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Аренда';

CREATE TABLE IF NOT EXISTS city(
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  region_id INT(10) UNSIGNED NOT NULL,
  country_id MEDIUMINT(8) UNSIGNED NOT NULL,
  name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (id),
  INDEX id_country (country_id),
  INDEX id_region (region_id),
  CONSTRAINT city_country_fk_2 FOREIGN KEY (country_id)
  REFERENCES country (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT city_region_fk_1 FOREIGN KEY (region_id)
  REFERENCES region (id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AUTO_INCREMENT = 17590
AVG_ROW_LENGTH = 90
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS client_spaces(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.записи',
  client_id INT(11) DEFAULT NULL COMMENT 'Ид.клиента',
  space_id INT(11) DEFAULT NULL COMMENT 'Ид.свойства',
  PRIMARY KEY (id),
  INDEX client_spaces_clients_fk1 (client_id),
  INDEX client_spaces_spaces_fk1 (space_id),
  CONSTRAINT client_spaces_clients_fk1 FOREIGN KEY (client_id)
  REFERENCES clients (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT client_spaces_spaces_fk1 FOREIGN KEY (space_id)
  REFERENCES spaces (id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Свойства аренды';

CREATE TABLE IF NOT EXISTS space_fotos(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.записи',
  space_id INT(11) DEFAULT NULL COMMENT 'Ид.аренды',
  space_foto_type_id INT(11) DEFAULT NULL COMMENT 'Ид. типа фотографии',
  file_id INT(11) DEFAULT NULL,
  PRIMARY KEY (id),
  INDEX space_fotos_files_fk2 (file_id),
  INDEX space_fotos_space_foto_types_fk3 (space_foto_type_id),
  INDEX space_fotos_spaces_fk1 (space_id),
  CONSTRAINT space_fotos_files_fk2 FOREIGN KEY (file_id)
  REFERENCES files (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT space_fotos_space_foto_types_fk3 FOREIGN KEY (space_foto_type_id)
  REFERENCES space_foto_types (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT space_fotos_spaces_fk1 FOREIGN KEY (space_id)
  REFERENCES spaces (id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Свойства фотографий';

CREATE TABLE IF NOT EXISTS space_presentations(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.записи',
  space_id INT(11) DEFAULT NULL COMMENT 'Ид.аренды',
  file_id INT(11) DEFAULT NULL COMMENT 'Ид.фотографии',
  PRIMARY KEY (id),
  INDEX space_presentations_files_fk2 (file_id),
  INDEX space_presentations_spaces_fk1 (space_id),
  CONSTRAINT space_presentations_files_fk2 FOREIGN KEY (file_id)
  REFERENCES files (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT space_presentations_spaces_fk1 FOREIGN KEY (space_id)
  REFERENCES spaces (id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Файлы презентации жилплощади';

CREATE TABLE IF NOT EXISTS space_properties(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.записи',
  space_id INT(11) DEFAULT NULL COMMENT 'Ид.аренды',
  property_id INT(11) DEFAULT NULL COMMENT 'Ид.свойства',
  PRIMARY KEY (id),
  INDEX space_properties_properties_fk2 (property_id),
  INDEX space_properties_spaces_fk1 (space_id),
  CONSTRAINT space_properties_properties_fk2 FOREIGN KEY (property_id)
  REFERENCES properties (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT space_properties_spaces_fk1 FOREIGN KEY (space_id)
  REFERENCES spaces (id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Свойства аренды';

CREATE TABLE IF NOT EXISTS space_similarities(
  id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Ид.записи',
  space_id INT(11) DEFAULT NULL COMMENT 'Ид.аренды',
  similaries_id INT(11) DEFAULT NULL COMMENT 'Ид.свойства',
  PRIMARY KEY (id),
  INDEX space_similarities_similarities_fk2 (similaries_id),
  INDEX space_similarities_spaces_fk1 (space_id),
  CONSTRAINT space_similarities_similarities_fk2 FOREIGN KEY (similaries_id)
  REFERENCES spaces (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT space_similarities_spaces_fk1 FOREIGN KEY (space_id)
  REFERENCES spaces (id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci
COMMENT = 'Родственная жилплощадь';