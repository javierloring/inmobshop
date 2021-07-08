//definimos las variables de entrada del formulario
var tipo_inmueble, tipo_operacion, tipo_terreno, tipo_vivienda, tipo_piso, agua,
    luz, superficie, num_habitaciones, num_banyos, num_planta, nueva, bueno, rehabilitar,
    vacio, cocina, amueblado, exterior, interior, norte, sur, este, oeste, ascensor,
    arm_empotrados, calefaccion, aire_acond, terraza, balcon, trastero, plaza_garaje,
    piscina_propia, urbanizacion, piscina_comun, zonas_verdes, precio, semana,
    quincena, mes;
//las posicionamos en el html
tipo_terreno = $('#tipo_terreno');
tipo_vivienda = $('#tipo_vivienda');
tipo_piso = $('#tipo_piso');
agua = $('#agua');
luz = $('#luz');
superficie = $('#superficie');
num_habitaciones = $('#num_habitaciones');
num_banyos = $('#num_banyos');
num_planta = $('#num_planta');
nueva = $('#nueva');
bueno = $('#bueno');
rehabilitar = $('#rehabilitar');
vacio = $('#vacio');
cocina = $('#cocina');
amueblado = $('#amueblado');
exterior = $('#exterior');
interior = $('#interior');
norte = $('#norte');
sur = $('#sur');
este = $('#este');
oeste = $('#oeste');
ascensor = $('#ascensor');
arm_empotrados = $('#arm_empotrados');
calefaccion = $('#calefaccion');
aire_acond = $('#aire_acond');
terraza = $('#terraza');
balcon = $('#balcon');
trastero = $('#trastero');
plaza_garaje = $('#plaza_garaje');
piscina_propia = $('#piscina_propia');
urbanizacion = $('#urbanizacion');
piscina_comun = $('#piscina_comun');
zonas_verdes = $('#zonas_verdes');
precio = $('#precio');
semana = $('#semana');
quincena = $('#quincena');
mes = $('#mes');

//cuando se seleccione el tipo de inmueble o el tipo de operación, comprobamos
//que las entradas se ajusten el tipo de producto inmobiliario a anunciar
$('#tipo_inmueble').on('change', comprobar_producto);
$('#tipo_operacion').on('change', comprobar_producto);
$('#tipo_vivienda').on('change', comprobar_producto);

//comprobamos el tipo de producto inmobiliario
function comprobar_producto() {
    //obtenemos los valores de la selección realizada
    tipo_inmueble = $('#tipo_inmueble')
        .prop('options')[$('#tipo_inmueble').prop('selectedIndex')].text;
    tipo_operacion = $('#tipo_operacion')
        .prop('options')[$('#tipo_operacion').prop('selectedIndex')].text;
    tipo_vivienda = $('#tipo_vivienda')
        .prop('options')[$('#tipo_vivienda').prop('selectedIndex')].text;
    //contemplamos los diferentes productos inmobiliarios que podemos anunciar
    var terreno_venta = (tipo_inmueble == 'Terreno' && tipo_operacion == 'Venta');
    var terreno_alquiler = (tipo_inmueble == 'Terreno' && tipo_operacion == 'Alquiler');
    var terreno_y_vivienda_venta = (tipo_inmueble == 'Terreno&vivienda' && tipo_operacion == 'Venta');
    var terreno_y_vivienda_alquiler = (tipo_inmueble == 'Terreno&vivienda' && tipo_operacion == 'Alquiler');
    var terreno_y_vivienda_vacacional = (tipo_inmueble == 'Terreno&vivienda' && tipo_operacion == 'Vacacional');
    var vivienda_venta = (tipo_inmueble == 'Vivienda' && tipo_operacion == 'Venta');
    var vivienda_alquiler = (tipo_inmueble == 'Vivienda' && tipo_operacion == 'Alquiler');
    var vivienda_vacacional = (tipo_inmueble == 'Vivienda' && tipo_operacion == 'Vacacional');
    var vivienda_compartir = (tipo_inmueble == 'Vivienda' && tipo_operacion == 'Compartir');
    var local_venta = (tipo_inmueble == 'Local' && tipo_operacion == 'Venta');
    var local_alquiler = (tipo_inmueble == 'Local' && tipo_operacion == 'Alquiler');
    var oficina_venta = (tipo_inmueble == 'Oficina' && tipo_operacion == 'Venta');
    var oficina_alquiler = (tipo_inmueble == 'Oficna' && tipo_operacion == 'Alquiler');
    var garaje_venta = (tipo_inmueble == 'Garaje' && tipo_operacion == 'Venta');
    var garaje_alquiler = (tipo_inmueble == 'Garaje' && tipo_operacion == 'Alquiler');
    var trastero_venta = (tipo_inmueble == 'Trastero' && tipo_operacion == 'Venta');
    var trastero_alquiler = (tipo_inmueble == 'Trastero' && tipo_operacion == 'Alquiler');
    var nave_venta = (tipo_inmueble == 'Nave' && tipo_operacion == 'Venta');
    var nave_alquiler = (tipo_inmueble == 'Nave' && tipo_operacion == 'Alquiler');

    switch (true) {
        case terreno_venta:
            inputs_terreno_venta();
            break;
        case terreno_alquiler:
            inputs_terreno_venta();
            inputs_alquiler();
            break;
        case terreno_y_vivienda_venta:
            inputs_terreno_y_vivienda_venta();
            break;
        case (terreno_y_vivienda_alquiler || terreno_y_vivienda_vacacional):
            inputs_terreno_y_vivienda_venta();
            inputs_alquiler();
            break;
        case vivienda_venta:
            inputs_vivienda_venta();
            inputs_tipo_piso();
            break;
        case (vivienda_alquiler || vivienda_vacacional || vivienda_compartir):
            inputs_vivienda_venta();
            inputs_tipo_piso();
            inputs_alquiler();
            break;
        case (local_venta || oficina_venta || garaje_venta || trastero_venta || nave_venta):
            break;
        case (local_alquiler || oficina_alquiler || garaje_alquiler || trastero_alquiler || nave_alquiler):
            inputs_alquiler();
        default:
    }
}
//los inputs de terreno en ventana
function inputs_terreno_venta() {
    $('#tipo_terreno').prop('disabled', false);
    $('#tipo_terreno').prop('required', true);
    agua.prop('disabled', false);
    luz.prop('disabled', false);
}
// los inputs específicos de terreno en venta más los de vivienda en venta
function inputs_terreno_y_vivienda_venta() {
    inputs_terreno_venta();
    inputs_vivienda_venta();
}
//los inputs específicos de vivienda en venta
function inputs_vivienda_venta() {
    $('#tipo_vivienda').prop('disabled', false);
    $('#tipo_vivienda').prop('required', true);
    num_habitaciones.prop('disabled', false);
    num_habitaciones.prop('required', true);
    num_banyos.prop('disabled', false);
    num_banyos.prop('required', true);
    nueva.prop('disabled', false);
    nueva.prop('required', true);
    bueno.prop('disabled', false);
    bueno.prop('required', true);
    rehabilitar.prop('disabled', false);
    rehabilitar.prop('required', true);
    vacio.prop('disabled', false);
    vacio.prop('required', true);
    cocina.prop('disabled', false);
    cocina.prop('required', true);
    amueblado.prop('disabled', false);
    amueblado.prop('required', true);
    norte.prop('disabled', false);
    norte.prop('required', true);
    sur.prop('disabled', false);
    sur.prop('required', true);
    este.prop('disabled', false);
    este.prop('required', true);
    oeste.prop('disabled', false);
    oeste.prop('required', true);
    ascensor.prop('disabled', false);
    arm_empotrados.prop('disabled', false);
    calefaccion.prop('disabled', false);
    aire_acond.prop('disabled', false);
    terraza.prop('disabled', false);
    balcon.prop('disabled', false);
    trastero.prop('disabled', false);
    plaza_garaje.prop('disabled', false);
    piscina_propia.prop('disabled', false);
    urbanizacion.prop('disabled', false);
    piscina_comun.prop('disabled', false);
    zonas_verdes.prop('disabled', false);
}
//inputs de alquiler
function inputs_alquiler() {
    semana.prop('disabled', false);
    quincena.prop('disabled', false);
    mes.prop('disabled', false);
}
//inputs para tipo_Piso
function inputs_tipo_piso() {
    if (tipo_vivienda == 'Piso') {
        $('#tipo_piso').prop('disabled', false);
        $('#tipo_piso').prop('required', true);
        $('#num_planta').prop('disabled', false);
        $('#num_planta').prop('required', true);
        exterior.prop('disabled', false);
        interior.prop('disabled', false);
    }
}