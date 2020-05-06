function mostrar() {
    var valor_selected = $('#tipo_operacion').prop('options')[$('select').prop('selectedIndex')].value;
    if(valor_selected != 'compra') {
        $('#tiempo').toggleClass('visto');
    }else {
        $('#tiempo').toggleClass('visto');
    }
}
