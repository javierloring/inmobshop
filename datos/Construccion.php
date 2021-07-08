<?php
require_once 'BD.php';
/**
 * Las instancias de esta clase representan las construcciones de la aplicación.
 *
 * @author JavierLoring
 */
class Construccion{

    //se crean atributos protegidos par aque se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_construccion;
    protected $tipo_construccion;
    protected $sup_util;
    protected $sup_construida;
    protected $unidad;
    protected $id_vivienda;

    //para crear una construccion le pasamos un array obtenido de los campos
    //de un registro de la tabla terrenos

    /**
     * crea una instancia de un terreno
     * @param array $row
     */
    public function __construct($row) {
        $this->id_construccion = $row['id_construccion'];
        $this->tipo_construccion = $row['tipo_construccion'];
        $this->sup_util = $row['sup_util'];
        $this->sup_construida = $row['sup_construida'];
        $this->unidad = $row['unidad'];
        $this->id_vivienda = $row['id_vivienda'];
    }

    //no vamos a modificar los valores pero sí necesitamos acceder a ellos por
    //lo que creamos los métodos get necesarios.

    //PENDIENTE GETTERS
    //creamos los métodos set necesarios para dar valores a los atributos de la
    //instancia

    //PENDIENTE SETTERS
//------------------------------------------------------------------------------
    //insertamos una terreno
    public static function registraConstruccion($tipo_construccion,
		$sup_util, $sup_construida, $unidad, $id_vivienda){
        $tabla = 'construcciones';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para insertar el registro
        $sql = "INSERT INTO $tabla (
        	tipo_construccion,
            sup_util,
            sup_construida,
            unidad,
            id_vivienda
        ) VALUES (
			:tipo_construccion,
            :sup_util,
            :sup_construida,
            :unidad,
            :id_vivienda
        )";
        //creamos los parámetros
        $parametros = array(':tipo_construccion' => $tipo_construccion,
                            ':sup_util' => $sup_util,
                            ':sup_construida' => $sup_construida,
                            ':unidad' => $unidad,
                            ':id_vivienda' => $id_vivienda);
        $insert = $dbh->prepare($sql);
        $insert->execute($parametros);//true o false
        //devolvemos el último id autoincrementado
        return $dbh->lastInsertId();
    }

}
