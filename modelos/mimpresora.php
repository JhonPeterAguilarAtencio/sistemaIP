<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class Impresora
{
    //Implementacion nuestro constructor
    public function __construct()
    {

    }

    //Implementacion un metodo para insertar registros
    public function insertar($Icodigopatrimonial, $Imarca, $Imodelo, $idarea, $Iimagen)
    {
        $sql="INSERT INTO impresora(Icodigopatrimonial, Imarca, Imodelo, idarea, Iimagen, Iestado)
        VALUES ('$Icodigopatrimonial', '$Imarca', '$Imodelo', '$idarea', '$Iimagen','1')";
        return ejecutarConsulta($sql);
    }

    //metodo para editar registros
    public function editar($idimpresora, $Icodigopatrimonial, $Imarca, $Imodelo, $idarea, $Iimagen)
    {
        $sql="UPDATE impresora SET Icodigopatrimonial='$Icodigopatrimonial', Imarca='$Imarca', Imodelo='$Imodelo',
         idarea='$idarea', Iimagen='$Iimagen'
        WHERE idimpresora='$idimpresora'";
        return ejecutarConsulta($sql);
    }

    //metodo para desactivar  
    public function desactivar($idimpresora)
    {
        $sql="UPDATE impresora SET Iestado='0' WHERE idimpresora='$idimpresora'";
        return ejecutarConsulta($sql);
    }

    //metodo para activar
    public function activar($idimpresora)
    {
        $sql="UPDATE impresora SET Iestado='1' WHERE idimpresora='$idimpresora'";
        return ejecutarConsulta($sql);
    }

    //metodo para mostrar los datos de un registro a modificar
    public function mostrar($idimpresora)
    {
        $sql="SELECT * FROM impresora WHERE idimpresora='$idimpresora'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //metodo para listar los registros 
    public function listar()
    {
        $sql="SELECT a.idimpresora,a.Icodigopatrimonial,a.Imarca,a.Imodelo,c.Anombre,
        a.Iimagen,a.Iestado FROM impresora a INNER JOIN area c 
        ON a.idarea=c.idarea";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql="SELECT * FROM impresora WHERE Iestado=1";
        return ejecutarConsulta($sql);
    }
}
?>