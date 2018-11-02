<?php

class m120201_190909_add_relation_space_fotos extends CDbMigration
{
	public function up()
	{
            $this->addForeignKey('space_fotos_space_foto_types_fk3', 
                                 'space_fotos', 'space_foto_type_id', 
                                 'space_foto_types', 'id', 'CASCADE',"CASCADE");               
	}

	public function down()
	{
		echo "m120201_190909_add_relation_space_fotos does not support migration down.\n";
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