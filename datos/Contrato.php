<?php
require_once 'BD.php';
require_once 'Servicio.php';
require_once 'Particular.php';
require_once 'Profesional.php';
/**
 * las instacias de esta clase representan a los contratos de la aplicación.
 *
 * @author JavierLoring
 */
class Contrato{
    //se crean atributos protegidos para que se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_contrato;
    protected $pagado;
    protected $fecha_contrato;
    protected $id_servicio;
    protected $id_profesional;
    protected $id_particular;


    //para instanciar un contrato de la aplicación le pasamos un array, con los
    //datos de los campos de un registro de la tabla contratos (de la base de
    //datos inmobshop) y los asignamos a los atributos de la instancia.

    /**
     * crea una instancia de un servicio
     * @param array $row los atributos del contrato
     */
    public function __construct($row) {
        $this->id_contrato = $row['id_contrato'];
        $this->pagado = $row['pagado'];
        $this->fecha_contrato = $row['fecha_contrato'];
        $this->id_servicio = $row['id_servicio'];
        $this->id_profesional = $row['id_profesional'];
        $this->id_particular = $row['id_particular'];
    }

    //creamos los métodos get necesarios para acceder a los atributos de la
    //instancia

    public function getIdContrato() {
        return $this->id_contrato;
    }
    public function getPagado() {
        return $this->pagado;
    }
    public function getFechaContrato() {
        return $this->fecha_contrato;
    }
    public function getIdServicio() {
        return $this->id_servicio;
    }
    public function getIdProfesional() {
        return $this->id_profesional;
    }
    public function getIdParticular() {
        return $this->id_particular;
    }

    //creamos los métodos set necesarios para dar valores a los atributos de la
    //instancia

    public function setIdContrato($id_contrato){
        $this->id_contrato = $id_contrato;
    }
    public function setPagado($pagado){
        $this->pagado = $pagado;
    }
    public function setFechaContrato($fecha_contrato) {
        $this->fecha_contrato = $fecha_contrato;
    }
    public function setIdServicio($id_servicio) {
        $this->id_servicio = $id_servicio;
    }
    public function setIdProfesional($id_profesional) {
        $this->id_profesional =$id_profesional;
    }
    public function setIdParticular($id_particular) {
        $this->id_particular = $id_particular;
    }

//--------------------------------------------------------------------------
    //obtiene los contratos que tiene en vigor un usuario
    public static function obtenContratos($id_usuario, $tipo_usuario){
        $tabla = 'contratos';
        $tabla_tipo_usuario = $tipo_usuario .'es';
        $identificador = 'id_' . $tipo_usuario;
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para seleccionar los contratos
        $sql = "SELECT * FROM contratos join servicios
        WHERE contratos.id_servicio = servicios.id_servicio
        AND $identificador = (
            SELECT $identificador
            FROM $tabla_tipo_usuario
            WHERE id_usuario = :id_usuario) ORDER BY fecha_contrato ASC";
        //preparamos la consulta(defensa de inyección de código)
        $consulta = $dbh->prepare($sql);//objeto PDO
        //creamos el array de parámetros
        $parametros = array(':id_usuario' => $id_usuario);
        //devolvemos el resultado con el registro
        if($consulta->execute($parametros)){
            $dbh = null;
            $row = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }else {
            $dbh = null;
            return false;
        }
    }

    //registra un contrato conocidos el id_usuario, el tipo_usuario y el nombre_servicio
    public static function registraContrato($id_usuario, $tipo_usuario, $nombre_servicio){
        $tabla = 'contratos';
        //obtenemos la fecha de hoy
        $fecha_contrato = date('Y-m-d');
        //necesitamos conocer el id del servicio a contratar. lo obtenemos de la
        //clase  Servicio
        $id_servicio = Servicio::obtenIdDeNombre($nombre_servicio);//valor id o false
        //necesitamos el id del tipo de usuario, lo obtenemos de la clase Profesonal
        if($tipo_usuario == 'profesional'){
            $id_profesional = Profesional::obtenIdProfesionalIdUsuario($id_usuario);//array con id
            $id_particular = null;
        }else if($tipo_usuario == 'particular'){
            $id_particular = Particular::obtenIdParticularIdUsuario($id_usuario);//array con id
            $id_profesional = null;
        }
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para insertar el contrato
        $sql = "INSERT INTO $tabla (pagado, fecha_contrato, id_servicio, id_profesional, id_particular)
        VALUES (:pagado, :fecha_contrato, :id_servicio, :id_profesional, :id_particular)";
        //creamos los parámetros
        $parametros = array(
            ':pagado' => false,
            ':fecha_contrato' => $fecha_contrato,
            ':id_servicio' => $id_servicio,
            ':id_profesional' => $id_profesional,
            ':id_particular' => $id_particular
        );
        $insert = $dbh->prepare($sql);
        $insert->execute($parametros);//número de registros afectados
        return $dbh->lastInsertId();
    }

    //contrato pendiente de pago de un usuario
    public static function contratoPendiente($id_usuario, $tipo_usuario){
        $tabla_tipo_usuario = $tipo_usuario .'es';
        $identificador = 'id_' . $tipo_usuario;
        $tabla = 'contratos';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //buscamos si hay contrato pendiente de pago para el usuario
        $sql = "SELECT * FROM $tabla
        WHERE pagado = 0 AND
        $identificador = (SELECT $identificador
        FROM $tabla_tipo_usuario
        WHERE id_usuario = :id_usuario)";
        //creamos el array de parámetros
        $parametros = array(':id_usuario' => $id_usuario);
        $consulta = $dbh->prepare($sql);
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

    //actualizamos el campo pagado de 0 a 1
    public static function pagarContrato($id_contrato){
        $tabla = 'contratos';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para insertar el contrato
        $sql = "UPDATE $tabla SET pagado = 1 WHERE id_contrato = :id_contrato";
        //creamos los parámetros
        $parametros = array(':id_contrato' => $id_contrato);
        $update = $dbh->prepare($sql);
        $registro = $update->execute($parametros);//número de registros afectados
        return $registro;
    }
}
