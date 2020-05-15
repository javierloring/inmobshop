<?php
require_once 'BD.php';
/**
 * Las instancias de esta clase representan los anunciantes profesionales la
 * aplicación.
 *
 * @author JavierLoring
 */
class Profesional{

    //se crean atributos protegidos par aque se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_profesional;
    protected $nombre_comercial;
    protected $nif;
    protected $direccion;
    protected $url_logo;
    protected $id_usuario;

    //para crear un Usuario profesional le pasamos un array obtenido de los campos
    //de un registro de la tabla profesionales

    /**
     * crea una instancia de un anunciante profesional
     * @param array $row $id_profesional, $nombre_comercial, $nif, $direccion, $id_usuario
     */
    public function __construct($row) {
        $this->id_profesional = $row['id_profesional'];
        $this->nombre_comercial = $row['nombre_comercial'];
        $this->nif = $row['nif'];
        $this->direccion = $row['direccion'];
        $this->url_logo = $row['url_logo'];
        $this->id_usuario = $row['id_usuario'];
    }

    //no vamos a modificar los valores pero sí necesitamos acceder a ellos por
    //lo que creamos los métodos get necesarios.

    public function getIdProfesinoal() {
        return $this->id_profesional;
    }

    public function getNombreComercial() {
        return $this->nombre_comercial;
    }

    public function getNif() {
        return $this->nif;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getUrlLogo() {
        return $this->url_logo;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    //creamos los métodos set necesarios para dar valores a los atributos de la
    //instancia

    public function setIdProfesional($id_profesional){
        $this->id_profesional = $id_profesional;
    }
    public function setNombreComercial($nombre_comercial) {
        $this->nombre_comercial = $nombre_comercial;
    }
    public function setNif($nif){
        $this->nif = $nif;
    }
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
    public function setUrlLogo($url_logo) {
        $this->url_logo = $url_logo;
    }
    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

//------------------------------------------------------------------------------
    public static function registraProfesional($nif, $id_usuario) {
        $tabla = 'profesionales';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para insertar el registro
        $sql = "INSERT INTO $tabla (
            `nif`,
            `id_usuario`
        ) VALUES (
            :nif,
            :id_usuario
        )";
        //creamos los parámetros
        $parametros = array(':nif' => $nif,
                        ':id_usuario' => $id_usuario
                    );
        $insert = $dbh->prepare($sql);
        $insert->execute($parametros);//true o false
        return $insert;
    }
    /**
     * comprueba si un usauario es profesional
     * @param  int   $id_usuario el id de usuario
     * @return bool  true si es profesional, false si no lo es
     */
    public static function esProfesional($id_usuario) {
        $tabla = 'profesionales';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //consultamos si existe este id de usuarios
        $sql = "SELECT *
        FROM $tabla
        WHERE id_usuario = ':id_usuario'";
        //creamos el $parametro
        $parametro = array(':id_usuario' => $id_usuario);
        $consulta = $dbh->query($sql);
        $consulta->execute($parametro);
        if($registro = $consulta->fetch()) {
            return true;
        }else {
            return false;
        }
    }
}
