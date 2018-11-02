<?php

class m120201_205005_add_relation_space_presentations extends CDbMigration
{
	public function up()
	{
                $this->addForeignKey('space_presentations_spaces_fk1', 
                                     'space_presentations', 'space_id', 
                                     'spaces', 'id', 'CASCADE',"CASCADE");   
                $this->addForeignKey('space_presentations_files_fk2', 
                                     'space_presentations', 'file_id', 
                                     'files', 'id', 'CASCADE',"CASCADE"); 
	}

	public function down()
	{
		echo "m120201_205005_add_relation_space_presentations does not support migration down.\n";
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