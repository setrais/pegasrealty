<?php

class m120205_211402_set_column_spaces extends CDbMigration
{
        public $_table="spaces";
        
	public function up()    
	{
            $this->dropColumn($this->_table, 'valute_id');
            $this->addColumn($this->_table, 'valute_id', "INT(11) DEFAULT NULL COMMENT 'Валюта'");        
	}

	public function down()
	{
            $this->dropColumn($this->_table, 'valute_id');
            $this->addColumn($this->_table, 'valute_id', "VARCHAR(75) DEFAULT NULL COMMENT 'Валюта'");            
	}
}