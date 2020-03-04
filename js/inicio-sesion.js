//implementamos la funcinalidad para que el select del index dirija al inicio
//de sesión
function asignar_action(){
    var valor_selected = $('select').prop('options')[$('select').prop('selectedIndex')].value;
    $('form').attr({'action': valor_selected});
    $('form').submit();
}
