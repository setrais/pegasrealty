<?php

class m120201_205657_add_relation_space_properties extends CDbMigration
{
	public function up()
	{
                $this->addForeignKey('space_properties_spaces_fk1', 
                                     'space_properties', 'space_id', 
                                     'spaces', 'id', 'CASCADE',"CASCADE");   
                $this->addForeignKey('space_properties_properties_fk2', 
                                     'space_properties', 'property_id', 
                                     'properties', 'id', 'CASCADE',"CASCADE"); 
	}

	public function down()
	{
		echo "m120201_205657_add_relation_space_properties does not support migration down.\n";
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