<?php


function conectarse()
{
    $conn = mysql_connect("localhost","root","")or die(mysql_error());
    mysql_select_db("webservice",$conn);
    return($conn);
    
}



?>