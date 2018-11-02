<?php

class m120201_141924_insert_client_types extends CDbMigration
{
	public function up()
	{
            /*$this->execute("INSERT INTO client_types(id, abbr, title, sort, act, del, create_date, update_date, `desc`) VALUES 
                              (1, 'А', 'Арендаторы', 100, NULL, NULL, NULL, NULL, NULL),
                              (2, 'П', 'Покупатели', 200, NULL, NULL, NULL, NULL, NULL),
                              (3, 'В', 'Владельцы', 300, NULL, NULL, NULL, NULL, NULL); ");*/
	}

	public function down()
	{
		echo "m120201_141924_insert_client_types does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}