<?php

class CountryController extends Controller
{
	public function actionIndex()
	{      
                
                $codes = new ECountryCodes;
                
                $codes->setGeoUsername( Yii::app()->params['services']['egeonames']['username']);
                
                $codes->language = substr(Yii::app()->language,0,2);
                
                ob_start();
                
                echo $codes->dropDownList('codes1');

              /*$codes->language = 'de'; // ISO-639-1 language code (en,de,fr,it,es,...) (default = english)                
                $codes->topKeys = array('AT','DE'); //move these countries to the top of the list
                $codes->value = array('countryCode','currencyCode','countryName','capital');
                echo $codes->dropDownList('codes2','DE');*/

              /*$codes->resetKeys();
                $codes->selectKeys = array('AUT','DEU','LIE');
                $codes->key = 'isoAlpha3';
                $codes->value = array('isoAlpha3','countryName');
                echo $codes->dropDownList('codes3');*/

              /*$codes->resetKeys();
                $codes->excludeKeys = array('AT','DE','CH');
                echo $codes->dropDownList('codes4','CK');*/

              /*$codes->resetKeys();
                $codes->key = 'isoAlpha3';
                $codes->value = array('isoAlpha3','countryName');
                echo $codes->dropDownList('codes5','CK');

                $codes->resetKeys();
                $codes->key = 'currencyCode';
                $codes->value = array('currencyCode');
                echo $codes->dropDownList('codes6');*/

                $codes->resetKeys();
                $codes->update=true; //download the newest data, but bad performance
                $codes->value = array('countryName','population');
                echo $codes->dropDownList('codes7');                
                
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