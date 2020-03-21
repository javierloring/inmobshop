//implementamos la funcinalidad para que el select del index dirija al inicio
//de sesión
function enviar_usuario(){
    var valor_selected = $('select').prop('options')[$('select').prop('selectedIndex')].value;
    if(valor_selected != '')
    //descomentar para modificar action
    //$('form').attr({'action': valor_selected});
    $('form').submit();
}
