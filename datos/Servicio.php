<?php
require_once 'BD.php';
/**
 * las instacias de esta clase representan a los servicios de la aplicación.
 *
 * @author JavierLoring
 */
class Servicio{
    //se crean atributos protegidos para que se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_servicio;
    protected $nombre_servicio;
    protected $destinatario;
    protected $nivel_servicio;
    protected $descripcion;
    protected $num_anuncios;
    protected $num_dias;
    protected $precio;
    protected $moneda;
    protected $estado_revision;
    protected $fecha_alta;
    protected $estado_vigencia;
    protected $fecha_baja;
    protected $id_gestor;

    //para instanciar un servicio de la aplicación le pasamos un array, con los
    //datos de los campos de un registro de la tabla usuarios (de la base de
    //datos inmobshop) y los asignamos a los atributos de la instancia.

    /**
     * crea una instancia de un servicio
     * @param array $row los atributos del servicio
     */
    public function __construct($row) {
        $this->id_servicio = $row['id_servicio'];
        $this->nombre_servicio = $row['nombre_servicio'];
        $this->destinatario = $row['destinatario'];
        $this->nivel_servicio = $row['nivel_servicio'];
        $this->descripcion = $row['descripcion'];
        $this->num_anuncios = $row['num_anuncios'];
        $this->num_dias = $row['num_dias'];
        $this->precio = $row['precio'];
        $this->estado_revision = $row['estado_revision'];
        $this->fecha_alta = $row['fecha_alta'];
        $this->estado_vigencia = $row['estado_vigencia'];
        $this->fecha_baja = $row['fecha_baja'];
        $this->id_gestor = $row['id_gestor'];
    }

    //creamos los métodos get necesarios para acceder a los atributos de la
    //instancia

    public function getIdServicio() {
        return $this->id_servicio;
    }
    public function getNombreServicio() {
        return $this->nombre_servicio;
    }
    public function getDestinatario() {
        return $this->destinatario;
    }
    public function getNivelServicio() {
        return $this->nivel_servicio;
    }
    public function getDescripcion() {
        return $this->descripcion;
    }
    public function getNumAnuncios() {
        return $this->num_anuncios;
    }
    public function getNumDias() {
        return $this->num_dias;
    }
    public function getPrecio() {
        return $this->precio;
    }
    public function getMoneda() {
        return $this->moneda;
    }
    public function getEstadoRevision() {
        return $this->estado_revision;
    }
    public function getFechaAlta() {
        return $this->fecha_alta;
    }
    public function getEstadoVigencia() {
        return $this->estado_vigencia;
    }
    public function getFechaBaja() {
        return $this->fecha_baja;
    }
    public function getIdGestor() {
        return $this->id_gestor;
    }

    //creamos los métodos set necesarios para dar valores a los atributos de la
    //instancia

    public function setIdServicio($id_servicio){
        $this->id_servicio = $id_servicio;
    }
    public function setNombreServicio($nombre_servicio){
        $this->nombre_servicio = $nombre_servicio;
    }
    public function setDestinatario($destinatario) {
        $this->destinatario = $destinatario;
    }
    public function setNivelServicio($nivel_servicio) {
        $this->nivel_servicio = $nivel_servicio;
    }
    public function setDescripcion($descripcion) {
        $this->descripcion =$descripcion;
    }
    public function setNumAnuncios($num_anuncios) {
        $this->num_anuncios = $num_anuncios;
    }
    public function setNumDias($num_dias) {
        $this->num_dias = $num_dias;
    }
    public function setPrecio($precio) {
        $this->precio = $precio;
    }
    public function setMoneda($moneda) {
        $this->moneda = $moneda;
    }
    public function setEstadoRevision($estado_revision) {
        $this->estado_revision = $estado_revision;
    }
    public function setFechaAlta($fecha_alta) {
        $this->fecha_alta = $fecha_alta;
    }
    public function setEstadoVigencia($estado_vigencia) {
        $this->estado_vigencia = $estado_vigencia;
    }
    public function setFechaBaja( $fecha_baja) {
        $this->fecha_baja =  $fecha_baja;
    }
    public function setIdGestor( $id_gestor) {
        $this->id_gestor =  $id_gestor;
    }
//--------------------------------------------------------------------------

    public static function obtenServicios($destinatario){
        $tabla = 'servicios';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para seleccionar los servicios
        $sql = "SELECT * FROM $tabla
        WHERE destinatario = 'todos' OR destinatario = :destinatario";
        //preparamos la consulta(defensa de inyección de código)
        $consulta = $dbh->prepare($sql);//objeto PDO
        //creamos el array de parámetros
        $parametros = array(':destinatario'=>$destinatario);
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
