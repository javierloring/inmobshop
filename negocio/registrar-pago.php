<?php
require_once '../datos/Contrato.php';
if(isset($_POST['id_contrato'])){
    $id_contrato = $_POST['id_contrato'];
    //tenemos que realizar una asignación de 1 al campo pagado de un contrato
    //un UPDATE de contrato
    $registro = Contrato::pagarContrato($id_contrato);
    echo $registro; //número de registros afectados
}
