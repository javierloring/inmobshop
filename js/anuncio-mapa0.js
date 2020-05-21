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
// This example uses the autocomplete feature of the Google Places API.
// It allows the user to find all hotels in a given place, within a given
// country. It then displays markers for all the hotels returned,
// with on-click details for each hotel.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var map, places, infoWindow;
var markers = [];
var autocomplete;
//restricción para la búsqueda
var countryRestrict = {'country': 'es'};
var MARKER_PATH = 'https://developers.google.com/maps/documentation/javascript/images/marker_green';
var hostnameRegexp = new RegExp('^https?://.+?/');

var countries = {
  'au': {
    center: {lat: -25.3, lng: 133.8},
    zoom: 4
  },
  'br': {
    center: {lat: -14.2, lng: -51.9},
    zoom: 3
  },
  'ca': {
    center: {lat: 62, lng: -110.0},
    zoom: 3
  },
  'fr': {
    center: {lat: 46.2, lng: 2.2},
    zoom: 5
  },
  'de': {
    center: {lat: 51.2, lng: 10.4},
    zoom: 5
  },
  'mx': {
    center: {lat: 23.6, lng: -102.5},
    zoom: 4
  },
  'nz': {
    center: {lat: -40.9, lng: 174.9},
    zoom: 5
  },
  'it': {
    center: {lat: 41.9, lng: 12.6},
    zoom: 5
  },
  'za': {
    center: {lat: -30.6, lng: 22.9},
    zoom: 5
  },
  'es': {
    center: {lat: 40.5, lng: -3.7},
    zoom: 5
  },
  'pt': {
    center: {lat: 39.4, lng: -8.2},
    zoom: 6
  },
  'us': {
    center: {lat: 37.1, lng: -95.7},
    zoom: 3
  },
  'uk': {
    center: {lat: 54.8, lng: -4.6},
    zoom: 5
  }
};
//crea un mapa, una ventana de información, una instancia de autocomplete,
//una instancia de places, registra el evento place_changed (onPlaceChanged)
//para la autocomplete instancia y el evento change para el elemento country
//(setAutocompleteCountry)
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: countries['es'].zoom,
    center: countries['es'].center,
    // center: {lat: 36.6850064, lng: -6.1260744},
    // zoom: 8
    mapTypeControl: false,
    panControl: false,
    zoomControl: false,
    streetViewControl: false
  });
//ventana emergente con los datos seleccionados
  infoWindow = new google.maps.InfoWindow({
    content: document.getElementById('info-content')
  });

  // Create the autocomplete object and associate it with the UI input control.
  // Restrict the search to the default country, and to place type "cities".
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */ (
          document.getElementById('autocomplete')), {
        types: ['(cities)'],
        componentRestrictions: countryRestrict
      });
  //instancia de places asociada al mapa
  places = new google.maps.places.PlacesService(map);
  //el evento se dispara cuando se selecciona un lugar sugerido
  autocomplete.addListener('place_changed', onPlaceChanged);

  // Add a DOM event listener to react when the user selects a country.
  document.getElementById('country').addEventListener(
      'change', setAutocompleteCountry);
}

// When the user selects a city, get the place details for the city and
// zoom the map in on the city.
function onPlaceChanged() {
  var place = autocomplete.getPlace();
  //si el lugar esta localizado se mueve el mapa a dicho lugar con zoom 15
  if (place.geometry) {
    map.panTo(place.geometry.location);
    map.setZoom(15);
    search();//realiza na búsqueda definida a continuación optativo
  } else {
    document.getElementById('autocomplete').placeholder = 'Enter a city';
  }
}

// Search for hotels in the selected city, within the viewport of the map.
// Busca alojamientos dentro de los límites del mapa, asigna a cada resultado un
// marcador(letra, icono, y lo añade a un array de marcadores de google maps
// asignándoles posición, animación y el icono)
function search() {
  var search = {
    bounds: map.getBounds(),
    types: ['lodging']
  };

  places.nearbySearch(search, function(results, status) {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
      clearResults();
      clearMarkers();
      // Create a marker for each hotel found, and
      // assign a letter of the alphabetic to each marker icon.
      for (var i = 0; i < results.length; i++) {
        var markerLetter = String.fromCharCode('A'.charCodeAt(0) + (i % 26));
        var markerIcon = MARKER_PATH + markerLetter + '.png';
        // Use marker animation para soltar los iconos de forma incremental en el mapa
        markers[i] = new google.maps.Marker({
          position: results[i].geometry.location,
          animation: google.maps.Animation.DROP,
          icon: markerIcon
        });
        //registra en el marcador el evento click y la función showInfoWindow
        //deja caer los marcadores a poquito y genera una fila en la tabla de
        //resultados de la búsqueda
        markers[i].placeResult = results[i];
        google.maps.event.addListener(markers[i], 'click', showInfoWindow);
        setTimeout(dropMarker(i), i * 100);
        addResult(results[i], i);
      }
    }
  });
}
//retira los marcadores del mapa y renueva el array de marcadores
function clearMarkers() {
  for (var i = 0; i < markers.length; i++) {
    if (markers[i]) {
      markers[i].setMap(null);
    }
  }
  markers = [];
}

// Asigna una restricción de país basada en una elección del usuario
// Centra y hace zoom en el mapa en el país dado
function setAutocompleteCountry() {
  var country = document.getElementById('country').value;
  //todos los paises
  if (country == 'all') {
    autocomplete.setComponentRestrictions({'country': []});
    map.setCenter({lat: 15, lng: 0});
    map.setZoom(2);
    //un país concreto
  } else {
    autocomplete.setComponentRestrictions({'country': country});
    map.setCenter(countries[country].center);
    map.setZoom(countries[country].zoom);
  }
    //limpia los resultados y limpia el mapa de marcadores
  clearResults();
  clearMarkers();
}
//coloca un marcador en el mapa
function dropMarker(i) {
  return function() {
    markers[i].setMap(map);
  };
}
//añade resultados a la tabla resultsTable, a partir de un resultado y un índice
function addResult(result, i) {
  var results = document.getElementById('results');
  var markerLetter = String.fromCharCode('A'.charCodeAt(0) + (i % 26));
  var markerIcon = MARKER_PATH + markerLetter + '.png';
  //crea una fila le añade color de fondo, registra como evento click un trigger
  //del click del marcador correspondiente
  var tr = document.createElement('tr');
  tr.style.backgroundColor = (i % 2 === 0 ? '#F0F0F0' : '#FFFFFF');
  tr.onclick = function() {
    google.maps.event.trigger(markers[i], 'click');
  };
  //crea unelemento celda para el icono y otro para el nombre y una imagen para
  //el icono, a la que asigna como propiedad fuente el icono de marcador
  var iconTd = document.createElement('td');
  var nameTd = document.createElement('td');
  var icon = document.createElement('img');
  icon.src = markerIcon;
  icon.setAttribute('class', 'placeIcon');//clase
  icon.setAttribute('className', 'placeIcon');//nombre de clase
  var name = document.createTextNode(result.name);//crea un nodo texto con el nombre
  //coloca los contenidos en sus celdas y las celdas en la fila y la fila a la tabla
  iconTd.appendChild(icon);
  nameTd.appendChild(name);
  tr.appendChild(iconTd);
  tr.appendChild(nameTd);
  results.appendChild(tr);
}
//vacía la tabla de resultados
//mientras quede al gun elemento en el tbody results, lo eliminamos
function clearResults() {
  var results = document.getElementById('results');
  while (results.childNodes[0]) {
    results.removeChild(results.childNodes[0]);
  }
}

// Obtiene los detalles de lugar para un hotel, la muestra en una ventana de información,
// anclada en el marcador del hotel seleccionado por el usuario
function showInfoWindow() {
  var marker = this;//el marcador al que se llama click
  places.getDetails({placeId: marker.placeResult.place_id},
      function(place, status) {
        if (status !== google.maps.places.PlacesServiceStatus.OK) {
          return;
        }
        infoWindow.open(map, marker);
        buildIWContent(place);
      });
}

// Load the place information into the HTML elements used by the info window.
function buildIWContent(place) {
  document.getElementById('iw-icon').innerHTML = '<img class="hotelIcon" ' +
      'src="' + place.icon + '"/>';
  document.getElementById('iw-url').innerHTML = '<b><a href="' + place.url +
      '">' + place.name + '</a></b>';
  document.getElementById('iw-address').textContent = place.vicinity;

  if (place.formatted_phone_number) {
    document.getElementById('iw-phone-row').style.display = '';
    document.getElementById('iw-phone').textContent =
        place.formatted_phone_number;
  } else {
    document.getElementById('iw-phone-row').style.display = 'none';
  }

  // Assign a five-star rating to the hotel, using a black star ('&#10029;')
  // to indicate the rating the hotel has earned, and a white star ('&#10025;')
  // for the rating points not achieved.
  if (place.rating) {
    var ratingHtml = '';
    for (var i = 0; i < 5; i++) {
      if (place.rating < (i + 0.5)) {
        ratingHtml += '&#10025;';
      } else {
        ratingHtml += '&#10029;';
      }
    document.getElementById('iw-rating-row').style.display = '';
    document.getElementById('iw-rating').innerHTML = ratingHtml;
    }
  } else {
    document.getElementById('iw-rating-row').style.display = 'none';
  }

  // The regexp isolates the first part of the URL (domain plus subdomain)
  // to give a short URL for displaying in the info window.
  if (place.website) {
    var fullUrl = place.website;
    var website = hostnameRegexp.exec(place.website);
    if (website === null) {
      website = 'http://' + place.website + '/';
      fullUrl = website;
    }
    document.getElementById('iw-website-row').style.display = '';
    document.getElementById('iw-website').textContent = website;
  } else {
    document.getElementById('iw-website-row').style.display = 'none';
  }
}
//-----------------------------------------------------------------------EJEMPLO
//parámetro sessiontoken, ejemplo
//https://maps.googleapis.com/maps/api/place/autocomplete/json?input=1600+Amphitheatre&key=<API_KEY>&sessiontoken=1234567890

//Ejemplo de solicitudes
//Una solicitud de establecimientos que contengan la cadena "Amoeba" dentro de un área centrada en San Francisco, CA:
//https://maps.googleapis.com/maps/api/place/autocomplete/xml?input=Amoeba&types=establishment&location=37.76999,-122.44696&radius=500&key=YOUR_API_KEY

//La misma solicitud, restringida a resultados dentro de los 500 metros de Ashbury St y Haight St, San Francisco:
//https://maps.googleapis.com/maps/api/place/autocomplete/xml?input=Amoeba&types=establishment&location=37.76999,-122.44696&radius=500&strictbounds&key=YOUR_API_KEY

//Una solicitud de direcciones que contengan "Vict" con resultados en francés:
//https://maps.googleapis.com/maps/api/place/autocomplete/json?input=Vict&types=geocode&language=fr&key=YOUR_API_KEY

//Una solicitud de ciudades que contengan "Vict" con resultados en portugués brasileño:
//https://maps.googleapis.com/maps/api/place/autocomplete/json?input=Vict&types=(cities)&language=pt_BR&key=YOUR_API_KEY

//Las respuestas de Autocompletar lugar se devuelven en el formato indicado por
//el outputindicador dentro de la ruta URL de la solicitud. Los resultados a
//continuación son indicativos de lo que se puede devolver para una consulta
//con los siguientes parámetros:
//input=Paris&types=geocode
// {
//   "status": "OK",
//   "predictions" : [
//       {
//          "description" : "Paris, France",
//          "distance_meters" : 8030004,
//          "id" : "691b237b0322f28988f3ce03e321ff72a12167fd",
//          "matched_substrings" : [
//             {
//                "length" : 5,
//                "offset" : 0
//             }
//          ],
//          "place_id" : "ChIJD7fiBh9u5kcRYJSMaMOCCwQ",
//          "reference" : "CjQlAAAA_KB6EEceSTfkteSSF6U0pvumHCoLUboRcDlAH05N1pZJLmOQbYmboEi0SwXBSoI2EhAhj249tFDCVh4R-PXZkPK8GhTBmp_6_lWljaf1joVs1SH2ttB_tw",
//          "terms" : [
//             {
//                "offset" : 0,
//                "value" : "Paris"
//             },
//             {
//                "offset" : 7,
//                "value" : "France"
//             }
//          ],
//          "types" : [ "locality", "political", "geocode" ]
//       },
//       {
//          "description" : "Paris-Madrid Grocery (Spanish Table Seattle), Western Avenue, Seattle, WA, USA",
//          "distance_meters" : 12597,
//          "id" : "f4231a82cfe0633a6a32e63538e61c18277d01c0",
//          "matched_substrings" : [
//             {
//                "length" : 5,
//                "offset" : 0
//             }
//          ],
//          "place_id" : "ChIJHcYlZ7JqkFQRlpy-6pytmPI",
//          "reference" : "ChIJHcYlZ7JqkFQRlpy-6pytmPI",
//          "structured_formatting" : {
//             "main_text" : "Paris-Madrid Grocery (Spanish Table Seattle)",
//             "main_text_matched_substrings" : [
//                {
//                   "length" : 5,
//                   "offset" : 0
//                }
//             ],
//             "secondary_text" : "Western Avenue, Seattle, WA, USA"
//          },
//          "terms" : [
//             {
//                "offset" : 0,
//                "value" : "Paris-Madrid Grocery (Spanish Table Seattle)"
//             },
//             {
//                "offset" : 46,
//                "value" : "Western Avenue"
//             },
//             {
//                "offset" : 62,
//                "value" : "Seattle"
//             },
//             {
//                "offset" : 71,
//                "value" : "WA"
//             },
//             {
//                "offset" : 75,
//                "value" : "USA"
//             }
//          ],
//          "types" : [
//             "grocery_or_supermarket",
//             "food",
//             "store",
//             "point_of_interest",
//             "establishment"
//          ]
//       },
//       {
//          "description" : "Paris, TX, USA",
//          "distance_meters" : 2712292,
//          "id" : "518e47f3d7f39277eb3bc895cb84419c2b43b5ac",
//          "matched_substrings" : [
//             {
//                "length" : 5,
//                "offset" : 0
//             }
//          ],
//          "place_id" : "ChIJmysnFgZYSoYRSfPTL2YJuck",
//          "reference" : "ChIJmysnFgZYSoYRSfPTL2YJuck",
//          "structured_formatting" : {
//             "main_text" : "Paris",
//             "main_text_matched_substrings" : [
//                {
//                   "length" : 5,
//                   "offset" : 0
//                }
//             ],
//             "secondary_text" : "TX, USA"
//          },
//          "terms" : [
//             {
//                "offset" : 0,
//                "value" : "Paris"
//             },
//             {
//                "offset" : 7,
//                "value" : "TX"
//             },
//             {
//                "offset" : 11,
//                "value" : "USA"
//             }
//          ],
//          "types" : [ "locality", "political", "geocode" ]
//       },
//   ...additional results ...
