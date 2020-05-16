<?php
require_once 'BD.php';
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

    /**
     * método auxiliar que devuelve un registro con el gestor cuyo usuario se
     * ha pasado para comprobar si el Usuario está registrado
     * @param  string $user  nombre de usuario pasado
     * @return array  $row   array con los datos del Usuario o false si no está
     */
    public static function obtenGestor($user) {
        $tabla = 'gestores';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para obtener el registro
        $sql = "SELECT * FROM $tabla WHERE usuario = :usuario";
        //preparamos la consulta(defensa de inyección de código)
        $consulta = $dbh->prepare($sql);//objeto PDO
        //creamos el array de parámetros
        $parametros = array(':usuario'=>$user);
        //devolvemos el resultado con el registro
        if($consulta->execute($parametros)){
            $dbh = null;
            $row = $consulta->fetch(PDO::FETCH_ASSOC);
            return $row;
        }else {
            $dbh = null;
            return false;
        }
    }

}
