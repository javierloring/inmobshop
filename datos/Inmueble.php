<?php
require_once 'BD.php';
/**
 * las instacias de esta clase representan a los INMUEBLES de la aplicación.
 *
 * @author JavierLoring
 */
class Inmueble{
    //se crean atributos protegidos para que se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_inmueble;
    protected $via;
    protected $num_via;
    protected $cod_postal;
    protected $provincia;
    protected $localidad;
    protected $id_terreno;
    protected $id_construccion;
    protected $id_coordenadas;

    //para instanciar un servicio de la aplicación le pasamos un array, con los
    //datos de los campos de un registro de la tabla usuarios (de la base de
    //datos inmobshop) y los asignamos a los atributos de la instancia.

    /**
     * crea una instancia de un servicio
     * @param array $row los atributos del servicio
     */
    public function __construct($row) {
        $this->id_inmueble = $row['id_inmueble'];
        $this->via = $row['via'];
        $this->num_via = $row['num_via'];
        $this->cod_prostal = $row['cod_prostal'];
        $this->provincia = $row['provincia'];
        $this->localidad = $row['localidad'];
        $this->id_terreno = $row['id_terreno'];
        $this->id_construccion = $row['id_construccion'];
        $this->id_coordenadas = $row['id_coordenadas'];
    }

    //creamos los métodos get necesarios para acceder a los atributos de la
    //instancia

    //PENDIENTE GETTERS

    //creamos los métodos set necesarios para dar valores a los atributos de la
    //instancia

    //PENDIENTES SETTERES
//--------------------------------------------------------------------------
//registramos un inmueble
public static function registraInmueble($via, $num_via, $cod_postal, $provincia,
	$localidad, $id_terreno, $id_construccion, $id_coordenadas){
    $tabla = 'inmuebles';
    //conectamos a la base de datos
    $dbh = BD::conectar();
    //creamos la sentencia SQL para insertar el registro
    $sql = "INSERT INTO $tabla (
        via,
		numero_via,
		cod_postal,
		provincia,
		localidad,
		id_terreno,
		id_construccion,
		id_coordenadas
    ) VALUES (
		:via,
		:numero_via,
		:cod_postal,
		:provincia,
		:localidad,
		:id_terreno,
		:id_construccion,
		:id_coordenadas
    )";
    //creamos los parámetros
    $parametros = array(':via' => $via,
                        ':numero_via' => $num_via,
                        ':cod_postal' => $cod_postal,
                        ':provincia' =>  $provincia,
                        ':localidad' => $localidad,
                        ':id_terreno' => $id_terreno,
                        ':id_construccion' => $id_construccion,
                        ':id_coordenadas' => $id_coordenadas
					);
    $insert = $dbh->prepare($sql);
    $insert->execute($parametros);//true o false
    //devolvemos el último id autoincrementado
    return $dbh->lastInsertId();
}

}
