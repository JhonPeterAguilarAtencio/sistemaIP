<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class Persona
{
    //Implementacion nuestro constructor
    public function __construct()
    {

    }

    //Implementacion un metodo para insertar registros
    public function insertar($PERdni, $PERnombre, $PERapellidos, $PERtelefono, $PERemail, $PERarea, $PERimagen)
    {
        $sql="INSERT INTO persona(PERdni, PERnombre, PERapellidos, PERtelefono, PERemail, PERarea, PERimagen, PERestado)
        VALUES ('$PERdni', '$PERnombre', '$PERapellidos', '$PERtelefono', '$PERemail', '$PERarea', '$PERimagen','1')";
        return ejecutarConsulta($sql);
    }

    //metodo para editar registros
    public function editar($idpersona, $PERdni, $PERnombre, $PERapellidos, $PERtelefono, $PERemail, $PERarea, $PERimagen)
    {
        $sql="UPDATE persona SET PERdni='$PERdni', PERnombre='$PERnombre', PERapellidos='$PERapellidos',
         PERtelefono='$PERtelefono', PERemail='$PERemail', PERarea='$PERarea', PERimagen='$PERimagen'
        WHERE idpersona='$idpersona'";
        return ejecutarConsulta($sql);
    }

    //metodo para desactivar  
    public function desactivar($idpersona)
    {
        $sql="UPDATE persona SET PERestado='0' WHERE idpersona='$idpersona'";
        return ejecutarConsulta($sql);
    }

    //metodo para activar
    public function activar($idpersona)
    {
        $sql="UPDATE persona SET PERestado='1' WHERE idpersona='$idpersona'";
        return ejecutarConsulta($sql);
    }

    //metodo para mostrar los datos de un registro a modificar
    public function mostrar($idpersona)
    {
        $sql="SELECT * FROM persona WHERE idpersona='$idpersona'";
        return ejecutarConsultaSimpleFila($sql);
    }


    //metodo para listar los registros 
    public function listar()
    {
        $sql="SELECT * FROM persona";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql="SELECT * FROM persona WHERE PERestado=1";
        return ejecutarConsulta($sql);
    }
}
?>