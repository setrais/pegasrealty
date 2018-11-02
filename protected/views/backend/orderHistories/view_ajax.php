<?php //print_r($model->attributes) ?>
<?php //print_r($model_old->attributes) ?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array( 'name'=>'id',
                       'visible'=>true,
                ),
                array( 'name'=>'order_id',
                       'visible'=>true
                ),
                array( 'name'=>'act',
                       'type'=>'html',
                       'value'=>( $model->act ? 'да' : ( $model->act===null ? 'не указан' : 'нет' ))
                                 ."<div class=\"row history\">"
                                 ." -> ".( $model->act!==$model_old->act ? "<span class=\"c-red\">" : "")
                                        .( $model_old->act ? 'да' : ( $model_old->act===null ? 'не указан' : 'нет' ))
                                        .( $model->act!==$model_old->act ? "</span>" : "")
                                 ."</div>", 
                       'visible'=>true
                ), 
                array( 'name'=>'del',
                       'type'=>'html',
                       'value'=>( $model->del ? 'да' : ( $model->del===null ? 'не указан' : 'нет' ))                    
                                 ."<div class=\"row history\">"    
                                 ." -> ".( $model->del!==$model_old->del ? "<span class=\"c-red\">" : "")
                                        .( $model_old->del ? 'да' : ( $model_old->del===null ? 'не указан' : 'нет' ))
                                        .( $model->del!==$model_old->del ? "</span>" : "")                      
                                 ."</div>",                     
                        'visible'=>true
                ),   		
		array( 'name'=>'sort',
                       'type'=>'html',                                           
                       'value'=>( trim($model->sort)<>'' ? $model->sort : "не указана" )
                                 ."<div class=\"row history\">"        
                                    ." -> ".($model_old->sort!==$model->sort ? "<span class=\"c-red\">" : "")
                                    .( trim($model_old->sort)<>'' ? $model_old->sort : "не указана" )
                                    .($model_old->sort!==$model->sort ? "</span>" : "")
                                 ."</div>",                                         
                       'visible'=>true,
                ),            				                                                                                    		
		array( 'name'=>'remoteness',
                       'type'=>'html',
                       'value'=>( trim($model->remoteness)<>'' ? $model->remoteness : "не указана")
                                    ."<div class=\"row history\">"      
                                        ." -> ".( $model_old->remoteness!==$model->remoteness ? "<span class=\"c-red\">" : "")
                                        .( trim($model_old->remoteness)<>'' ? $model_old->remoteness : "не указана" )
                                        .( $model_old->remoteness!==$model->remoteness ? "</span>" : "")                                         
                                 ."</div>",                                                             
                       'visible'=>true,
                ),        
            	array( 'name'=>'unit_id',
                       'type'=>'html',
                       'value'=>( trim($model->unit_id)<>'' ? $model->unit->title : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->unit_id!==$model->unit_id ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->unit_id)<>'' ? $model_old->unit->title : 'не указана' )
                                     .( $model_old->unit_id!==$model->unit_id ? "</span>" : "")
                                 ."</div>",                                                
                       'visible'=>true,                    
                ),            		
		array( 'name'=>'district_id',
                       'type'=>'html',
                       'value'=>( trim($model->district_id)<>'' ? $model->district->title : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->district_id!==$model->district_id ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->district_id)<>'' ? $model_old->district->title : 'не указана' )
                                     .( $model_old->district_id!==$model->district_id ? "</span>" : "")
                                 ."</div>",                                                
                       'visible'=>true,                    
                ),            		                                                		
		array( 'name'=>'operation_id',
                       'type'=>'html',
                       'value'=>( trim($model->operation_id)<>'' ? $model->operation->title : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->operation_id!==$model->operation_id ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->operation_id)<>'' ? $model_old->operation->title : 'не указана' )
                                     .( $model_old->operation_id!==$model->operation_id ? "</span>" : "")
                                 ."</div>",                       
                       'visible'=>true,
                ),            			
		array( 'name'=>'realestate_type_id',
                       'type'=>'html',
                       'value'=>( trim($model->realestate_type_id)<>'' ? $model->realestateType->title : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->realestate_type_id!==$model->realestate_type_id ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->realestate_type_id)<>'' ? $model_old->realestateType->title : 'не указана' )
                                     .( $model_old->realestate_type_id!==$model->realestate_type_id ? "</span>" : "")
                                 ."</div>",                       
                       'visible'=>true,
                ),            		            		
		array( 'name'=>'realestate_vid_id',
                       'type'=>'html',
                       'value'=>( trim($model->realestate_vid_id)<>'' ? $model->realestateVid->title : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->realestate_vid_id!==$model->realestate_vid_id ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->realestate_vid_id)<>'' ? $model_old->realestateVid->title : 'не указана' )
                                     .( $model_old->realestate_vid_id!==$model->realestate_vid_id ? "</span>" : "")
                                 ."</div>",                    
                       'visible'=>true,
                ),            		                        
		array( 'name'=>'realestate_class_id',
                       'type'=>'html',
                       'value'=>( trim($model->realestate_class_id)<>'' ? $model->realestateClass->title : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->realestate_class_id!==$model->realestate_class_id ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->realestate_class_id)<>'' ? $model_old->realestateClass->title : 'не указана' )
                                     .( $model_old->realestate_class_id!==$model->realestate_class_id ? "</span>" : "")
                                 ."</div>",                       
                       'visible'=>true,
                ),            		                            
		array( 'name'=>'createdate',
                       'type'=>'html',
                       'value'=>( trim($model->createdate)<>'' ? $model->createdate : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->createdate!==$model->createdate ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->createdate)<>'' ? $model_old->createdate : 'не указана' )
                                     .( $model_old->createdate!==$model->createdate ? "</span>" : "")
                                 ."</div>",                       
                       'visible'=>true,
                ),            
		array( 'name'=>'createuser',
                       'type'=>'html',
                       'value'=>( trim($model->createuser)<>'' ? $model->createUser->email : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->createuser!==$model->createuser ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->createuser)<>'' ? $model_old->createUser->email : 'не указана' )
                                     .( $model_old->createuser!==$model->createuser ? "</span>" : "")
                                 ."</div>",                                           
                       'visible'=>true,
                ),            		            
		array( 'name'=>'updatedate',
                       'type'=>'html',
                       'value'=>( trim($model->updatedate)<>'' ? $model->updatedate : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->updatedate!==$model->updatedate ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->updatedate)<>'' ? $model_old->updatedate : 'не указана' )
                                     .( $model_old->updatedate!==$model->updatedate ? "</span>" : "")
                                 ."</div>",                                           
                       'visible'=>true,
                ),            
		array( 'name'=>'updateuser',
                       'type'=>'html',
                       'value'=>( trim($model->updateuser)<>'' ? $model->updateUser->email : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->updateuser!==$model->updateuser ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->updateuser)<>'' ? $model_old->updateUser->email : 'не указана' )
                                     .( $model_old->updateuser!==$model->updateuser ? "</span>" : "")
                                 ."</div>",                                                        
                       'visible'=>true,
                ),            				
		array( 'name'=>'price_from',
                       'type'=>'html',
                       'value'=>( trim($model->price_from)<>'' ? $model->price_from : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->price_from!==$model->price_from ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->price_from)<>'' ? $model_old->price_from : 'не указана' )
                                     .( $model_old->price_from!==$model->price_from ? "</span>" : "")
                                 ."</div>",                       
                       'visible'=>true,
                ),            				            
		array( 'name'=>'price_to',
                       'type'=>'html',                    
                       'value'=>( trim($model->price_to)<>'' ? $model->price_to : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->price_to!==$model->price_to ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->price_to)<>'' ? $model_old->price_to : 'не указана' )
                                     .( $model_old->price_to!==$model->price_to ? "</span>" : "")
                                 ."</div>",                                           
                       'visible'=>true,
                ),            				            	
		array( 'name'=>'valute_id',
                       'type'=>'html',
                       'value'=>( trim($model->valute_id)<>'' ? $model->valute->title : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->valute_id!==$model->valute_id ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->valute_id)<>'' ? $model_old->valute->title : 'не указана' )
                                     .( $model_old->valute_id!==$model->valute_id ? "</span>" : "")
                                 ."</div>",                                           
                       'visible'=>true,                                       
                ),            		            
		array( 'name'=>'area_from',
                       'type'=>'html',
                       'value'=>( trim($model->area_from)<>'' ? $model->area_from : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->area_from!==$model->area_from ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->area_from)<>'' ? $model_old->area_from : 'не указана' )
                                     .( $model_old->area_from!==$model->area_from ? "</span>" : "")
                                 ."</div>",                             
                       'visible'=>true,
                ),            				            		            
		array( 'name'=>'area_to',
                       'type'=>'html',
                       'value'=>( trim($model->area_to)<>'' ? $model->area_to : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->area_to!==$model->area_to ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->area_to)<>'' ? $model_old->area_to : 'не указана' )
                                     .( $model_old->area_to!==$model->area_to ? "</span>" : "")
                                 ."</div>",                                                 
                       'visible'=>true,
                ),            		                                                                                                                                                                                		
		array( 'name'=>'unit_value',
                       'type'=>'html',
                       'value'=>( trim($model->unit_value)<>'' ? $model->unit_value : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->unit_value!==$model->unit_value ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->unit_value)<>'' ? $model_old->unit_value : 'не указана' )
                                     .( $model_old->unit_value!==$model->unit_value ? "</span>" : "")
                                 ."</div>",                                    
                       'visible'=>false,
                ),            		                                                                                                
		array( 'name'=>'poligon',
                       'type'=>'html',
                       'value'=>( trim($model->poligon)<>'' ? $model->poligon : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->poligon!==$model->poligon ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->poligon)<>'' ? $model_old->poligon : 'не указана' )
                                     .( $model_old->poligon!==$model->poligon ? "</span>" : "")
                                 ."</div>",                        
                       'visible'=>false,
                ),            		                              
		/*array( 'name'=>'historydate',
                       'type'=>'html',
                       'value'=>( trim($model->historydate)<>'' ? $model->historydate : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->historydate!==$model->historydate ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->historydate)<>'' ? $model_old->historydate : 'не указана' )
                                     .( $model_old->historydate!==$model->historydate ? "</span>" : "")
                                 ."</div>",                                            
                       'visible'=>true,
                ),            
		array( 'name'=>'historyuser',
                       'type'=>'html',
                       'value'=>( trim($model->historuser)<>'' ? $model->historyUser->email : 'не указана' )
                                 ."<div class=\"row history\">"            
                                     ." -> ".( $model_old->historyuser!==$model->historyuser ? "<span class=\"c-red\">" : "")
                                     .( trim($model_old->historuser)<>'' ? $model_old->historyUser->email : 'не указана' )
                                     .( $model_old->historyuser!==$model->historyuser ? "</span>" : "")
                                 ."</div>",                                            
                       'visible'=>true,
                ),*/   
	),
)); ?>
