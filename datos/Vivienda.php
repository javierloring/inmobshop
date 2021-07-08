<?php
require_once 'BD.php';
/**
 * las instacias de esta clase representan a las viviendas de la aplicación.
 *
 * @author JavierLoring
 */
class Vivienda{
    //se crean atributos protegidos para que se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_vivienda;
    protected $tipo_vivienda;
    protected $num_habitaciones;
    protected $num_banyos;
    protected $estado_vivienda;
    protected $equipamiento;
    protected $orientacion;
    protected $ascensor;
    protected $arm_empotrados;
    protected $calefaccion;
    protected $aire_acond;
    protected $terraza;
    protected $balcon;
    protected $trastero;
    protected $plaza_garaje;
    protected $piscina_propia;
    protected $urbanizacion;
    protected $piscina_comun;
    protected $zonas_verdes;
    protected $id_piso;

    //para instanciar un servicio de la aplicación le pasamos un array, con los
    //datos de los campos de un registro de la tabla usuarios (de la base de
    //datos inmobshop) y los asignamos a los atributos de la instancia.

    /**
     * crea una instancia de un servicio
     * @param array $row los atributos del servicio
     */
    public function __construct($row) {
        $this->id_vivienda = $row['id_vivienda'];
        $this->tipo_vivienda = $row['tipo_vivienda'];
        $this->num_habitaciones = $row['num_habitaciones'];
        $this->num_banyos = $row['num_banyos'];
        $this->estado_vivienda = $row['estado_vivienda'];
        $this->equipamiento = $row['equipamiento'];
        $this->orientacion = $row['orientacion'];
        $this->ascensor = $row['ascensor'];
        $this->arm_empotrados = $row['arm_empotrados'];
        $this->calefaccion = $row['calefaccion'];
        $this->aire_acond = $row['aire_acond'];
        $this->terraza = $row['terraza'];
        $this->balcon = $row['balcon'];
        $this->trastero = $row['trastero'];
        $this->plaza_garaje = $row['plaza_garaje'];
        $this->piscina_propia = $row['piscina_propia'];
        $this->urbanizacion = $row['urbanizacion'];
        $this->piscina_comun = $row['piscina_comun'];
        $this->zonas_verdes = $row['zonas_verdes'];
        $this->id_piso = $row['id_piso'];
    }

    //creamos los métodos get necesarios para acceder a los atributos de la
    //instancia

    public function getIdVivienda() {
        return $this->id_vivienda;
    }
    public function getTipoVivienda() {
        return $this->tipo_vivienda;
    }
    public function getNumHabitaciones() {
        return $this->num_habitaciones;
    }
    public function getNUmBanyos() {
        return $this->num_banyos;
    }
    public function getEstadoVivienda() {
        return $this->estado_vivienda;
    }
    public function getEquipamiento() {
        return $this->equipamiento;
    }
    public function getOrientacion() {
        return $this->orientacion;
    }
    public function getAscensor() {
        return $this->ascensor;
    }
    public function getArmEmpotrados() {
        return $this->arm_empotrados;
    }
    public function getCalefaccion() {
        return $this->calefaccion;
    }
    public function getAireAcond() {
        return $this->aire_acond;
    }
    public function getTerraza() {
        return $this->terraza;
    }
    public function getBalcon() {
        return $this->balcon;
    }
    public function getTrastero() {
        return $this->trastero;
    }
    public function getPlazaGaraje() {
        return $this->plaza_garaje;
    }
    public function getPiscinaPropia() {
        return $this->piscina_propia;
    }
    public function getUrbanización() {
        return $this->urbanizacion;
    }
    public function getPiscinaComun() {
        return $this->piscina_comun;
    }
    public function getZonasVerdes() {
        return $this->zonas_verdes;
    }
    public function getIdVivienda() {
        return $this->id_vivienda;
    }

    //creamos los métodos set necesarios para dar valores a los atributos de la
    //instancia
    //PENDIENTE SETTERS

    //--------------------------------------------------------------------------
    //insertamos una terreno
    public static function registraVivienda(
        $tipo_vivienda, $num_habitaciones, $num_banyos, $estado_vivienda,
        $equipamiento, $orientacion, $ascensor, $arm_empotrados, $calefaccion,
        $aire_acond, $terraza, $balcon, $trastero, $plaza_garaje, $piscina_propia,
        $urbanizacion, $piscina_comun, $zonas_verdes, $id_piso){
        $tabla = 'viviendas';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para insertar el registro
        $sql = "INSERT INTO $tabla (
            tipo_vivienda,
            num_habitaciones,
            num_banyos,
            estado_viv,
            equipamiento,
            orientacion,
            ascensor,
            arm_empotrados,
            calefaccion,
            aire_acond,
            terraza,
            balcon,
            trastero,
            plaza_garaje,
            piscina_propia,
            urbanizacion,
            piscina_comun,
            zonas_verdes,
            id_piso
        ) VALUES (
            :tipo_vivienda,
            :num_habitaciones,
            :num_banyos,
            :estado_viv,
            :equipamiento,
            :orientacion,
            :ascensor,
            :arm_empotrados,
            :calefaccion,
            :aire_acond,
            :terraza,
            :balcon,
            :trastero,
            :plaza_garaje,
            :piscina_propia,
            :urbanizacion,
            :piscina_comun,
            :zonas_verdes,
            :id_piso
        )";
        //creamos los parámetros
        $parametros = array(
            ':tipo_vivienda' => $tipo_vivienda,
            ':num_habitaciones' => $num_habitaciones,
            ':num_banyos' => $num_banyos,
            ':estado_vivienda' => $estado_vivienda,
            ':equipamiento' => $equipamiento,
            ':orientacion' => $orientacion,
            ':ascensor' => $ascensor,
            ':arm_empotrados' => $arm_empotrados,
            ':calefaccion' => $calefaccion,
            ':aire_acond' => $aire_acond,
            ':terraza' => $terraza,
            ':balcon' => $balcon,
            ':trastero' => $trastero,
            ':plaza_garaje' => $plaza_garaje,
            ':piscina_propia' => $piscina_propia,
            ':urbanizacion' => $urbanizacion,
            ':piscina_comun' => $piscina_comun,
            ':zonas_verdes' => $zonas_verdes,
            ':id_piso' =>$id_piso
        );
        $insert = $dbh->prepare($sql);
        $insert->execute($parametros);//true o false
        //devolvemos el último id autoincrementado
        return $dbh->lastInsertId();
    }
}