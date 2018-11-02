<?php

class m120201_145442_set_relation_client_spaces extends CDbMigration
{
	public function up()
	{
                $this->addForeignKey('client_spaces_clients_fk1', 
                                     'client_spaces', 'client_id', 
                                     'clients', 'id', 'CASCADE',"CASCADE");
                $this->addForeignKey('client_spaces_fk1', 
                                     'client_spaces', 'space_id', 
                                     'spaces', 'id', 'CASCADE',"CASCADE");                
	}

	public function down()
	{
		echo "m120201_145442_set_relation_client_spaces does not support migration down.\n";
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