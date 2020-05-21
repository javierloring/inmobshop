// var map;
// function initMap() {
//   map = new google.maps.Map(document.getElementById('mapa'), {
//     center: {lat: 36.6850064, lng: -6.1260744},
//     zoom: 8
//  mapTypeControl: false,
//  panControl: false,
//  zoomControl: false,
//  streetViewControl: false
//   });
// }
//-----------------------------------------------------------------------EJEMPLO
var input_autocomplete, direccion;
var map, places, infoWindow;
var marker;
var autocomplete;
//restricción para la búsqueda
var countryRestrict = {'country': 'es'};
var MARKER_PATH = 'https://developers.google.com/maps/documentation/javascript/images/marker_green';
var hostnameRegexp = new RegExp('^https?://.+?/');

//crea un mapa, una ventana de información, una instancia de autocomplete,
//una instancia de places, registra el evento place_changed (onPlaceChanged)
//para la autocomplete instancia y el evento change para el elemento country
//(setAutocompleteCountry)
function initMap() {
  map = new google.maps.Map(document.getElementById('mapa'), {
    center: {lat: 36.6850064, lng: -6.1260744},
    zoom: 10,
    // center: {lat: 36.6850064, lng: -6.1260744},
    // zoom: 8
    mapTypeControl: false,
    panControl: true,
    zoomControl: true,
    streetViewControl: false
  });
  // Create the autocomplete object and associate it with the UI input control.
  // Restrict the search to the default country, and to place type "cities".
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */ (
          document.getElementById('autocomplete')), {
        types: ['geocode'],
        componentRestrictions: countryRestrict
      });
  //instancia de places asociada al mapa
  places = new google.maps.places.PlacesService(map);
  //el evento se dispara cuando se selecciona un lugar sugerido
  autocomplete.addListener('place_changed', onPlaceChanged);
  //instancia de geocodificador
  geocoder = new google.maps.Geocoder();
  //instanciamos infoWindow
  infowindow = new google.maps.InfoWindow;

  input_autocomplete = document.getElementById('autocomplete');
  boton_ok = $('#ok');
  boton_ok.on('click', function () {
    // var input = document.getElementById('latlng').value;
    // var latlngStr = input.split(',', 2);
    // var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
    latlng = map.getCenter();
    geocoder.geocode({'location': latlng}, function(results, status) {
      if (status === 'OK') {
          if (results[0]) {
                map.setZoom(17);
                direccion = results[0].formatted_address;
                infowindow.setContent(direccion);
                // infowindow.open(map, marker);
                input_autocomplete.value = direccion;
                var array_direc = direccion.split(',');
                var via = array_direc[0];
                var num_via = array_direc[1];
                var mixta = array_direc[2];
                var provincia = array_direc[3];
                mixta.trim();
                var cod_postal = mixta.substring(0, 6);
                var localidad = mixta.substring(6);
                input_via = document.getElementById('via');
                input_num_via = document.getElementById('num_via');
                input_cod_postal = document.getElementById('cod_postal');
                input_localidad = document.getElementById('localidad');
                input_provincia = document.getElementById('provincia');
                input_via.value = via;
                input_num_via.value = num_via;
                input_cod_postal.value = cod_postal;
                input_localidad.value = localidad;
                input_provincia.value = provincia;
        } else {
          window.alert('No results found');
        }
      } else {
        window.alert('Geocoder failed due to: ' + status);
      }
    });
  });

}

// When the user selects a city, get the place details for the city and
// zoom the map in on the city.
function onPlaceChanged() {
    var place = autocomplete.getPlace();
    //si el lugar esta localizado se mueve el mapa a dicho lugar con zoom 15
    if (place.geometry) {
        map.panTo(place.geometry.location);
        map.setZoom(17);
        input_autocomplete.setAttribute('style', 'background-color: GreenYellow;');
        direccion = $('#autocomplete').val();
        //alert (direccion);
        coordenadas = place.geometry.location;

        //creamos un marcador con la posición introducida situado en el centro del mapa
        marker = new google.maps.Marker({
            position: coordenadas,
            map: map,
            title: 'mueve el mapa y colocáme sobre el inmueble.'
        });
        //alert(coordenadas);
        //el marcador siempre ocupa el centro del mapa
        map.addListener('bounds_changed', function(){
            nuevo_centro = map.getCenter();
            marker.setPosition(nuevo_centro);
        });
    } else {
        document.getElementById('autocomplete').placeholder = 'Introduzca una localización';
    }
}

//cuando se pulse OK, el centro del mapa se envía al goecoder para que
//devuelva todos los datos de la dirección
//Ya podemos guardar las coordenadas en la base de datos

//obtiene la dirección y la muestra en los campos de dirección
//y guarda la posición en la base de datos, recupera el campo id y lo guarda
//en un campo oculto del formulario
