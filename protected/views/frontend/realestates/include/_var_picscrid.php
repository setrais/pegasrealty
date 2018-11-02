<?php 
$AprsPicScrID = array(
                   'name'=>'pic_scr_id',
                   //'htmlOptions'=>array("width"=>60),
                   'type'=>'raw',
                    //тут самое интересное: если файла картинки нет, 
                    // то отображается файл no_photo.gif
                    // Значение value обрабатывается функцией eval() поэтому 
                    // тут такие странные ковычки.
                    /*'value'=> '"/".( trim($data->picOreginal->original_name)<>"" 
                                     && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picOreginal->original_name)))
                                     ? str_replace("_original","_src",trim($data->picOreginal->original_name))
                                     : ( trim($data->picScr->original_name)<>"" 
                                         && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picScr->original_name)))
                                         ? str_replace("_original","_src",trim($data->picScr->original_name)) 
                                         : "images/no_foto_small.png" ))',*/
                    /*'value'=> '"/".( trim($data->picScr->original_name)<>"" 
                                     && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picScr->original_name)))
                                     ? str_replace("_original","_src",trim($data->picScr->original_name))
                                     : ( trim($data->picOreginal->original_name)<>"" 
                                         && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picOreginal->original_name)))
                                         ? str_replace("_original","_src",trim($data->picOreginal->original_name)) 
                                         : "images/no_foto_small.png" ))',*/
                    'value'=> 'CHtml::link(CHtml::image( 
                                   "/".( trim($data->picScr->original_name)<>"" 
                                     && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picScr->original_name)))
                                     ? str_replace("_original","_src",trim($data->picScr->original_name))
                                     : ( trim($data->picOreginal->original_name)<>"" 
                                         && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picOreginal->original_name)))
                                         ? str_replace("_original","_src",trim($data->picOreginal->original_name)) 
                                         : "images/no_foto_small.png" )),"Коммерческая недвижимость / Аренда ".$data->realestateVid->namewhat." в Москве - ".$data->title, 
                                         array("title"=>"Коммерческая недвижимость / Аренда ".$data->realestateVid->namewhat." в Москве - ".$data->title/*$data->picOreginal->name*/)), 
                                         "/".str_replace("_original","_big",trim($data->picOreginal->original_name)), array("class"=>"fancyImage", "title"=>"Коммерческая недвижимость / Аренда ".$data->realestateVid->namewhat." в Москве - ".$data->title ))',
                    /*'value'=> 'CHtml::link(CHtml::image( 
                                   "/".( trim($data->picScr->original_name)<>"" 
                                     && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_small",trim($data->picScr->original_name)))
                                     ? str_replace("_original","_small",trim($data->picScr->original_name))
                                     : ( trim($data->picOreginal->original_name)<>"" 
                                         && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_small",trim($data->picOreginal->original_name)))
                                         ? str_replace("_original","_small",trim($data->picOreginal->original_name)) 
                                         : "images/no_foto_small.png" )),"Недвижимость/Аренда/Офиса в Москве - ".$data->title, 
                                         array("title"=>"Недвижимость/Аренда/Офиса в Москве - ".$data->title/*$data->picOreginal->name)), 
                                         "/".str_replace("_original","_big",trim($data->picOreginal->original_name)), array("class"=>"fancyImage", "title"=>"Недвижимость/Аренда/Офиса в Москве - ".$data->title ))',*/                                
                    'filter'=>'',
                    'headerHtmlOptions'=>array('width'=>'60'),
                    'htmlOptions'=>array('style'=>'width:60px;text-align: center;vertical-align: middle;'),
                    'visible'=>false,
                    //'headerHtmlOptions' => array('style' => 'display: none'),
                    //'htmlOptions' => array('style' => 'display: none'),
                 );
                        