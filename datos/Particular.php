<?php
require_once 'BD.php';
/**
 * Las instancias de esta clase representan los anunciantes particulares la
 * aplicación.
 *
 * @author JavierLoring
 */
class Particular{

    //se crean atributos protegidos par aque se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_particular;
    protected $nif;
    protected $direccion;
    protected $id_usuario;

    //para crear un Usuario particular le pasamos un array obtenido de los campos
    //de un registro de la tabla particulares

    /**
     * crea una instancia de un anunciante particular
     * @param array $row $id_particular, $nif, $direccion, $id_usuario
     */
    public function __construct($row) {
        $this->id_particular = $row['id_particular'];
        $this->dni = $row['dni'];
        $this->direccion = $row['direccion'];
        $this->id_usuario = $row['id_usuario'];
    }

    //no vamos a modificar los valores pero sí necesitamos acceder a ellos por
    //lo que creamos los métodos get necesarios.

    public function getId_particular() {
        return $this->id_particular;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    //creamos los métodos set necesarios para dar valores a los atributos de la
    //instancia

    public function setIdParticular($id_particular){
        $this->id_particular = $id_particular;
    }
    public function setDni($dni){
        $this->dni = $dni;
    }
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

//------------------------------------------------------------------------------
    public static function registraParticular($dni, $id_usuario) {
        $tabla = 'particulares';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para insertar el registro
        $sql = "INSERT INTO $tabla (
            `dni`,
            `id_usuario`
        ) VALUES (
            :dni,
            :id_usuario
        )";
        //creamos los parámetros
        $parametros = array(':dni' => $dni,
                        ':id_usuario' => $id_usuario
                    );
        $insert = $dbh->prepare($sql);
        $insert->execute($parametros);//true o false
        return $insert;
    }
}
