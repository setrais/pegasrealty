<?php

class m120205_084248_add_columns_files extends CDbMigration
{
        public $_table='files';
        
	public function up()
	{
            $this->addColumn($this->_table, 'action', "VARCHAR(255) DEFAULT 'null' COMMENT 'Действие'");
            $this->addColumn($this->_table, 'controller', "VARCHAR(255) DEFAULT 'null' COMMENT 'Контроллер'");                
	}

	public function down()
	{
            $this->dropColumn($this->_table, 'action');
            $this->dropColumn($this->_table, 'controller');                
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