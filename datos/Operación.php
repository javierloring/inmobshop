<?php
require_once 'BD.php';
/**
 * Las instancias de esta clase representan las operaciones de la aplicación.
 *
 * @author JavierLoring
 */
class Operacion{

    //se crean atributos protegidos par aque se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_operacion;
    protected $tipo_operacion;
    protected $precio;
    protected $moneda;
    protected $tiempo;

    //para crear una operacion le pasamos un array obtenido de los campos
    //de un registro de la tabla particulares

    /**
     * crea una instancia de una operacion
     * @param array $row
     */
    public function __construct($row) {
        $this->id_operacion = $row['id_operacion'];
        $this->tipo_operacion = $row['tipo_operacion'];
        $this->precio = $row['precio'];
        $this->moneda = $row['moneda'];
        $this->tiempo = $row['tiempo'];
    }

    //no vamos a modificar los valores pero sí necesitamos acceder a ellos por
    //lo que creamos los métodos get necesarios.

    public function getIdOperacion() {
        return $this->id_operacion;
    }

    public function getTipoOperacion() {
        return $this->tipo_operacion;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getMoneda() {
        return $this->moneda;
    }

    public function getTiempo() {
        return $this->tiempo;
    }

    //creamos los métodos set necesarios para dar valores a los atributos de la
    //instancia

    public function setIdOperacion($id_operacion){
        $this->id_operacion = $id_operacion;
    }
    public function setTipoOperacion($tipo_operacion){
        $this->dni = $tipo_operacion;
    }
    public function setPrecio($precio) {
        $this->precio = $precio;
    }
    public function setMoneda($moneda) {
        $this->moneda = $moneda;
    }

    public function setTiempo($tiempo) {
        $this->tiempo = $tiempo;
    }
//------------------------------------------------------------------------------
    //insertamos una operación
    public static function registraOperacion($tipo_operacion, $precio, $tiempo){
        $tabla = 'operaciones';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para insertar el registro
        $sql = "INSERT INTO $tabla (
        	tipo_operacion,
            precio,
            tiempo
        ) VALUES (
            :tipo_operacion,
            :precio,
            :tiempo
        )";
        //creamos los parámetros
        $parametros = array(':tipo_operacion' => $tipo_operacion,
                            ':precio' => $precio,
                            ':tiempo' => $tiempo);
        $insert = $dbh->prepare($sql);
        $insert->execute($parametros);//true o false
        //devolvemos el último id autoincrementado
        return $dbh->lastInsertId();
    }

}
