<?php

include_once 'lib/nusoap.php';


// creación de un objeto libreria nusoap
$servicio = new soap_server();

//namespace
$ns = "urn:miserviciowsdl";


//configuración del Servicio
//configureWSDL("nomwebservice","nombreNamespace")
$servicio->configureWSDL("MiPrimerServicioWeb",$ns);

//parametros de configuracion
$servicio->schemaTargetNamespace =$ns; // espacio de nombre destino
//PASO2
//creacion de metodo register
// register("nombre_funcionResultado","parametroEntrada_tipo","valor_retorno","namespace")
$servicio->register("MiFuncion2",array('num1' => 'xsd:integer','num2' => 'xsd:integer'),array('return' => 'xsd:string'), $ns );



//Declaracion de funcion php
//PASO3
function MiFuncion2($num1,$num2){
    $suma= $num1 + $num2;
    $resultado="La Suma de los Números es:" .$suma;
    return $resultado;
}



//Agregar Linea
//Valida la información enviada por post y que sea igual y no tenga cambios
$HTTP_RAW_POST_DATA=isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

//service ejecutara lo que se envia
$servicio->service($HTTP_RAW_POST_DATA);




?>