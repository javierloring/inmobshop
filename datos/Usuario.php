<?php
namespace datos\Usuario;
/**
 * las instacias de esta clase representan a los usuarios de la aplicación.
 *
 * @author JavierLoring
 */
use datos\DB;
class Usuario extends DB{

    //se crean atributos protegidos para que se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_usuario;
    protected $nombre;
    protected $password;
    protected $email;
    protected $telefono;
    protected $activado;
    protected $ultima_sesion;
    //-----------
    protected $token;
    protected $token_password;
    protected $password_request;

    //para instanciar un usuario de la aplicaón le pasamos un array, con los
    //datos de los campos de un registro de la tabla usuarios (de la base de
    //datos inmobshop) y los asignamos a los atributos de la instancia.

    /**
     * crea una instancia de un usuario
     * @param [type] $row [description]
     */
    public function __construct($row) {
        $this->id_usuario = $row['id_usuario'];
        $this->nombre = $row['nombre'];
        $this->password = $row['password'];
        $this->email = $row['email'];
        $this->telefono = $row['telefono'];
        $this->activado = $row['activado'];
        $this->ultima_sesion = $row['ultima_sesion'];
        //-----------
        $this->token = $row['token'];
        $this->token_password = $row['token_password'];
        $this->password_request = $row['password_request'];
    }

    //creamos los métodos get necesarios para acceder a los atributos de la
    //instancia

    public function getIdUsuario() {
        return $this->id_usuario;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getTelefono() {
        return $this->telefono;
    }
    public function getActivado() {
        return $this->activado;
    }
    public function getUltimaSesion() {
        return $this->ultima_sesion;
    }
    //---------------------------------
    public function getToken() {
        return $this->token;
    }
    public function getTokenPassword() {
        return $this->token_password;
    }
    public function getPasswordRequest() {
        return $this->password_request;
    }

    //creamos los métodos set necesarios para dar valores a los atributos de la
    //instancia

    public function setIdUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    public function setActivado($activado) {
        $this->activado = $activado;
    }
    public function setUltimaSesion($ultima_sesion) {
        $this->ultima_sesion = $ultima_sesion;
    }
    //--------------------------------------------------------------------------
    public function setToken($token) {
        $this->token = $token;
    }
    public function setTokenPassword($token_password) {
        $this->token_password = $token_password;
    }
    public function setPasswordRequest($password_request) {
        $this->password_request = $password_request;
    }
    //--------------------------------------------------------------------------
    /**
     * devuelve un registro con el usuario cuyos datos se han pasado
     * @param  string $user  nombre de usuario pasado
     * @param  string $pass  contraseña de usuario pasada
     * @return array  $row   array con los datos del usuario o false si no está
     */
    public static function getUsuario($user) {
        $tabla = 'usuarios';
        $dbh = DB::conectar();
        //creamos la sentencia SQL para obtener el registro
        $sql = "SELECT * FROM $tabla WHERE nombre_usuario = :user";
        //preparamos la consulta
        $consulta = $dbh->prepare($sql);//objeto PDO
        //creamos el array de parámetros
        $parametros = array(':user'=>$user);
        //devolvemos el resultado con el registro
        if($consulta->execute($parametros)){
            $row = $consulta->fetch(PDO::FETCH_ASSOC);
            return $row;
        }else {
            return false;
        }
    }
    /**
     * devuelve si el usuario con usuario y contraseña pasados esta registrado
     * en la tabla usuarios
     * @param  string $user     el nombre de usuario introducido
     * @param  string $pass     la contraseña de usuario introducida
     * @return boolean          Si está o no registrado
     */
    public static function registrado($user, $pass) {
        $usuario = Usuario::getUsuario($user);
        if(isset($usuario)){
            return password_verify($pass, $usuario['password']);
        }else {
            return false;
        }
    }
    /**
     * devuelve el id de un usuario
     * @param  [type] $user [description]
     * @return boolean       [description]
     */
    public static function get_id($user, $pass) {
        $usuario = Usuario::getUsuario($user);
        if(isset($usuario) && Usuario::registrado($user, $pass)){
            return $usuario['id_usuario']);
        }else {
            return false;
        }
    }
}
