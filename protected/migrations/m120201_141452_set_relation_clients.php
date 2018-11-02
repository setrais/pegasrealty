<?php

class m120201_141452_set_relation_clients extends CDbMigration
{
	public function up()
	{
                $this->addForeignKey('clients_client_types_fk1', 
                                     'clients', 'client_type_id', 
                                     'client_types', 'id');
	}

	public function down()
	{
		echo "m120201_141452_set_relation_clients does not support migration down.\n";
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