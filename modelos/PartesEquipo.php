<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class PartesEquipo
{
    //Implementacion nuestro constructor
    public function __construct()
    {

    }

    //Implementacion un metodo para insertar registros
    public function Ingresar($idequipo, $idteclado, $idmouse, $idpantalla, $fecha)
    {
        $sql1="INSERT INTO PartesEquipo(idequipo, idteclado, idmouse, idpantalla, fecha)
        VALUES ('$idequipo', '$idteclado', '$idmouse', '$idpantalla', '$fecha')";
     
        return ejecutarConsulta($sql1);
    }

    
}
?>