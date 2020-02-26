<?php
/**
 * Las instancias de esta clase representan los anunciantes particulares la
 * aplicación.
 *
 * @author JavierLoring
 */
use Usuario;

class Particular extends Usuario {

    //se crean atributos protegidos par aque se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_particular;
    protected $nif;
    protected $id_usuario;

    //para crear un Usuario particular le pasamos un array obtenido de los campos
    //de un registro de la tabla particulares y de un registro de la tabla usuarios
    //indicado por la clave ajena id_usuario

    /**
     * crea una instancia de un anunciante particular
     * @param array $row [$id_particular, $nif, $usuario[...]]
     */
    public function __construct($row) {
        parent::__construct($row['id_usuario']);
        $this->id_particular = $row['id_particular'];
        $this->nif = $row['nif'];
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
