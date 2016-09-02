<?php
include_once 'lib/nusoap.php';

// nusoap_client(direccion_servicio,false)
$cliente = new nusoap_client("http://localhost/ws/servicio2.php",false);

$num1=10;
$num2=80;


//Asiganción de los datos  que se enviaran

$parametros = array('num1' => $num1,'num2' => $num2);

//obtención del valor que se recibe del servicio
//call("nom_funcion_servicio",paramtros)
$respuesta = $cliente->call("MiFuncion2",$parametros);

print_r($respuesta);

?>