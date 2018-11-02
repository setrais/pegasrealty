<?php

class m120201_214043_add_relation_spaces extends CDbMigration
{
	public function up()
	{
            $this->addForeignKey('spaces_districts_fk1', 
                                 'spaces', 'district_id', 
                                 'districts','id', 'CASCADE',"CASCADE");
            $this->addForeignKey('spaces_files_fk3', 
                                 'spaces', 'pic_scr_id', 
                                 'files','id', 'CASCADE',"CASCADE");              
            $this->addForeignKey('spaces_files_fk4', 
                                 'spaces', 'pic_anons_id', 
                                 'files','id', 'CASCADE',"CASCADE");              
            $this->addForeignKey('spaces_files_fk5', 
                                 'spaces', 'pic_detile_id', 
                                 'files','id', 'CASCADE',"CASCADE");                          
            $this->addForeignKey('spaces_units_fk6', 
                                 'spaces', 'unit_id', 
                                 'units','id', 'CASCADE',"CASCADE");                          
            $this->addForeignKey('spaces_metros_fk7', 
                                 'spaces', 'metro_id', 
                                 'metros','id', 'CASCADE',"CASCADE");                                                                                             
            $this->addForeignKey('spaces_plannings_fk8', 
                                 'spaces', 'planning_id', 
                                 'plannings','id', 'CASCADE',"CASCADE");                                                                                                                                
            $this->addForeignKey('spaces_taxs_fk9', 
                                 'spaces', 'tax_id', 
                                 'taxs','id', 'CASCADE',"CASCADE");                                                                                                                                
            $this->addForeignKey('spaces_parkings_fk10', 
                                 'spaces', 'parking_id', 
                                 'parkings','id', 'CASCADE',"CASCADE");                                                                                                                                
            $this->addForeignKey('spaces_representatives_fk11', 
                                 'spaces', 'representative_id', 
                                 'representatives','id', 'CASCADE',"CASCADE");                                                                                                                                            
            $this->addForeignKey('spaces_commissions_fk12', 
                                 'spaces', 'commission_id', 
                                 'commissions','id', 'CASCADE',"CASCADE");                                                                                                                                            
            $this->addForeignKey('spaces_contract_types_fk13', 
                                 'spaces', 'contract_type_id', 
                                 'contract_types','id', 'CASCADE',"CASCADE");                                                                                                                                            
            $this->addForeignKey('spaces_space_types_fk14', 
                                 'spaces', 'space_type_id', 
                                 'space_types','id', 'CASCADE',"CASCADE");                                                                                                                                                        
            $this->addForeignKey('spaces_space_classes_fk15', 
                                 'spaces', 'space_class_id', 
                                 'space_classes','id', 'CASCADE',"CASCADE");                                                                                                                                                        
            $this->addForeignKey('spaces_space_vids_fk16', 
                                 'spaces', 'space_vid_id', 
                                 'space_vids','id', 'CASCADE',"CASCADE");                                                                                                                                                                     
	}

	public function down()
	{
		echo "m120201_214043_add_relation_spaces does not support migration down.\n";
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