<?php

class m120205_183742_add_column_to_spaces extends CDbMigration
{
        public $_table='spaces';
        
	public function up()
	{
            $this->addColumn($this->_table, 'operation_id', "INT(11) DEFAULT NULL COMMENT 'Ид.операции'");            
	}

	public function down()
	{
            $this->dropColumn($this->_table, 'operation_id');  
	}
}