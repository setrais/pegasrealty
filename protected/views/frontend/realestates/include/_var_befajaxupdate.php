<?php     
$beforeAjaxUpdate =<<< EOD
            function(id, data) { 
                        var prm = Array();
                        var fields = $('form#mainSearch').serializeArray();    
                        var isProps = $('#Realestates_realestatesProperties_all').attr('checked')=='checked';        
                        $.each(fields, 
                            function(i, field){ 
                                if( field['value'].length ) 
                                { 

                                   if ( field['name']=='Realestates[realestatesProperties][]' ) {
                                        if (!isProps) {
                                            prm.push(field); 
                                        }                        
                                   }else{
                                      if ( field['name']!='Realestates_realestatesProperties_all') {
                                           prm.push(field);
                                      }
                                   }
                                }
                            }
                        );
                            
                        /*if ( !isProps && !$('[name=\"Realestates[realestatesProperties][]\"]:checked').length ) {            
                            field = Array();
                            field['name'] = 'Realestates_realestatesProperties_all';
                            field['value'] = 0;
                            prm.push(field);   
                        }*/

                        dats=$.param(prm);
                        
              if ( typeof data.url=='undefined' ) { 
                data.url = changeBrowserUrl('?' + dats/*$('form#mainSearch').serialize()*/);                                
              } else {
                data.url = changeBrowserUrl(data.url + '&' + dats/*$('form#mainSearch').serialize()*/);                                
              }
            }
EOD;
