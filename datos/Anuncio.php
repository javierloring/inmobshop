<?php
#var_dump($_SERVER['PHP_SELF']);
require 'BD.php';
class Anuncio {
    //se crean atributos protegidos para que se puedan heredar pero no sean
    //accesibles desde fuera de la clase
    protected $id_anuncio;
    protected $fecha_anuncio;
    protected $estado;
    protected $id_operacion;
    protected $id_inmueble;
    protected $descripcion;
    protected $id_profesional;
    protected $id_particular;
    protected $id_contrato;
    protected $id_gestor;
    protected $id_fotos;
    //para instanciar un anuncio de la aplicación le pasamos un array, con los
    //datos de los campos de un registro de la tabla usuarios (de la base de
    //datos inmobshop) y los asignamos a los atributos de la instancia.
    /**
     * crea una instancia de un anuncio
     * @param array $row los atributos del anuncio
     */
    public function __construct($row) {
        $this->id_anuncio = $row['id_anuncio'];
        $this->fecha_anuncio = $row['fecha_anuncio'];
        $this->estado = $row['estado'];
        $this->id_operacion = $row['id_operacion'];
        $this->id_inmueble = $row['id_inmueble'];
        $this->descripcion = $row['descripcion'];
        $this->id_profesional = $row['id_profesional'];
        $this->id_particular = $row['id_particular'];
        $this->id_contrato = $row['id_contrato'];
        $this->id_gestor = $row['id_gestor'];
        $this->id_fotos = $row['id_fotos'];
    }

    //creamos los métodos get necesarios para acceder a los atributos de la
    //instancia

    public function getIdAnuncio() {
        return $this->id_anuncio;
    }
    public function getFechaAnuncio() {
        return $this->fecha_anuncio;
    }
    public function getEstado() {
        return $this->estado;
    }
    public function getIdOperacion() {
        return $this->id_operacion;
    }
    public function getIdInmueble() {
        return $this->id_inmueble;
    }
    public function getDescripcion() {
        return $this->descripcion;
    }
    public function getIdProfesional() {
        return $this->id_profesional;
    }
    public function getIdParticular() {
        return $this->id_particular;
    }
    public function getIdContrato() {
        return $this->id_contrato;
    }
    public function getIdGestor() {
        return $this->id_gestor;
    }
    public function getIdFotos() {
        return $this->id_fotos;
    }

    //creamos los métodos set necesarios para dar valores a los atributos de la
    //instancia

    public function setIdAnuncio($id_anuncio) {
        $this->id_anuncio = $id_anuncio;
    }
    public function setFechaAnuncio($fecha_anuncio) {
        $this->fecha_anuncio = $fecha_anuncio;
    }
    public function setEstado($estado) {
        $this->estado = $estado;
    }
    public function setIdOperacion($id_operacion) {
        $this->id_operacion = $id_operacion;
    }
    public function setIdInmueble($id_inmueble) {
        $this->id_inmueble = $id_inmueble;
    }
    public function setDescripcion($descripcion) {
        $this->$this->descripcion = $descripcion;
    }
    public function setIdProfesional($id_profesional) {
        $this->$this->id_profesional = $id_profesional;
    }
    public function setIdParticular($id_particular) {
        $this->id_particular = $id_particular;
    }
    public function setIdContrato($id_contrato) {
        $this->id_contrato = $id_contrato;
    }
    public function setIdGestor($id_gestor) {
        $this->id_gestor = $id_gestor;
    }
    public function setIdFotos($id_fotos) {
        $this->id_fotos = $id_fotos;
    }
    //--------------------------------------------------------------------------

    public static function obtenNivel5_portada() {
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para obtener los registros
        $sql = "SELECT id_anuncio, UNIX_TIMESTAMP(fecha_anuncio) as fecha_anuncio,
        estado, urls_textos_fotos, localidad, precio
        FROM ((`anuncios` as a join `fotos` as f) join (`operaciones` as o)) join (`inmuebles` as i)
        WHERE a.id_fotos = f.id_fotos
        AND a.id_operacion = o.id_operacion
        AND	a.id_inmueble = i.id_inmueble
        AND a.id_anuncio IN
        ( SELECT `id_anuncio`
            FROM `anuncios`as a join (`contratos`as c join `servicios`as s )
            WHERE c.id_servicio = s.id_servicio
            AND a.id_contrato = c.id_contrato
            AND s.nivel_servicio = 3)";
        //preparamos la consulta
        $resultado = $dbh->query($sql);//objeto PDO
        $nivel5 = $resultado->fetchAll();

        //sólo nos interesa el id, la url y el comentario de la foto principal
        // del anuncio, el precio y la localidad
        foreach ($nivel5 as $key => $value) {
            if($value['estado'] == 'aprobado') {
                $id_anuncio = $value['id_anuncio'];
                $fecha_anuncio = $value['fecha_anuncio'];
                $fotos = explode(',', $value['urls_textos_fotos']);
                $fotos = explode(':', $fotos[0]);//obviamos el comentario
                $url_foto_anuncio = $fotos[0];
                $localidad = $value['localidad'];
                $precio = $value['precio'];
                $anuncios_n5[] = ['id_anuncio' => $id_anuncio,
                                'fecha_anuncio' => $fecha_anuncio,
                                'url_foto_anuncio' => $url_foto_anuncio,
                                'localidad' => $localidad,
                                'precio' => $precio];
            }
        }
        #var_dump($anuncios_n5);
        return $anuncios_n5;
    }

    public static function actualiza_fecha_anuncio($id_anuncio, $fecha_anuncio) {
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para obtener los registros
        $sql = "UPDATE `anuncios`
        SET fecha_anuncio = :fecha_anuncio
        WHERE id_anuncio = :id_anuncio";
        $consulta = $dbh->prepare($sql);
        try {
            $dbh->beginTransaction();
            $parametros = array(':fecha_anuncio'=>$fecha_anuncio,
                                ':id_anuncio'=>$id_anuncio);
            $actualizacion = $consulta->execute($parametros);//número de registros afectados
            $dbh->commit();
        } catch (\Exception $e) {
            throw ($e);
        } finally {
            $statement = null;
            $objPDO = null;
        }
        return $actualizacion;
    }
}
