<?php
/**
 * Las instancias de esta clase representan los gestores de la aplicación.
 *
 * @author JavierLoring
 */

class Gestor {

    //se crean atributos protegidos par aque no sean accesibles desde fuera de
    //la clase

    protected $id_gestor;
    protected $nombre_gestor;
    protected $password_gestor;

    //para crear una instancia de gestor le pasamos al constructor un array con
    //los campos obtenidos de un registro de la tabla gestores.

    /**
     * crea una instancia de un anunciante particular
     * @param array $row [$id_particular, $nif, $usuario[...]]
     */
    public function __construct($row) {
        $this->id_gestor = $row['id_gestor'];
        $this->nombre_gestor = $row['nombre_gestor'];
        $this->password_gestor = $row['password_gestor'];
    }

    //no vamos a modificar los valores pero sí necesitamos acceder a ellos por
    //lo que creamos los métodos get necesarios.

    public function getId_gestor() {
        return $this->id_gestor;
    }

    public function getNombre_gestor() {
        return $this->nombre_gestor;
    }

    public function getPassword_gestor() {
        return $this->password_gestor;
    }

    public function muestra() {
        print "<p>" . $this->nombre_gestor . "</p>";
    }

}
