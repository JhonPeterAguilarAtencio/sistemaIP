<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class Permiso
{
    //Implementacion nuestro constructor
    public function __construct()
    {

    }

    //metodo para listar los registros 
    public function listar()
    {
        $sql="SELECT * FROM permiso";
        return ejecutarConsulta($sql);
    }
}
?>