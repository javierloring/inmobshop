<?php
require_once 'BD.php';

/**
 * las instacias de esta clase representan a las fotos de la aplicación.
 *
 * @author JavierLoring
 */
class Fotos{
    //se crean atributos protegidos para que se puedan heredar pero no sean
    //accesibles desde fuera de la clase

    protected $id_fotos;
    protected $urls_textos_fotos;

    //para instanciar un registro de la aplicación le pasamos un array, con los
    //datos de los campos de un registro de la tabla contratos (de la base de
    //datos inmobshop) y los asignamos a los atributos de la instancia.

    /**
     * crea una instancia de un registro
     * @param array $row los atributos del contrato
     */
    public function __construct($row) {
        $this->id_fotos = $row['id_fotos'];
        $this->urls_textos_fotos = $row['urls_textos_fotos'];
    }

    //creamos los métodos get necesarios para acceder a los atributos de la
    //instancia

    public function getIdFotos() {
        return $this->id_fotos;
    }
    public function getUrlsTextosFotos() {
        return $this->urls_textos_fotos;
    }

    //creamos los métodos set necesarios para dar valores a los atributos de la
    //instancia

    public function setIdFotos($id_fotos){
        $this->id_fotos = $id_fotos;
    }
    public function setUrlsTextosFotos($urls_textos_fotos){
        $this->urls_textos_fotos = $urls_textos_fotos;
    }

//--------------------------------------------------------------------------
    //registramos una cadena JSON con las rutas y los comentarios d elas fotos del anuncio
    public static function insertaFotos($json){
        $tabla = 'fotos';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para insertar el registro
        $sql = "INSERT INTO $tabla (
        	urls_texto_fotos
        ) VALUES (
            :urls_textos_fotos
        )";

    }
