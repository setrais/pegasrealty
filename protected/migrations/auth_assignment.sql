-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 5.0.54.1
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 01.02.2012 14:50:46
-- Версия сервера: 5.1.49-3-log
-- Версия клиента: 4.1

-- 
-- Отключение внешних ключей
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер
--
SET NAMES 'utf8';

-- 
-- Установка базы данных по умолчанию
--
USE pp;

-- 
-- Вывод данных для таблицы auth_assignment
--
INSERT INTO auth_assignment(itemname, userid, bizrule, `data`) VALUES 
  ('admin', '1', '', 's:0:"";');

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;