<?php

class m120205_210152_add_column_spaces extends CDbMigration
{
        public $_table="spaces";
        
	public function up()    
	{
            $this->addColumn($this->_table, 'valute_id', "VARCHAR(75) DEFAULT NULL COMMENT 'Валюта'");
	}

	public function down()
	{
            $this->dropColumn($this->_table, 'valute_id');
	}
}