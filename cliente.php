<?php
include_once 'lib/nusoap.php';


    
//namespace
$ns = "http://localhost/ws/servicio.php";

// nusoap_client(direccion_servicio,false)
$cliente = new nusoap_client("http://localhost/ws/servicio.php?wsdl",'wsdl');

//Recibe el codigo en formato POST
$codigo=$_POST["idCurso"];




//obtención del valor que se recibe del servicio
//call("nom_funcion_servicio",paramtros)
$cursos = $cliente->call('listaCursos',
                         //Array q mandamos                    
                            array("codigo" => $codigo),
                            'uri:'.$ns,
                            'uri:'.$ns.'/listaCursos'
                           );


//Si se encuentra algun error en el cliente se muestra un error
// Si no se puede consumir el servicio
// Si no hay problemas en el cliente muestra un mensaje
if($cliente->fault){
   // echo "Error";
    print_r($cursos);
}
else{
    // Muestra el error que tiene para consumir el servicio
    if($cliente->getError()){
        echo '<b>Error:'.$cliente->getError().'</b>';
    }
    else{
        // No hay error en el consumo del servicio ni en el cliente
        print_r($cursos);
    }
}


?>