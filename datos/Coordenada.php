<?php
require_once 'BD.php';
/**
 * Las instancias de esta clase representan las coordenadas de la aplicación.
 *
 * @author JavierLoring
 */
class Coordenada{

    //se crean atributos protegidos par aque se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_coordenada;
    protected $longitud;
    protected $latitud;

    //para crear una coordenada le pasamos un array obtenido de los campos
    //de un registro de la tabla particulares

    /**
     * crea una instancia de una coordenada
     * @param array $row
     */
    public function __construct($row) {
        $this->id_coordenada = $row['id_coordenada'];
        $this->longitud = $row['longitud'];
        $this->latitud = $row['latitud'];
    }

    //no vamos a modificar los valores pero sí necesitamos acceder a ellos por
    //lo que creamos los métodos get necesarios.

    public function getIdCoordenada() {
        return $this->id_coordenada;
    }

    public function getLongitud() {
        return $this->longitud;
    }

    public function getLatitud() {
        return $this->latitud;
    }

    //creamos los métodos set necesarios para dar valores a los atributos de la
    //instancia

    public function setIdCoordenada($id_coordenada){
        $this->id_coordenada = $id_coordenada;
    }
    public function setLongitud($longitud){
        $this->longitud = $longitud;
    }
    public function setLatitud($latitud) {
        $this->latitud = $latitud;
    }

//------------------------------------------------------------------------------
    //insertamos una operación
    public static function registraCoordenada($longitud, $latitud){
        $tabla = 'coordenadas';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para insertar el registro
        $sql = "INSERT INTO $tabla (
        	longitud,
            latitud
        ) VALUES (
            :longitud,
            :latitud
        )";
        //creamos los parámetros
        $parametros = array(':longitud' => $longitud,
                            ':latitud' => $latitud);
        $insert = $dbh->prepare($sql);
        $insert->execute($parametros);//true o false
        //devolvemos el último id autoincrementado
        return $dbh->lastInsertId();
    }

}
