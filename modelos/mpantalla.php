<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class Pantalla
{
    //Implementacion nuestro constructor
    public function __construct()
    {

    }

    //Implementacion un metodo para insertar registros
    public function insertar($Pcodigopatrimonial, $Pmarca, $Pmodelo, $Parea, $Pimagen)
    {
        $sql="INSERT INTO pantalla(Pcodigopatrimonial, Pmarca, Pmodelo, idarea, Pimagen, Pestado)
        VALUES ('$Pcodigopatrimonial','$Pmarca','$Pmodelo','$Parea','$Pimagen','1')";
        return ejecutarConsulta($sql);
    }

    //metodo para editar registros
    public function editar($idpantalla, $Pcodigopatrimonial, $Pmarca, $Pmodelo, $Parea, $Pimagen)
    {
        $sql="UPDATE pantalla SET Pcodigopatrimonial='$Pcodigopatrimonial', Pmarca='$Pmarca', Pmodelo='$Pmodelo', idarea='$Parea', Pimagen='$Pimagen'
        WHERE idpantalla='$idpantalla'";
        return ejecutarConsulta($sql);
    }

    //metodo para desactivar  
    public function desactivar($idpantalla)
    {
        $sql="UPDATE pantalla SET Pestado='0' WHERE idpantalla='$idpantalla'";
        return ejecutarConsulta($sql);
    }

    //metodo para activar
    public function activar($idpantalla)
    {
        $sql="UPDATE pantalla SET Pestado='1' WHERE idpantalla='$idpantalla'";
        return ejecutarConsulta($sql);
    }

    //metodo para mostrar los datos de un registro a modificar
    public function mostrar($idpantalla)
    {
        $sql="SELECT * FROM pantalla WHERE idpantalla='$idpantalla'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //metodo para listar los registros 
    public function listar()
    {
        $sql="SELECT a.idpantalla,a.Pcodigopatrimonial,a.Pmarca,a.Pmodelo,b.Anombre,a.Pimagen,a.Pestado FROM pantalla a INNER JOIN areaIP b ON a.idarea=b.idarea";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql="SELECT * FROM pantalla WHERE Pestado=1";
        return ejecutarConsulta($sql);
    }
}
?>