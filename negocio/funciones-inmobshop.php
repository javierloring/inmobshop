<?php

//mostramos la lista de errores producidos
//El array $errors va recogiendo los errores que se producen y se recorren
//con un foreach. se muestran en un párrafo de la presentación, con un echo
function muestraErrores($errors){
	if(count($errors) > 0){
		echo "<div id='error' class='w3-panel w3-pale-red w3-display-container'>
		<span onclick='this.parentElement.style.display=\"none\"'
	    class='w3-button w3-large w3-display-topright'>&times;</span>
		<ul>";
		//recorremos todos los errores
		foreach($errors as $error){
			//y los mostramos
			echo "<li>".$error."</li>";
		}
		echo "</ul>";
		echo "</div>";
	}
}

//análogo al anterior
function muestraExitos($exitos){
	if(count($exitos) > 0){
		echo "<div id='error' class='w3-panel w3-green w3-display-container'>
		<span onclick='this.parentElement.style.display=\"none\"'
	    class='w3-button w3-large w3-display-topright'>&times;</span>
		<ul>";
		//recorremos todos los errores
		foreach($exitos as $exito){
			//y los mostramos
			echo "<li>".$exito."</li>";
		}
		echo "</ul>";
		echo "</div>";
	}
}
