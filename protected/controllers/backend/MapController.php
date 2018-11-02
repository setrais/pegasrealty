<?php

class MapController extends Controller
{
        /* Default maps
         * 
         */
	public function actionIndex()
	{
                //Yii::import('ext.gmaps.egmap.*');
                Yii::import('ext.EGMap.*');
                $gMap = new EGMap();
                $gMap->zoom = 10;
                $mapTypeControlOptions = array(
                  'position'=> EGMapControlPosition::LEFT_BOTTOM,
                  'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
                );

                $gMap->mapTypeControlOptions= $mapTypeControlOptions;

                $gMap->setCenter(55.75147066433101, 37.71683428852543);

                // Create GMapInfoWindows
                $info_window_a = new EGMapInfoWindow('<div>I am a marker with custom image!</div>');
                $info_window_b = new EGMapInfoWindow('Hey! I am a marker with label!');

                $icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/gazstation.png");

                $icon->setSize(32, 37);
                $icon->setAnchor(16, 16.5);
                $icon->setOrigin(0, 0);

                // Create marker
                $marker = new EGMapMarker(55.75147066433101, 37.71683428852543, array('title' => 'Marker With Custom Image','icon'=>$icon));
                $marker->addHtmlInfoWindow($info_window_a);
                $gMap->addMarker($marker);

                // Create marker with label
                $marker = new EGMapMarkerWithLabel(55.75147066433101, 37.71683428852543, array('title' => 'Marker With Label'));

                $label_options = array(
                  'backgroundColor'=>'yellow',
                  'opacity'=>'0.75',
                  'width'=>'100px',
                  'color'=>'blue'
                );

                /*
                // Two ways of setting options
                // ONE WAY:
                $marker_options = array(
                  'labelContent'=>'$9393K',
                  'labelStyle'=>$label_options,
                  'draggable'=>true,
                  // check the style ID 
                  // afterwards!!!
                  'labelClass'=>'labels',
                  'labelAnchor'=>new EGMapPoint(22,2),
                  'raiseOnDrag'=>true
                );

                $marker->setOptions($marker_options);
                */

                // SECOND WAY:
                $marker->labelContent= '$425K';
                $marker->labelStyle=$label_options;
                $marker->draggable=true;
                $marker->labelClass='labels';
                $marker->raiseOnDrag= true;

                $marker->setLabelAnchor(new EGMapPoint(22,0));

                $marker->addHtmlInfoWindow($info_window_b);

                $gMap->addMarker($marker);

                // enabling marker clusterer just for fun
                // to view it zoom-out the map
                $gMap->enableMarkerClusterer(new EGMapMarkerClusterer());
                
                ob_start();
                
                $gMap->renderMap();
                ?>
                <style type="text/css">
                .labels {
                   color: red;
                   background-color: white;
                   font-family: "Lucida Grande", "Arial", sans-serif;
                   font-size: 10px;
                   font-weight: bold;
                   text-align: center;
                   width: 40px;     
                   border: 2px solid black;
                   white-realestate: nowrap;
                }
                </style> 
                <?php
                $buffer = ob_get_contents();
                ob_end_clean();
                
		$this->render('index',array('content'=>$buffer));
	}

        /** KML Service
         *  As KML is a service that is readed from Google services, 
         *  you cannot use localhost KML files, to do so, you need to specify 
         *  that is localhost kml file on enableKMLService function and the 
         *  geoxml3.js plugin should be automatically registered.
         **/
	public function actionKmlService()
	{
            //Yii::import('ext.gmaps.*');
            Yii::import('ext.gmaps.egmap.*');
 
            $gMap = new EGMap();
            // using the new magic setters
            // check available options per class
            // objects with setMethod,getMethod and
            // options array can be set now this way
            $gMap->zoom = 10;
            $mapTypeControlOptions = array(
               // yes we can position the controls now
               // where we want
               'position'=> EGMapControlPosition::LEFT_BOTTOM,
               'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
            );

            $gMap->mapTypeControlOptions= $mapTypeControlOptions;

            // enabling KML Service. Second parameter of this 
            // function tells whether is localhost or not. GeoXML3.js 
            // is needed to read localhost KML files.
            $gMap->enableKMLService('http://gmaps-samples.googlecode.com/svn/trunk/ggeoxml/cta.kml');

            ob_start();
            
            $gMap->renderMap();
            
            $buffer = ob_get_contents();
            
            ob_end_clean();
                
	    $this->render('index',array('content'=>$buffer));
        }
        
        /** Directions Example 
         *  How to work with directions and waypoints
         **/
	public function actionDirsEx()
	{
            Yii::import('ext.gmaps.egmap.*');
            $gMap = new EGMap();

            $gMap->setWidth(512);
            // it can also be called $gMap->height = 400;
            $gMap->setHeight(400);
            $gMap->zoom = 8; 

            Yii::import('ext.geo.geoip.EGeoIP');
            $geoIp = new EGeoIP();
            $geoIp->locate($_SERVER['REMOTE_ADDR']); // use your IP
            $lat  = $geoIp->latitude;
            $long = $geoIp->longitude;
            
                //
            // set center to inca
            //$gMap->setCenter(39.719588117933185, 2.9087440013885635);
            $gMap->setCenter($lat, $long);

            // my house when i was a kid
            //$home = new EGMapCoord(39.720991014764536, 2.911801719665541);
            $home = new EGMapCoord($lat, $long);

            // my ex-school
            //$school = new EGMapCoord(39.719456079114956, 2.8979293346405166);
            $school = new EGMapCoord($lat, $long);

            // some stops on the way
            /*$santo_domingo = new EGMapCoord(39.72118906848983, 2.907628202438368);
            $plaza_toros  = new EGMapCoord(39.71945607911511, 2.9049245357513565);
            $paso_del_tren = new EGMapCoord( 39.718762871171776, 2.903637075424208 );*/
            
            $santo_domingo = new EGMapCoord( $lat, $long );
            $plaza_toros  = new EGMapCoord( $lat, $long );
            $paso_del_tren = new EGMapCoord( $lat, $long );

            // Waypoint samples
            $waypoints = array(
                  new EGMapDirectionWayPoint($santo_domingo),
                  new EGMapDirectionWayPoint($plaza_toros, false),
                  new EGMapDirectionWayPoint($paso_del_tren, false)
                );

            // Initialize GMapDirection
            $direction = new EGMapDirection($home, $school, 'direction_sample', array('waypoints' => $waypoints));

            $direction->optimizeWaypoints = true;
            $direction->provideRouteAlternatives = true;

            $renderer = new EGMapDirectionRenderer();
            $renderer->draggable = true;
            $renderer->panel = "direction_pane";
            $renderer->setPolylineOptions(array('strokeColor'=>'#FFAA00'));

            $direction->setRenderer($renderer);

            $gMap->addDirection($direction);
            

            ob_start();
            
            $gMap->renderMap();
            
            ?><div id="direction_pane"></div><?php

            $buffer = ob_get_contents();
            
            ob_end_clean();
                
	    $this->render('index',array('content'=>$buffer));
        }
        
        /** KeyDragZoom Example
         *  How to make use of the KeyDragZoom plugin. 
         *  When you use the following example, check the small magnifying glass
         *  under the zoom control or press the Shift Key to enable the Key Drag Zoom.
         **/
	public function actionKeyDragZomm()
	{
            Yii::import('ext.gmaps.egmap.*');
            
            $gMap = new EGMap();
            $gMap->zoom = 8;
            // set center to inca
            $gMap->setCenter(39.719588117933185, 2.9087440013885635); 
            $gMap->width = 400;
            $gMap->height = 400;
            // Enable Key Drag Zoom
            $zoom_options = array(
              'visualEnabled'=>true,
              'boxStyle'=>array(
               'border'=>'4px dashed black', // strings with double quoted inside!
               'backgroundColor'=>'transparent',
               'opacity'=>1.0
              ),
              'veilStyle'=>array(
                'backgroundColor'=>'red',
                'opacity'=>0.35,
                'cursor'=>'crosshair'
              ));

            $drag_Zoom = new EGMapKeyDragZoom($zoom_options);

            $gMap->enableKeyDragZoom($drag_Zoom);

            ob_start();
            
            $gMap->renderMap();

            $buffer = ob_get_contents();
            
            ob_end_clean();
                
	    $this->render('index',array('content'=>$buffer));
        }
        

        /** A More Advanced Example
         *  Where $map is model of database table to save coordinates of a marker 
         *  point. Example provided by Johnatan
         **/
	public function actionMoreAdvanced()
	{
            Yii::import('ext.gmaps.egmap.*');
            
            $gMap = new EGMap();
            $gMap->setWidth(880);
            $gMap->setHeight(550);
            $gMap->zoom = 6;
            $mapTypeControlOptions = array(
              'position' => EGMapControlPosition::RIGHT_TOP,
              'style' => EGMap::MAPTYPECONTROL_STYLE_HORIZONTAL_BAR
            );

            $gMap->mapTypeId = EGMap::TYPE_ROADMAP;
            $gMap->mapTypeControlOptions = $mapTypeControlOptions;

            // Preparing InfoWindow with information about our marker.
            $info_window_a = new EGMapInfoWindow("<div class='gmaps-label' style='color: #000;'>Hi! I'm your marker!</div>");

            // Setting up an icon for marker.
            $icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/car.png");

            $icon->setSize(32, 37);
            $icon->setAnchor(16, 16.5);
            $icon->setOrigin(0, 0);

            // Saving coordinates after user dragged our marker.
            $dragevent = new EGMapEvent('dragend', "function (event) { $.ajax({
                                                        'type':'POST',
                                                        'url':'".$this->createUrl('catalog/savecoords').'/'.$items->id."',
                                                        'data':({'lat': event.latLng.lat(), 'lng': event.latLng.lng()}),
                                                        'cache':false,
                                                    });}", false, EGMapEvent::TYPE_EVENT_DEFAULT);

            // If we have already created marker - show it
            if ($map) {

                $marker = new EGMapMarker($map->lat, $map->lng, array('title' => Yii::t('catalog', $items->type->name),
                        'icon'=>$icon, 'draggable'=>true), 'marker', array('dragevent'=>$dragevent));
                $marker->addHtmlInfoWindow($info_window_a);
                $gMap->addMarker($marker);
                $gMap->setCenter($map->lat, $map->lng);
                $gMap->zoom = 16;

            // If we don't have marker in database - make sure user can create one
            } else {
                $gMap->setCenter(38.348850, -0.477551);

                // Setting up new event for user click on map, so marker will be created on place and respectful event added.
                $gMap->addEvent(new EGMapEvent('click',
                        'function (event) {var marker = new google.maps.Marker({position: event.latLng, map: '.$gMap->getJsName().
                        ', draggable: true, icon: '.$icon->toJs().'}); '.$gMap->getJsName().
                        '.setCenter(event.latLng); var dragevent = '.$dragevent->toJs('marker').
                        '; $.ajax({'.
                          '"type":"POST",'.
                          '"url":"'.$this->createUrl('catalog/savecoords')."/".$items->id.'",'.
                          '"data":({"lat": event.latLng.lat(), "lng": event.latLng.lng()}),'.
                          '"cache":false,'.
                        '}); }', false, EGMapEvent::TYPE_EVENT_DEFAULT_ONCE));
            }
            

            ob_start();
            
            $gMap->renderMap(array(), Yii::app()->language);

            $buffer = ob_get_contents();
            
            ob_end_clean();
                
	    $this->render('index',array('content'=>$buffer));
        }
        
        /** InfoBox Example New
         *  InfoBox is a cool plugin that allows you to modify the info windows 
         *  of your map.
         **/
	public function actionInfoBox()
	{
            Yii::import('ext.gmaps.egmap.*');
            
            $gMap = new EGMap();
            $gMap->setJsName('test_map');
            $gMap->width = '100%';
            $gMap->height = 300;
            $gMap->zoom = 8;
            $gMap->setCenter(39.737827146489174, 3.2830574338912477);

            $info_box = new EGMapInfoBox('<div style="color:#fff;border: 1px solid black; margin-top: 8px; background: #000; padding: 5px;">I am a marker with info box!</div>');

            // set the properties
            $info_box->pixelOffset = new EGMapSize('0','-140');
            $info_box->maxWidth = 0;
            $info_box->boxStyle = array(
                'width'=>'"280px"',
                'height'=>'"120px"',
                'background'=>'"url(http://google-maps-utility-library-v3.googlecode.com/svn/tags/infobox/1.1.9/examples/tipbox.gif) no-repeat"'
            );
            $info_box->closeBoxMargin = '"10px 2px 2px 2px"';
            $info_box->infoBoxClearance = new EGMapSize(1,1);
            $info_box->enableEventPropagation ='"floatPane"';

            // with the second info box, we don't need to 
            // set its properties as we are sharing a global 
            // info_box
            $info_box2 = new EGMapInfoBox('<div style="color:#000;border: 1px solid #c0c0c0; margin-top: 8px; background: #c0c0c0; padding: 5px;">I am a marker with info box 2!</div>');
            // Create marker
            $marker = new EGMapMarker(39.721089311812094, 2.91165944519042, array('title' => 'Marker With Info Box'));
            // add two 
            $marker2 = new EGMapMarker(39.721089311812094, 2.81165944519042, array('title' => 'Marker With Info Box 2'));
            $marker->addHtmlInfoBox($info_box);
            $marker2->addHtmlInfoBox($info_box2);

            $gMap->addMarker($marker);
            $gMap->addMarker($marker2);
            
            ob_start();
            
            $gMap->renderMap();

            $buffer = ob_get_contents();
            
            ob_end_clean();
                
	    $this->render('index',array('content'=>$buffer));
        }
        
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}