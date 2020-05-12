<?php
#var_dump($_SERVER['PHP_SELF']);
class BD {
    /**
     * realiza una conexión PDO a la base de datos inmobshop y aplica el
     * modo de errores PDOException
     * @return PDO
     */
    public static function conectar() {
        $dsn = 'mysql:host=localhost;dbname=inmobshop';
        $user  = 'root';
        $pass = '';
        $ops = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        try {
            //creamos una instancia PDO con los valores definidos
            $dbh = new PDO($dsn, $user, $pass, $ops);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $dbh;
    }

    /**
     * obtener los registros de una tabla de la base de datos conectada
     * @param  string   $tabla  nombre de la tabla
     * @return array    $result array de registros de la consulta
     */
    public static function obtenerRegistros($tabla) {
        //creamos la conexión
        $dbh = BD::conectar();
        //creamos la consulta
        $sql = "SELECT * FROM ${tabla}";
        $consulta = $dbh->prepare($sql);
        $consulta->execute();
        //extraemos todos los registros (filas) del conjunto de resultados
        $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
        //devolvemos los registros como array asociativo
        return $result;
    }

    /**
     * devuelve el nº de registros de la tabla de la BD
     * @param  string   $tabla  nombre de la tabla
     * @return integer  $result número de filas de la tabla
     */
    public static function numeroRegistros($tabla) {
        //obtenemos los registros
        $registros = obtenerRegistros($tabla);
        //los contamos
        $num_registros = count($registros);
        //devolvemos los registros
        return $num_registros;
    }

    /**
     * insertar un registro de una tabla de la base de datos
     * @param  string   $tabla      nombre de la tbla
     * @param  array    $campos     nombres de los campos
     * @param  array    $valores    valores para los campos
     * @return boolean              si se insertó el registro
     */
    public static function insertaRegistro($tabla, $campos, $valores) {
        //creamos la conexión
        $dbh = BD::conectar();
        //creamos el texto de la sentencia SQL
        $text1 = '';
        foreach ($campos as $campo) {
            $text1 .= $campo.', ';
        }
        $text1 = substr($text1, 0, strlen($text1)-2);
        $text2 = '';
        foreach ($campos as $campo) {
            $text2 .= ':'.$campo.', ';
        }
        $text2 = substr($text2, 0, strlen($text2)-2);
        //componemos la sentencia
        $sql = "INSERT INTO $tabla (${text1}) VALUES (${text2})";
        //preparamos la consulta
        $consulta = $dbh->prepare($sql);
        //creamos el array de parámetros
        $parametros = [];
        foreach ($campos as $campo) {
            $parametros[':'.$campo] = array_shift($valores);
        }
        //devolvemos el resultado de ejecutar la inserción
        return $consulta->execute($parametros);
    }

    /**
     * actualizar un registro de una tabla de la base de datos conectada apartir
     * de un conjunto de valores
     * @param  string   $tabla      nombre de la tbla
     * @param  array    $campos     nombres de los campos
     * @param  array    $valores    valores para los campos
     * @return boolean              si se actualizó el registro
     */
    public static function actualizaRegistro($tabla, $campos, $valores) {
        //creamos la conexión
        $dbh = BD::conectar();
        //creamos el texto de la sentencia SQL
        $text1 = '';
        $text2 = '';
        //el id no se actualiza
        $camp_id = $campos[0];
        foreach ($campos as $campo) {
            if ($campo == $cod)continue;
            $text2 .= $campo.' = :'.$campo.', ';
        }
        $text2 = substr($text2, 0, strlen($text2)-2);
        //componemos la sentencia
        //el parámetro para el id
        $val_id = $valores[0];
        $sql = "UPDATE $tabla set $text2 where $camp_id = ':'$val_id";
        //preparamos la consulta
        $consulta = $dbh->prepare($sql);
        //creamos el array de parámetros
        $parametros = [];
        foreach ($campos as $campo) {
            $parametros[':'.$campo] = array_shift($valores);
        }
        //devolvemos el resultado de ejecutar la inserción
        return $consulta->execute($parametros);
    }
}
