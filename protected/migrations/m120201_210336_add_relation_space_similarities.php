<?php

class m120201_210336_add_relation_space_similarities extends CDbMigration
{
	public function up()
	{
                $this->addForeignKey('space_similarities_spaces_fk1', 
                                     'space_similarities', 'space_id', 
                                     'spaces', 'id', 'CASCADE',"CASCADE"); 
                $this->addForeignKey('space_similarities_similarities_fk2', 
                                     'space_similarities', 'similaries_id', 
                                     'spaces', 'id', 'CASCADE',"CASCADE"); 
        }

	public function down()
	{
		echo "m120201_210336_add_relation_space_similarities does not support migration down.\n";
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