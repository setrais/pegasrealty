<?php 
Yii::app()->clientScript->registerScript('search', "
$('form#mainSearch').submit(function(){
	$.fn.yiiGridView.update('realestates-grid', {
                type: 'post', 
		data: $(this).serialize()
	});
        /*yaCounter15927313.hit(location.href, null, null);
        if(_gaq){
           _gaq.push(['_trackPageview', location.href]);
           _gaq.push(['_trackEvent', 'List Realestates', 'Click search button']);
        }*/
	return false;
});     
");
?>