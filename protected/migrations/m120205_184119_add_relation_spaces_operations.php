<?php

class m120205_184119_add_relation_spaces_operations extends CDbMigration
{
	public function up()
	{
            $this->addForeignKey('spaces_operations_fk16', 
                                 'spaces', 'operation_id', 
                                 'operations','id', 'CASCADE',"CASCADE");
	}

	public function down()
	{
		echo "m120205_184119_add_relation_spaces_operations does not support migration down.\n";
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