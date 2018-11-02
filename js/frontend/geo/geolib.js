var geocoder;
var last_result;
$(function() {
    //geocoder = new google.maps.Geocoder();
});
/**
 * Check string with address with geocoder. Returns true if geocoder has one result
 * @param string address
 */
function CheckAddress(address, callback){
	callback(true);
	return;
    /*if (address != '') {
        geocoder.geocode({'address':address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
//                console.log(results.length);
                if (results.length == 1) {
                    last_results = results;
                    var success = false;
                    $(results).each(function(i, result) {
                        last_result = result;
                        success = true;
                    });
//                    console.log(last_results);
                    callback(success);
                    return;
                }

                if (results.length > 1)
                    $.pnotify({
                        pnotify_title: 'Ошибка',
                        pnotify_type: 'error',
                        pnotify_text: "Не удалось однозначно определить координаты вашего адреса."
                    });
                else
                    $.pnotify({
                        pnotify_title: 'Ошибка',
                        pnotify_type: 'error',
                        pnotify_text: "Не удалось определить координаты вашего адреса."
                    });
            } else {
                $.pnotify({
                    pnotify_title: 'Ошибка',
                    pnotify_type: 'error',
                    pnotify_text: "Не удалось определить координаты по следующей причине: " + status
                });
            }
            callback(false);
        });
    }*/
}

function formattedAddress(result) {
    var addressResult = [];
    for (var c = result.address_components.length - 1; c >= 0; c--) {
        $(['route', 'street_address']).each(function(i, key) {
            if ($.inArray(key, result.address_components[c].types) > -1) {
                addressResult[addressResult.length] = result.address_components[c].short_name;
            }
        });
    }
    return addressResult.join(', ');
}

function GetPointCoordinates(result){
    latitude = result.geometry.location.lat();
    longitude = result.geometry.location.lng();
    return latitude + ',' + longitude;
}