<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class Tipocargousuario
{
    //Implementacion nuestro constructor
    public function __construct()
    {

    }

    //metodo para listar los registros y mostrar en el select

    public function select()
    {
        $sql="SELECT * FROM tipocargousuario";
        return ejecutarConsulta($sql);
    }
}
?>