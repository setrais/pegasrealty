<?php

class m120201_135028_set_relation_region extends CDbMigration
{
	public function up()
	{
            $this->addForeignKey( 'region_country_fk_1', 'region', 'country_id',
                              'country', 'id','CASCADE',"CASCADE");
	}

	public function down()
	{
		echo "m120201_135028_set_relation_region does not support migration down.\n";
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