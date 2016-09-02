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
$servicio->register("MiFuncion",array('miparametro' => 'xsd:string'),array('return' => 'xsd:sting'), $ns );



//Declaracion de funcion php
//PASO3
function MiFuncion($miparametro){
    $resultado="Mi Parametro recibido es:" .$miparametro;
    return $resultado;
}



//Agregar Linea
//Valida la información enviada por post y que sea igual y no tenga cambios
$HTTP_RAW_POST_DATA=isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

//service ejecutara lo que se envia
$servicio->service($HTTP_RAW_POST_DATA);




?>