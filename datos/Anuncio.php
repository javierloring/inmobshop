<?php
#var_dump($_SERVER['PHP_SELF']);
require_once 'BD.php';
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

    public static function obtener_fotos_anuncio($id_anuncio){
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para obtener el campo del atributo fotos para
        //el id_anuncio pasado
        $sql = "SELECT urls_textos_fotos
        FROM (anuncios as a) join (fotos as f)
        WHERE a. id_fotos = f. id_fotos
        AND id_anuncio = :id_anuncio";
        //preparamos la consulta
        $consulta = $dbh->prepare($sql);
        //vinculamos los parámetros
        $parametros = array(':id_anuncio' => $id_anuncio);
        //ejecutamos la consulta
        $consulta->execute($parametros);
        //extraemos el resultado de la consulta
        $registro = $consulta->fetch(PDO::FETCH_OBJ);
        //devolvemos el registro
        return $registro;
    }

    public static function obtenNumeroAnunciosId($id_usuario, $tipo_usuario){
        $id_tipo_usuario = 'id_' . $tipo_usuario;
        $tabla_usuario = $tipo_usuario . 'es';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para obtener todos los anuncios del usuario
        $sql = "SELECT COUNT(*), $id_tipo_usuario
        FROM anuncios
        WHERE $id_tipo_usuario =
            (SELECT $id_tipo_usuario
                FROM $tabla_usuario
                WHERE id_usuario = :id_usuario)";
        //preparamos la consulta
        $consulta = $dbh->prepare($sql);
        //vinculamos los parámetros
        $parametros = array(':id_usuario' => $id_usuario);
        //ejecutamos la consulta
        $consulta->execute($parametros);
        //extraemos el resultado de la consulta
        $registro = $consulta->fetch();
        //devolvemos el registro
        return $registro;
    }
    //todos los anuncios del usuario vinculados al contrato
    //necesitamos mostrar: id_anuncio, localización,
    //tipo operación, precio de la operación y tipo de inmueble
    public static function obtenAnunciosContrato($id_usuario, $tipo_usuario, $id_contrato){
        $id_tipo_usuario = 'id_' . $tipo_usuario;
        $tabla_usuario = $tipo_usuario . 'es';
        //------------------------------------------------------conectamos 1VEZ
        $dbh1 = BD::conectar();
        //creamos la sentencia SQL para obtener todos los anuncios del usuario
        //que contiene una construcción
        $sql1 = "SELECT * FROM (((((anuncios as a) join (inmuebles as i))
        join (contratos as c)) join (operaciones as o))
        join (construcciones as cs))
        join (servicios as s)
        WHERE (a.id_contrato = c.id_contrato)
        and a.id_inmueble = i.id_inmueble
        and a.id_operacion = o.id_operacion
        and (i.id_construccion = cs.id_construccion)
        and (c.id_servicio = s.id_servicio)
        and (a.id_contrato = :id_contrato
        and a.$id_tipo_usuario = (SELECT $id_tipo_usuario
        FROM $tabla_usuario where id_usuario = :id_usuario))";
        //preparamos la consulta
        $consulta = $dbh1->prepare($sql1);
        //vinculamos los parámetros
        $parametros = array(':id_usuario' => $id_usuario,
                            ':id_contrato' => $id_contrato);
        //ejecutamos la consulta
        $consulta->execute($parametros);
        //extraemos el resultado de la consulta
        $registro_construccion = $consulta->fetchAll();
        $dbh1 = null;
        //------------------------------------------------------conectamos 2VEZ
        //creamos la sentencia SQL para obtener todos los anuncios del usuario
        //que contiene un un terreno
        $dbh2 = BD::conectar();
        $sql2 = "SELECT * FROM (((((anuncios as a) join (inmuebles as i))
        join (contratos as c)) join (operaciones as o))
        join (terrenos as t))
        join (servicios as s)
        WHERE (a.id_contrato = c.id_contrato)
        and a.id_inmueble = i.id_inmueble
        and a.id_operacion = o.id_operacion
        and (i.id_terreno = t.id_terreno)
        and (c.id_servicio = s.id_servicio)
        and (a.id_contrato = :id_contrato
        and a.$id_tipo_usuario = (SELECT $id_tipo_usuario
        FROM $tabla_usuario where id_usuario = :id_usuario))";
        //preparamos la consulta
        $consulta = $dbh2->prepare($sql2);
        //vinculamos los parámetros
        $parametros = array(':id_usuario' => $id_usuario,
                            ':id_contrato' => $id_contrato);
        //ejecutamos la consulta
        $consulta->execute($parametros);
        //extraemos el resultado de la consulta
        $registro_terreno = $consulta->fetchAll();
        $dbh2 = null;

        //devolvemos el registro
        if(count($registro_construccion) != 0){
            return $registro_construccion;
        }else{
            return $registro_terreno;
        }
    }
    //obtener tipo terreno de un anuncio concido su id
    public static  function obtenTipoTerreno($id_anuncio){
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para obtener todos los anuncios del usuario
        $sql ="SELECT tipo_suelo
        FROM ((anuncios as a) join (inmuebles as i)) join (terrenos as t)
        WHERE a.id_inmueble = i.id_inmueble AND i.id_terreno = t.id_terreno
        AND id_anuncio = :id_anuncio";
        //preparamos la consulta
        $consulta = $dbh->prepare($sql);
        //vinculamos los parámetros
        $parametros = array(':id_anuncio' => $id_anuncio);
        //ejecutamos la consulta
        $consulta->execute($parametros);
        //extraemos el resultado de la consulta
        $registro = $consulta->fetch();
        #var_dump($registro);
        //devolvemos el registro
        return $registro;
    }
    //obtener tipo terreno de un anuncio concido su id
    public static  function obtenTipoConstruccion($id_anuncio){
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para obtener todos los anuncios del usuario
        $sql ="SELECT tipo_construccion
        FROM ((anuncios as a) join (inmuebles as i)) join (construcciones as c)
        WHERE a.id_inmueble = i.id_inmueble AND i.id_construccion = c.id_construccion
        AND id_anuncio = :id_anuncio";
        //preparamos la consulta
        $consulta = $dbh->prepare($sql);
        //vinculamos los parámetros
        $parametros = array(':id_anuncio' => $id_anuncio);
        //ejecutamos la consulta
        $consulta->execute($parametros);
        //extraemos el resultado de la consulta
        $registro = $consulta->fetch();
        #var_dump($registro);
        //devolvemos el registro
        return $registro;
    }
    //obtener tipo terreno de un anuncio concido su id
    public static  function obtenTipoVivienda($id_anuncio){
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para obtener todos los anuncios del usuario
        $sql ="SELECT tipo_vivienda
        FROM (((anuncios as a) join (inmuebles as i)) join (construcciones as c)) join (viviendas as v)
        WHERE a.id_inmueble = i.id_inmueble
        AND i.id_construccion = c.id_construccion
        AND c.id_vivienda = v.id_vivienda
        AND id_anuncio = :id_anuncio";
        //preparamos la consulta
        $consulta = $dbh->prepare($sql);
        //vinculamos los parámetros
        $parametros = array(':id_anuncio' => $id_anuncio);
        //ejecutamos la consulta
        $consulta->execute($parametros);
        //extraemos el resultado de la consulta
        $registro = $consulta->fetch();
        #var_dump($registro);
        //devolvemos el registro
        return $registro;
    }
    //registramos un anuncio
    public static function registraAnuncio($fecha_anuncio, $estado, $id_operacion, $id_inmueble,
    	$descripcion, $id_profesional, $id_particular, $id_fotos){
        $tabla = 'anuncios';
        //conectamos a la base de datos
        $dbh = BD::conectar();
        //creamos la sentencia SQL para insertar el registro
        $sql = "INSERT INTO $tabla (
            fecha_anuncio,
    		estado,
    		id_operacion,
    		id_inmueble,
    		descripcion,
    		id_profesional,
    		id_particular,
    		id_fotos
        ) VALUES (
            :fecha_anuncio,
    		:estado,
    		:id_operacion,
    		:id_inmueble,
    		:descripcion,
    		:id_profesional,
    		:id_particular,
    		:id_fotos
        )";
        //creamos los parámetros
        $parametros = array(':fecha_anuncio' => $fecha_anuncio,
                            ':estado' => $estado,
                            ':id_operacion' => $id_operacion,
                            ':id_inmueble' =>  $id_inmueble,
                            ':descripcion' => $descripcion,
                            ':id_profesional' => $id_profesional,
                            ':id_particular' => $id_particular,
                            ':id_fotos' => $id_fotos
    					);
        $insert = $dbh->prepare($sql);
        $insert->execute($parametros);//true o false
        //devolvemos el último id autoincrementado
        return $dbh->lastInsertId();
    }
}
