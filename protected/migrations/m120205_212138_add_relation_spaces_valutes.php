<?php

class m120205_212138_add_relation_spaces_valutes extends CDbMigration
{
	public function up()
	{
            $this->addForeignKey('spaces_valutes_fk18', 
                                 'spaces', 'valute_id', 
                                 'valutes','id', 'CASCADE',"CASCADE");
	}

	public function down()
	{
		echo "m120205_210440_add_relation_spaces_valutes does not support migration down.\n";
		return false;
	}
}