<?php

class m120201_112953_set_relation_auth_assignment extends CDbMigration
{
	public function up()    
	{                        
		$this->addForeignKey('auth_assignment_ibfk_1', 'auth_assignment', 'itemname',
                                     'auth_item', 'name','CASCADE',"CASCADE");
	}

	public function down()
	{
		echo "m120201_112953_set_relation_auth_assignment does not support migration down.\n";
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