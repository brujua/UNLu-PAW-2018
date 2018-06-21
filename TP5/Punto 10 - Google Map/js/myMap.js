var map;
var autocomplete;
var input;
var infowindow;
var MyMap ={
    init:function () {

    },

    initMap:function () {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.567, lng: -59.121},
            zoom: 8
        });
        input = document.getElementById('place-input');
        //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        autocomplete = new google.maps.places.Autocomplete(input);
        //autocomplete.bindTo('bounds', map);
        infowindow = new google.maps.InfoWindow();

        autocomplete.addListener('place_changed', function(){
            infowindow.close();
            let place = autocomplete.getPlace();
            if (!place.geometry) {
                // Si el usuario ingreso algo no sugerido
                // y aprentó enter, o getPlace falló.
                window.alert("No hay información sobre: '" + place.name + "'");
            }
            else {
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);  //17 parece un valor razonable
                }
            }
        });
    }
};