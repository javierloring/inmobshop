//aquí la implementación javascript de geocodificación
//(la de búsqueda se realiza en bu-HERE.js)

//creamos un enlace a alplataforma
var platform = new H.service.Platform({
  'apikey': '{CJDY3MZAb06SNOA3tEKO10RwmuG4f5CDp8nBH4mFFeM}'
});

//queremos introducir una dirección y obtener sus coordenadas para almacenarlas
//en la base de datos

//creamos un objeto que contiene las capas de mapas por defecto
var defaultLayers = platform.createDefaultLayers();

//instanciamos un mapa suando el mapa vector con el estilo por defecto como
//capa base (contenedor, mapa)
var map = new H.Map(
    document.getElementById('mapContainer'),
    defaultLayers.vector.normal.map
);

//ejemplo de petición asíncrona al servicio de búsqueda de geocodificación
// Obtenemos una instancia del servicio de geocodificación:
var service = platform.getSearchService();
//---------------------------------------------------------------GEOCODIFICACION
// Llamada al método geocode pasándole los parámetros de geocodificación,
// Un retorno de llamada y una función de retorno de llamada de error(para
// gestionar un posible error)
service.geocode({
  q: '200 S Mathilda Ave, Sunnyvale, CA'
}, (result) => {
  // añade un marcador a cada localización encontrada
  result.items.forEach((item) => {
    map.addObject(new H.map.Marker(item.position));
  });
}, alert);
//-------------------------------------------------------GEOCODIFICACIÓN INVERSA
//conocidas unas coordenadas como mostrar la dirección en una etiqueta emergente
//dentro de un mapa
// Llamada al método reverseGeocode pasándole los parámetros de geocodificación,
// Un retorno de llamada y una función de retorno de llamada de error(para
// gestionar un posible error)
service.reverseGeocode({
  at: '52.5309,13.3847,150'
}, (result) => {
  result.items.forEach((item) => {
    // Assumption: ui is instantiated
    // Create an InfoBubble at the returned location with
    // the address as its contents:
    ui.addBubble(new H.ui.InfoBubble(item.position, {
      content: item.address.label
    }));
  });
}, alert);
//-------------------------------------------------------------------AUTOSUGGEST
//El autosuggestpunto final mejora la experiencia de búsqueda del usuario al
//permitir el envío de direcciones de forma libre, incompletas y mal escritas o
//nombres de lugares al punto final.
//El siguiente ejemplo muestra cómo buscar el Aeropuerto Internacional O'Hare de
//Chicago (ORD).
//Llamada al método autosuggest pasándole los parámetros de búsqueda,
// Un retorno de llamada y una función de retorno de llamada de error(para
// gestionar un posible error)
service.autosuggest({
  // Search query
  q: 'Chicago ORD',
  // Center of the search context
  at: '38.71014896078624,-98.60787954719035'
}, (result) => {
  let {position, title} = result.items[0];
  // Assumption: ui is instantiated
  // Create an InfoBubble at the returned location
  ui.addBubble(new H.ui.InfoBubble(position, {
    content: title
  }));
}, alert);
//-----------------------------------------------REGISTRAR EVENTO TAP EN UN MAPA
function configuraRegistradorClick(map) {
  // añade un registrador de eventos al mapa mostrado
  // obtiene las coordenadas y las muestra en una caja alerta
  map.addEventListener('tap', function (evt) {
    var coord = map.screenToGeo(evt.currentPointer.viewportX,
            evt.currentPointer.viewportY);
    logEvent('Clicked at ' + Math.abs(coord.lat.toFixed(4)) +
        ((coord.lat > 0) ? 'N' : 'S') +
        ' ' + Math.abs(coord.lng.toFixed(4)) +
         ((coord.lng > 0) ? 'E' : 'W'));
  });
}
