<?php

class m120201_193149_add_relation_space_fotos extends CDbMigration
{
	public function up()
	{
            $this->addForeignKey('space_fotos_files_fk2', 
                                 'space_fotos', 'file_id', 
                                 'files', 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		echo "m120201_193149_add_relation_space_fotos does not support migration down.\n";
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