<?php
require_once 'BD.php';
/**
 * Las instancias de esta clase representan los demandantes de la
 * aplicación.
 *
 * @author JavierLoring
 */
class Demandante{

    //se crean atributos protegidos par aque se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_demandante;
    protected $id_usuario;

    //para crear un demandante le pasamos un array obtenido de los campos
    //de un registro de la tabla demandante

    /**
     * crea una instancia de un anunciante particular
     * @param array $row $id_particular, $nif, $direccion, $id_usuario
     */
    public function __construct($row) {
        $this->id_demandante = $row['id_demandante'];
        $this->id_usuario = $row['id_usuario'];
    }

    //no vamos a modificar los valores pero sí necesitamos acceder a ellos por
    //lo que creamos los métodos get necesarios.

    public function getIdDemandante() {
        return $this->id_demandante;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    //creamos los métodos set necesarios para dar valores a los atributos de la
    //instancia

    public function setIdDemandante($id_demandante){
        $this->id_demandante = $id_demandante;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

//------------------------------------------------------------------------------
    /**
     * registra un nuevo usuario demandante a partir de su id de usuario
     * @param  int      $id_usuario el id de usuario
     * @return int      $insert     el número de registros afectados
     *
     */
    public static function registraDemandante($id_usuario) {
        $tabla = 'demandantes';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para insertar el registro
        $sql = "INSERT INTO $tabla (
            `id_usuario`
        ) VALUES (
            :id_usuario
        )";
        //creamos los parámetros
        $parametros = array(':id_usuario' => $id_usuario);
        $insert = $dbh->prepare($sql);
        $insert->execute($parametros);//true o false
        return $insert;
    }
    /**
     * comprueba si un usauario es demandante
     * @param  int   $id_usuario el id de usuario
     * @return bool  true si es demandante, false si no lo es
     */
    public static function esDemandante($id_usuario) {
        $tabla = 'demandantes';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //consultamos si existe este id de usuarios
        $sql = "SELECT * FROM `demandantes`
        WHERE id_usuario = ':id_usuario'";
        //creamos el $parametro
        $parametro = array(':id_usuario' => $id_usuario);
        $consulta = $dbh->query($sql);
        $consulta->execute($parametro);
        if($registro = $consulta->fetch()) {
            return true;
        }else {
            return false;
        }
    }
}
