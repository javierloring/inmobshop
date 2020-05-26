<?php
require_once 'BD.php';
require_once 'Anuncio.php';
require_once 'Contrato.php';
require_once 'Informe.php';
require_once 'Servicio.php';
require_once 'Usuario.php';
/**
 * las instacias de esta clase representan a los registros de la aplicación.
 *
 * @author JavierLoring
 */
class Registro{
    //se crean atributos protegidos para que se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_registro;
    protected $fecha_registro;
    protected $texto_registro;
    protected $id_servicio;
    protected $id_informe;
    protected $id_contrato;
    protected $id_anuncio;


    //para instanciar un registro de la aplicación le pasamos un array, con los
    //datos de los campos de un registro de la tabla contratos (de la base de
    //datos inmobshop) y los asignamos a los atributos de la instancia.

    /**
     * crea una instancia de un registro
     * @param array $row los atributos del contrato
     */
    public function __construct($row) {
        $this->id_registro = $row['id_registro'];
        $this->fecha_registro = $row['fecha_registro'];
        $this->texto_registro = $row['texto_registro'];
        $this->id_servicio = $row['id_servicio'];
        $this->id_informe = $row['id_informe'];
        $this->id_contrato = $row['id_contrato'];
        $this->id_anuncio = $row['id_anuncio'];
    }

    //creamos los métodos get necesarios para acceder a los atributos de la
    //instancia

    public function getIdRegistro() {
        return $this->id_registro;
    }
    public function getFechaRegistro() {
        return $this->fecha_registro;
    }
    public function getTextoRegistro() {
        return $this->texto_registro;
    }
    public function getIdServicio() {
        return $this->id_servicio;
    }
    public function getIdInforme() {
        return $this->id_informe;
    }
    public function getIdContrato() {
        return $this->id_contrato;
    }
    public function getIdAnuncio() {
        return $this->id_anuncio;
    }

    //creamos los métodos set necesarios para dar valores a los atributos de la
    //instancia

    public function setIdRegistro($id_registro){
        $this->id_registro = $id_registro;
    }
    public function setFechaRegistro($fecha_registro){
        $this->fecha_registro = $fecha_registro;
    }
    public function setTextoRegistro($texto_registro) {
        $this->texto_registro = $texto_registro;
    }
    public function setIdServicio($id_servicio) {
        $this->id_servicio = $id_servicio;
    }
    public function setIdInforme($id_informe) {
        $this->id_informe =$id_informe;
    }
    public function setIdContrato($id_contrato) {
        $this->id_contrato = $id_contrato;
    }
    public function setIdAnuncio($id_anuncio) {
        $this->id_anuncio = $id_anuncio;
    }

//--------------------------------------------------------------------------
    //creamos un registro de alta de contrato
    public static function registroAltaContrato($id_contrato, $id_usuario, $tipo_usuario, $nombre_servicio){
        $usuario_row = Usuario::obtenUsuarioId($id_usuario);
        $tipo_usu_upper = strtoupper($tipo_usuario);
        $nombre = $usuario_row->getNombre();
        $fecha_registro = date('Y-m-d H:i:s');
        $texto_fecha = substr($fecha_registro, 0, 10);
        $texto_hora = substr($fecha_registro, 11);
        $texto_registro = 'ALTA-CONTRATO:' . $nombre_servicio . ';USUARIO-' . $tipo_usu_upper .
            ':' . $nombre . ';FECHA-HORA:' . $fecha_registro . ':' . $texto_fecha . ' a las ' .
            $texto_hora;
        $tabla = 'registros';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para insertar el registro
        $sql = "INSERT INTO $tabla (
            fecha_registro,
            texto_registro,
            id_servicio,
            id_informe,
            id_contrato,
            id_anuncio)
        VALUES (
            :fecha_registro,
            :texto_registro,
            NULL,
            NULL,
            :id_contrato,
            NULL)";
            //creamos los parámetros
            $parametros = array(
                ':fecha_registro' =>$fecha_registro,
                ':texto_registro' => $texto_registro,
                ':id_contrato' => $id_contrato
            );
            $insert = $dbh->prepare($sql);
            $registro = $insert->execute($parametros);//número de registros afectados
            return $registro;
    }
}
