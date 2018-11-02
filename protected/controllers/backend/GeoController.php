<?php

class GeoController extends Controller
{
	public function actionIndex()
	{
                Yii::import('ext.geo.geoip.EGeoIP');
 
                $geoIp = new EGeoIP();

                //$geoIp->locate('178.94.166.13'); // use your IP
                $geoIp->locate($_SERVER['REMOTE_ADDR']); // use your IP
                //$geoIp->locate('88.27.28.44'); // use your IP

                ob_start();
                
                echo 'Information regarding IP: <b>'.$geoIp->ip.'</b><br/>';
                echo 'City: '.$geoIp->city.'<br>';
                echo 'Region: '.$geoIp->region.'<br>';
                echo 'Area Code: '.$geoIp->areaCode.'<br>';
                echo 'DMA: '.$geoIp->dma.'<br>';
                echo 'Country Code: '.$geoIp->countryCode.'<br>';
                echo 'Country Name: '.$geoIp->countryName.'<br>';
                echo 'Continent Code: '.$geoIp->continentCode.'<br>';
                echo 'Latitude: '.$geoIp->latitude.'<br>';
                echo 'Longitude: '.$geoIp->longitude.'<br>';
                echo 'Currency Symbol: '.$geoIp->currencySymbol.'<br>';
                echo 'Currency Code: '.$geoIp->currencyCode.'<br>';
                echo 'Currency Converter: '.$geoIp->currencyConverter.'<br/>';

                echo 'Converting $10.00 to '.$geoIp->currencyCode.': <b>'.$geoIp->currencyConvert(10).'</b><br/>';
                
                $buffer = ob_get_contents();
                
                ob_end_clean();

		$this->render('index', array('content'=>$buffer));
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