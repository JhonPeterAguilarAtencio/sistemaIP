<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class Mouses
{
    //Implementacion nuestro constructor
    public function __construct()
    {

    }

    //Implementacion un metodo para insertar registros
    public function insertar($Mcodigopatrimonial, $Mmarca, $Mmodelo, $Marea, $Mimagen)
    {
        $sql="INSERT INTO mouse(Mcodigopatrimonial, Mmarca, Mmodelo, Marea, Mimagen, Mestado)
        VALUES ('$Mcodigopatrimonial', '$Mmarca', '$Mmodelo', '$Marea', '$Mimagen','1')";
        return ejecutarConsulta($sql);
    }

    //metodo para editar registros
    public function editar($idmouse, $Mcodigopatrimonial, $Mmarca, $Mmodelo, $Marea, $Mimagen)
    {
        $sql="UPDATE mouse SET Mcodigopatrimonial='$Mcodigopatrimonial', Mmarca='$Mmarca', Mmodelo='$Mmodelo', Marea='$Marea', Mimagen='$Mimagen'
        WHERE idmouse='$idmouse'";
        return ejecutarConsulta($sql);
    }

    //metodo para desactivar  
    public function desactivar($idmouse)
    {
        $sql="UPDATE mouse SET Mestado='0' WHERE idmouse='$idmouse'";
        return ejecutarConsulta($sql);
    }

    //metodo para activar
    public function activar($idmouse)
    {
        $sql="UPDATE mouse SET Mestado='1' WHERE idmouse='$idmouse'";
        return ejecutarConsulta($sql);
    }

    //metodo para mostrar los datos de un registro a modificar
    public function mostrar($idmouse)
    {
        $sql="SELECT * FROM mouse WHERE idmouse='$idmouse'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //metodo para listar los registros 
    public function listar()
    {
        $sql="SELECT * FROM mouse";
        return ejecutarConsulta($sql);
    }

    
    public function select()
    {
        $sql="SELECT * FROM mouse WHERE Mestado=1";
        return ejecutarConsulta($sql);
    }
}
?>