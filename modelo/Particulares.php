<?php
/**
 * Las instancias de esta clase representan los anunciantes particulares la
 * aplicación.
 *
 * @author JavierLoring
 */
class Particulares {

    //se crean atributos protegidos par aque se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_particular;
    protected $nif;
    protected $id_usuario;

    //para crear un particular le pasamos un array obtenido de una fila de la
    //base de datos

    public function __construct($row) {
        $this->id_particular = $row['id_particular'];
        $this->nif = $row['nif'];
        $this->id_usuario = $row['id_usuario'];
    }

    //no vamos a modificar los valores pero sí necesitamos acceder a ellos por
    //lo que creamos los métodos get necesarios.

    public function getId_particular() {
        return $this->id_particular;
    }

    public function getNif() {
        return $this->nif;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function muestra() {
        print "<p>" . $this->nif . "</p>";
    }

}
