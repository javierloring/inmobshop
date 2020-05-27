<?php
require_once 'BD.php';
/**
 * Las instancias de esta clase representan los terrenos de la aplicación.
 *
 * @author JavierLoring
 */
class Terreno{

    //se crean atributos protegidos par aque se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_terreno;
    protected $tipo_suelo;
    protected $superfice;
    protected $unidad;
    protected $agua;
    protected $luz;

    //para crear una operacion le pasamos un array obtenido de los campos
    //de un registro de la tabla particulares

    /**
     * crea una instancia de una operacion
     * @param array $row
     */
    public function __construct($row) {
        $this->id_terreno = $row['id_terreno'];
        $this->tipo_suelo = $row['tipo_suelo'];
        $this->superficie = $row['superficie'];
        $this->unidad = $row['unidad'];
        $this->agua = $row['agua'];
        $this->luz = $row['luz'];
    }

    //no vamos a modificar los valores pero sí necesitamos acceder a ellos por
    //lo que creamos los métodos get necesarios.

    public function getIdTerreno() {
        return $this->$id_terreno;
    }

    public function getTipoSuelo() {
        return $this->tipo_suelo;
    }

    public function getSuperficie() {
        return $this->superficie;
    }

    public function geUnidad() {
        return $this->unidad;
    }

    public function getAgua() {
        return $this->agua;
    }

    public function getLuz() {
        return $this->luz;
    }

    //creamos los métodos set necesarios para dar valores a los atributos de la
    //instancia

    public function setIdIdTerreno($id_terreno){
        $this->id_terreno = $id_terreno;
    }
    public function setTipoSuelo($tipo_suelo){
        $this->tipo_suelo = $tipo_suelo;
    }
    public function setSuperficie($superficie) {
        $this->superficie = $superficie;
    }
    public function setUnidad($unidad) {
        $this->unidad = $unidad;
    }

    public function setAgua($agua) {
        $this->agua = $agua;
    }

    public function setLuz($luz) {
        $this->luz = $luz;
    }
//------------------------------------------------------------------------------
    //insertamos una operación
    public static function registraTerreno($tipo_suelo, $superficie, $unidad, $agua, $luz){
        $tabla = 'terrenos';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para insertar el registro
        $sql = "INSERT INTO $tabla (
        	tipo_suelo,
            superficie,
            unidad,
            agua,
            luz
        ) VALUES (
            :tipo_suelo,
            :superficie,
            :unidad,
            :agua,
            :luz
        )";
        //creamos los parámetros
        $parametros = array(':tipo_suelo' => $tipo_suelo,
                            ':superficie' => $superficie,
                            ':unidad' => $unidad,
                            ':agua' => $agua,
                            ':luz', => $luz);
        $insert = $dbh->prepare($sql);
        $insert->execute($parametros);//true o false
        //devolvemos el último id autoincrementado
        return $dbh->lastInsertId();
    }

}
