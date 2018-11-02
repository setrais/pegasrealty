<?php

class m120205_192908_add_column_spaces extends CDbMigration
{
        public $_table="spaces";
        
	public function up()    
	{
            $this->addColumn($this->_table, 'address', "VARCHAR(255) DEFAULT NULL COMMENT 'Адрес'");
	}

	public function down()
	{
            $this->dropColumn($this->_table, 'address');
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