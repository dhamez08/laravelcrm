var HandleMapsGoogle = function () {
	var mapGoogleGeocoding = function () {
        var text = $.trim($('#gmap_geocoding_address').val());

        var map = new GMaps({
            div: '#gmap_geocoding',
            zoom: 16,
            lat: -12.043333,
            lng: -77.028333
        });

        GMaps.geocode({
            address: text,
            callback: function (results, status) {
                if (status == 'OK') {
                    var latlng = results[0].geometry.location;
                    map.setCenter(latlng.lat(), latlng.lng());
                    map.addMarker({
                        lat: latlng.lat(),
                        lng: latlng.lng()
                    });
                }
            }
        });


   };

	return {
		init: function(){
			mapGoogleGeocoding();
		},
	};
}();
