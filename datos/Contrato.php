<?php
require_once 'BD.php';
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
        AND $identificador IN (
            SELECT $identificador
            FROM particulares
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
}
