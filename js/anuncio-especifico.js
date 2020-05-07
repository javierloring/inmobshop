/**
 * Vuelve a la página anterior
 * @param  {element} element el enlace sobre el que pulsamos
 */
function volver_anterior(element) {
    element.preventDefault();
    window.history.back();
}
/**
 * Muestra la diapositiva
 * @param  {integer} n número de imagen
 */
 function showDivs(n) {
   var i;
   var x = document.getElementsByClassName("misFotos");
   if (n > x.length) {slideIndex = 1}
   if (n < 1) {slideIndex = x.length}
   for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
   }
   x[slideIndex-1].style.display = "block";
 }
/**
 * Muestra la imagen anterior o posterior (se llama en línea)
 * @param  {integer} n salto de diapositiva (normalmente -1, 1)
 */
function plusDivs(n) {
  showDivs(slideIndex += n);
}
