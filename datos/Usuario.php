<?php
require 'BD.php';
/**
 * las instacias de esta clase representan a los usuarios de la aplicación.
 *
 * @author JavierLoring
 */
class Usuario{

    //se crean atributos protegidos para que se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_usuario;
    protected $usuario;
    protected $password;
    protected $nombre;
    protected $email;
    protected $last_session;
    protected $activado;
    protected $telefono;
    protected $token;
    protected $token_password;
    protected $password_request;

    //para instanciar un usuario de la aplicación le pasamos un array, con los
    //datos de los campos de un registro de la tabla usuarios (de la base de
    //datos inmobshop) y los asignamos a los atributos de la instancia.

    /**
     * crea una instancia de un usuario
     * @param array $row los atributos del usuario
     */
    public function __construct($row) {
        $this->id_usuario = $row['id_usuario'];
        $this->usuario = $row['usuario'];
        $this->password = $row['password'];
        $this->nombre = $row['nombre'];
        $this->email = $row['email'];
        $this->last_session = $row['last_session'];
        $this->activado = $row['activado'];
        $this->telefono = $row['telefono'];
        $this->token = $row['token'];
        $this->token_password = $row['token_password'];
        $this->password_request = $row['password_request'];
    }

    //creamos los métodos get necesarios para acceder a los atributos de la
    //instancia

    public function getIdUsuario() {
        return $this->id_usuario;
    }
    public function getUsuario() {
        return $this->usuario;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getLastSession() {
        return $this->last_session;
    }
    public function getActivado() {
        return $this->activado;
    }
    public function getTelefono() {
        return $this->telefono;
    }
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
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setUltimaSesion($last_session) {
        $this->last_session = $last_session;
    }
    public function setActivado($activado) {
        $this->activado = $activado;
    }
    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
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

    public static function registraUsuario($usuario, $password, $email, $activado, $telefono, $token) {
        $tabla = 'usuarios';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para insertar el registro
        $sql = "INSERT INTO $tabla (
        	`usuario`,
        	`password`,
        	`email`,
        	`activado`,
        	`telefono`,
        	`token`
        ) VALUES (
            :usuario,
            :password,
            :email,
            :activado,
            :telefono,
            :token
        )";
        //creamos los parámetros
        $parametros = array(':usuario' => $usuario,
                        ':password' => $password,
                        ':email' => $email,
                        ':activado' => $activado,
                        ':telefono' => $telefono,
                        ':token' => $token,
                    );
        $insert = $dbh->prepare($sql);
        $insert->execute($parametros);//true o false
        $id = $dbh->lastInsertId();
        $registro['insert'] = $insert;
        $registro['id'] = $id;
        return $registro;
    }


    /**
     * método auxiliar que devuelve un registro con el Usuario cuyo usuario se
     * ha pasado para comprobar si el Usuario está registrado
     * @param  string $user  nombre de usuario pasado
     * @return array  $row   array con los datos del Usuario o false si no está
     */
    public static function obtenUsuario($user) {
        $tabla = 'usuarios';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para obtener el registro
        $sql = "SELECT * FROM $tabla WHERE usuario = :usuario";
        //preparamos la consulta(defensa de inyección de código)
        $consulta = $dbh->prepare($sql);//objeto PDO
        //creamos el array de parámetros
        $parametros = array(':usuario'=>$user);
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
    /**
     * método auxiliar que devuelve un registro con el Usuario cuyo email se
     * ha pasado para comprobar si el email pasado ya existe
     * @param  string $email  nombre de usuario pasado
     * @return array  $row   array con los datos del Usuario o false si no está
     */
    public static function obtenEmail($email) {
        $tabla = 'usuarios';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para obtener el registro
        $sql = "SELECT * FROM $tabla WHERE email = :email";
        //preparamos la consulta(defensa de inyección de código)
        $consulta = $dbh->prepare($sql);//objeto PDO
        //creamos el array de parámetros
        $parametros = array(':email'=>$email);
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
    /**
     * devuelve si el usuario, con usuario y contraseña pasados, está registrado
     * en la tabla usuarios
     * @param  string $user     el nombre de usuario introducido
     * @param  string $pass     la contraseña de usuario introducida
     * @return boolean          Si está o no registrado
     */
    public static function registrado($user, $pass) {
        $usuario = Usuario::obtenUsuario($user);
        if(isset($usuario)){
            return password_verify($pass, $usuario['password']);
        }else {
            return false;
        }
    }
    /**
     * devuelve el id de un usuario a partir del usuario y contraseña
     * @param  [type] $user [description]
     * @return boolean       [description]
     */
    public static function obtenId($user, $pass) {
        if(Usuario::registrado($user, $pass)){
            return $usuario['id_usuario'];
        }else {
            return false;
        }
    }
}
