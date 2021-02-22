<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class Area
{
    //Implementacion nuestro constructor
    public function __construct()
    {

    }

    //Implementacion un metodo para insertar registros
    public function insertar($Asiglas, $Anombre, $Adescripcion)
    {
        $sql="INSERT INTO areaIP(Asiglas, Anombre, Adescripcion, Aestado)
        VALUES ('$Asiglas','$Anombre','$Adescripcion','1')";
        return ejecutarConsulta($sql);
    }

    //metodo para editar registros
    public function editar($Asiglas, $idarea, $Anombre, $Adescripcion)
    {
        $sql="UPDATE areaIP SET Asiglas='$Asiglas', Anombre='$Anombre', Adescripcion='$Adescripcion'
        WHERE idarea='$idarea'";
        return ejecutarConsulta($sql);
    }

    //metodo para desactivar  
    public function desactivar($idarea)
    {
        $sql="UPDATE areaIP SET Aestado='0' WHERE idarea='$idarea'";
        return ejecutarConsulta($sql);
    }

    //metodo para activar
    public function activar($idarea)
    {
        $sql="UPDATE areaIP SET Aestado='1' WHERE idarea='$idarea'";
        return ejecutarConsulta($sql);
    }

    //metodo para mostrar los datos de un registro a modificar
    public function mostrar($idarea)
    {
        $sql="SELECT * FROM areaIP WHERE idarea='$idarea'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //metodo para listar los registros 
    public function listar()
    {
        $sql="SELECT * FROM areaIP";
        return ejecutarConsulta($sql);
    }

    
    public function select()
    {
        $sql="SELECT * FROM areaIP WHERE Aestado=1";
        return ejecutarConsulta($sql);
    }
}
?>