<?php

class m120201_150121_drop_relation_client_spaces extends CDbMigration
{
	public function up()
	{
                $this->dropForeignKey('client_spaces_fk1', 'client_spaces');                
        }

	public function down()
	{
		echo "m120201_150121_drop_relation_client_spaces does not support migration down.\n";
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