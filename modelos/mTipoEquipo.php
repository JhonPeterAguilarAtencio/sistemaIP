<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class tipoEquipo
{
    //Implementacion nuestro constructor
    public function __construct()
    {

    }

    public function select()
    {
        $sql="SELECT * FROM tipoequipo";
        return ejecutarConsulta($sql);
    }
    public function ListarTipoDeEquipo($id)
    {     
        $sql="SELECT * FROM equipo WHERE IdtipoEquipo='$id'";
        return ejecutarConsulta($sql);
    }
    
}
?>