<?php

class m120205_200528_add_column_spaces extends CDbMigration
{
        public $_table="spaces";
        
	public function up()
	{
            $this->addColumn($this->_table, 'is_separate_entrance', "TINYINT(1) DEFAULT NULL COMMENT 'Отдельный вход'");      
	}

	public function down()
	{
            $this->dropColumn($this->_table, 'is_separate_entrance');      
        }
}