function subir(){
    //sacamos el desplazamiento actual de la página
    var desplazamientoActual = $(document).scrollTop();
    //accedemos al control de "ir arriba"
    var subir = $("#subir");
    //compruebo si debo mostrar el botón
    if(desplazamientoActual > 100 && subir.css("display") == "none"){
        subir.fadeIn(500);
    }
    //controlo si debo ocultar el botón
    if(desplazamientoActual < 100 && subir.css("display") == "block"){
        subir.fadeOut(500);
    }
}
