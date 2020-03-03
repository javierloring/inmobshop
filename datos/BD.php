<?php
class BD {
    /**
     * realiza una conexión PDO a la base de datos casashop y aplica el
     * modo de errores PDOException
     * @return PDO
     */
    public static function conectar() {
        $dsn = 'mysql:host=localhost;dbname=tienda';
        $user  = 'dwes';
        $pass = 'dwes';
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
     * obtener los registros de la tabla de la base de datos conectada
     * @param  PDO      $dbh    conexión a la base de datos
     * @param  string   $tabla  nombre de la tabla
     * @return array    $result array de registros de la consulta
     */
    public static function obtener_registros($dbh, $tabla, $tam_pag, $num_pag) {
        //mostramos la página deseada
        if ($num_pag == '') {
           	$inicio  = 0;
           	$num_pag = 1;
        }
        else {
           	$inicio = ($num_pag - 1) * $tam_pag;
        }
        //creamos la consulta
        $sql = "SELECT * FROM ${tabla} ORDER BY cod ASC LIMIT $inicio, $tam_pag";
        $consulta = $dbh->prepare($sql);
        $consulta->execute();
        //extraemos todos los registros (filas) del conjunto de resultados
        $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
        //devolvemos los registros
        return $result;
    }

    /**
     * devuelve el nº de registros de la tabla de la BD
     * @param  PDO      $dbh    conexión a la base de datos
     * @param  string   $tabla  nombre de la tabla
     * @return integer  $result número de filas de la tabla
     */
    public static function numero_registros($dbh, $tabla) {
        //creamos la consulta
        $sql = "SELECT * FROM ${tabla}";
        $consulta = $dbh->prepare($sql);
        $consulta->execute();
        //extraemos todos los registros (filas) del conjunto de resultados
        $result = $consulta->rowCount();
        //devolvemos los registros
        return $result;
    }
    /**
    * obtiene el código de los productos
    * @param  PDO      $dbh    conexión a la base de datos
    * @param  string   $tabla  nombre de la tabla
    * @return array    array con los campos cod de la tabla
    */
    public static function seleccionar_cod_productos($dbh, $tabla){
        $sql = "SELECT cod FROM $tabla";
        $resultado = $dbh->query($sql);
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * obtener_un_registro deseado de la base de datos conectada
     * @param  PDO      $dbh    conexión a la base de datos
     * @param  string   $tabla  nombre de la tabla
     * @param  string   $cod     valor del cod del registro
     * @return array    $row    registro buscado
     */
    public static function obtener_un_registro($dbh, $tabla, $cod) {
        //nos aseguramos que pasamos un valor no vacío como cod
        if($cod != ''){
            //creamos la sentencia SQL
            $sql = "SELECT * FROM $tabla WHERE cod = :cod";
            //preparamos la consulta
            $consulta = $dbh->prepare($sql);
            //creamos el array de parámetros
            $parametros = array(':cod'=>$cod);
        }
        //devolvemos el resultado con el registro
        $consulta->execute($parametros);
        //extraemos el registro solicitado
        $result = $consulta->fetch(PDO::FETCH_ASSOC);
        //devolvemos el registro
        return $result;
    }

    /**
     * borrar un registro de una tabla de la base de datos conectada
     * @param  PDO      $dbh        conexión a la base de datos
     * @param  string   $tabla      nombre de la tabla
     * @param  string   $cod        valor del cod del registro
     * @return boolean              si se borró el registro
     */
    public static function borrar_registro($dbh, $tabla, $cod) {
        //nos aseguramos que pasamos un valor entero como id
        if($cod != ''){
            //creamos la sentencia SQL
            $sql = "DELETE FROM $tabla WHERE cod = :cod";
            //preparamos la consulta
            $consulta = $dbh->prepare($sql);
            //creamos el array de parámetros
            $parametros = array(':cod'=>$cod);
        }
        //devolvemos el resultado del borrado número de registros afectados
        return $consulta->execute($parametros);
    }

    /**
     * insertar un registro de una tabla de la base de datos conectada
     * @param  PDO      $dbh        conexión a la base de datos
     * @param  string   $tabla      nombre de la tbla
     * @param  array    $campos     nombres de los campos
     * @param  array    $valores    valores para los campos
     * @return boolean              si se insertó el registro
     */
    public static function insertar_registro($dbh, $tabla, $campos, $valores) {
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
     * @param  PDO      $dbh        conexión a la base de datos
     * @param  string   $tabla      nombre de la tbla
     * @param  array    $campos     nombres de los campos
     * @param  array    $valores    valores para los campos
     * @return boolean              si se actualizó el registro
     */
    public static function actualizar_registro($dbh, $tabla, $campos, $valores) {
        //creamos el texto de la sentencia SQL
        $text1 = '';
        $text2 = '';
        //el codigo no se actualiza
        foreach ($campos as $campo) {
            if ($campo == 'cod')continue;
            $text2 .= $campo.' = :'.$campo.', ';
        }
        $text2 = substr($text2, 0, strlen($text2)-2);
        //componemos la sentencia
        $sql = "UPDATE $tabla set $text2 where cod = :cod";
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
