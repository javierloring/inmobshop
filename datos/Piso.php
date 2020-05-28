<?php
require_once 'BD.php';
/**
 * Las instancias de esta clase representan los pisos la
 * aplicación.
 *
 * @author JavierLoring
 */
class Piso{

    //se crean atributos protegidos par aque se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_piso;
    protected $tipo_piso;
    protected $planta;
    protected $fachada;

    //para crear un Usuario particular le pasamos un array obtenido de los campos
    //de un registro de la tabla pisos

    /**
     * crea una instancia de un piso particular
     * @param array $row
     */
    public function __construct($row) {
        $this->id_piso = $row['id_piso'];
        $this->tipo_piso = $row['tipo_piso'];
        $this->planta = $row['planta'];
        $this->fachada = $row['fachada'];
    }

    //no vamos a modificar los valores pero sí necesitamos acceder a ellos por
    //lo que creamos los métodos get necesarios.

    public function getIdPiso() {
        return $this->id_piso;
    }

    public function getTipoPiso() {
        return $this->tipo_piso;
    }

    public function getPlanta() {
        return $this->planta;
    }

    public function getFachada() {
        return $this->fachada;
    }

    //creamos los métodos set necesarios para dar valores a los atributos de la
    //instancia

    public function setIdPiso($id_piso){
        $this->id_piso = $id_piso;
    }
    public function seTipoPiso($tipo_piso){
        $this->tipo_piso = $tipo_piso;
    }
    public function setPlanta($planta) {
        $this->planta = $planta;
    }
    public function setFachada($fachada) {
        $this->fachada = $fachada;
    }
//------------------------------------------------------------------------------

//insertamos un piso
public static function Piso::registraPiso($tipo_piso, $planta, $fachada){
    $tabla = 'terrenos';
    //conectamos a la base de datos
    $dbh = BD::conectar();
    //creamos la sentencia SQL para insertar el registro
    $sql = "INSERT INTO $tabla (
        tipo_piso,
        planta,
        fachada,
    ) VALUES (
        :tipo_piso,
        :planta,
        :fachada
    )";
    //creamos los parámetros
    $parametros = array(':tipo_piso' => $tipo_piso,
                        ':planta' => $planta,
                        ':fachada' => $fachada);
    $insert = $dbh->prepare($sql);
    $insert->execute($parametros);//true o false
    //devolvemos el último id autoincrementado
    return $dbh->lastInsertId();
}
