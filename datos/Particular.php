<?php
namespace datos\Particular;
/**
 * Las instancias de esta clase representan los anunciantes particulares la
 * aplicación.
 *
 * @author JavierLoring
 */
use datos\DB;
use datos\Usuario;

class Particular extends Usuario {

    //se crean atributos protegidos par aque se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_particular;
    protected $nif;
    protected $id_usuario;

    //para crear un Usuario particular le pasamos un array obtenido de los campos
    //de un registro de la tabla particulares y de un registro de la tabla usuarios
    //indicado por la clave ajena id_usuario

    /**
     * crea una instancia de un anunciante particular
     * @param array $row [$id_particular, $nif, $usuario[...]]
     */
    public function __construct($row) {
        parent::__construct($row['id_usuario']);
        $this->id_particular = $row['id_particular'];
        $this->nif = $row['nif'];
    }

    //no vamos a modificar los valores pero sí necesitamos acceder a ellos por
    //lo que creamos los métodos get necesarios.

    public function getId_particular() {
        return $this->id_particular;
    }

    public function getNif() {
        return $this->nif;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function muestra() {
        print "<p>" . $this->nif . "</p>";
    }
//------------------------------------------------------------------------------
/**
 * devuelve un registro con el usuario cuyos datos se han pasado
 * @param  string $id_usuario  id del usuario pasado
 * @return array  $row   array con los datos del particular o false si no está
 */
public static function getUsuario($id_usuario) {
    $tabla = 'particulares';
    $dbh = DB::conectar();
    //creamos la sentencia SQL para obtener el registro
    $sql = "SELECT * FROM $tabla WHERE id_usuario = :id_usuario";
    //preparamos la consulta
    $consulta = $dbh->prepare($sql);//objeto PDO
    //creamos el array de parámetros
    $parametros = array(':id_usuario'=>$id_usuario);
    //devolvemos el resultado con el registro
    if($consulta->execute($parametros)){
        $row = $consulta->fetch(PDO::FETCH_ASSOC);
        return $row;
    }else {
        return false;
    }
}

/**
 * devuelve si el usuario con usuario y contraseña pasados es un particular
 *
 * @param  string $user     el nombre de usuario introducido
 * @param  string $pass     la contraseña de usuario introducida
 * @return boolean          Si está o no registrado como particular
 */
public static function esParticular($user, $pass) {
    if(Usuario::registrado($user, $pass)) {
        $id_usuario = Usuario::getId($user, $pass);
    }
    return Usuario::getUsuario($id_usuario);
}
//------------------------------------------------------------------------------
}
