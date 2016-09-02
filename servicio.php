<?php


//Incluyendo Nusoap
include_once 'lib/nusoap.php';

//Incluyendo archivo de conexion a la bd
require('conexion.php');
    

// creación de un objeto libreria nusoap
$servicio = new soap_server();

//namespace
$ns = "localhost/ws/servicio.php";


//configuración del Servicio
//configureWSDL("nomwebservice","nombreNamespace")
$servicio->configureWSDL("Consulta",$ns);

//parametros de configuracion
$servicio->schemaTargetNamespace =$ns; // espacio de nombre destino


//PASO2
//creacion de metodo register
// register("nombre_funcionResultado","parametroEntrada_tipo","valor_retorno","namespace")
$servicio->register
    ("listaCursos",  
     array('codigo' => 'xsd:string'),
     array('return' => 'xsd:string'),
     $ns
    );



//Declaracion de funcion php
//PASO3
function listaCursos($codigo){
    
    
    //Instancia a Conexion.php
    $conn=conectarse();
    
    
    if($codigo!=0)
    {
        $sql="select codigo,nombre from cursos where codigo='$codigo'";
    }
    
    else{
        
        $sql="select codigo,nombre from cursos";
    }
    
    //Respuesta a query de conexion
    $rs=mysql_query($sql,$conn);
    
    $i=0;
    $cadena=" <?xml version="1.0" encoding="UTF-8" standalone="yes"?>";
    
    //Si encuentra algun dato -> crea un xml
    if($rs!=null);
    {
        $cadena.="<cursos>";
        
        if(mysql_num_rows($rs)>0){
            while ($row = mysql_fetch_row($rs))
            {
                //Generar un XML
                $cadena="<curso>";
                $cadena="<br>";
                $cadena="<codigo>".$row[0]."</codigo>";
                $cadena="<br>";
                $cadena="<nombre>".$row[1]."</nombre>";
                $cadena="</curso>";
                $i++;
            
            }
        }   
        else{
            // Si no existe el dato en la bd 
                $cadena="<error>No hay datos".mysql_error()."</error>";
        
        }
        
        $cadena="</cursos>";

       
    }
     
      
    $respuesta=new soapval('return','xsd:string',$cadena);
    return $respuesta;
    
}



if(!isset($HTTP_RAW_POST_DATA))

//Agregar Linea
//Valida la información si se puede mostrar en php el archivo xml 
// y se envia por post al consumidor
$HTTP_RAW_POST_DATA=file_get_contents('php://input');

//service ejecutara lo que se envia
$servicio->service($HTTP_RAW_POST_DATA);


?>