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
    public function insertar($PERdni, $PERnombre, $PERapellidos, $idtipocargoemp, $PERtelefono, $PERemail, $PERarea, $PERimagen)
    {
        $sql="INSERT INTO persona(PERdni, PERnombre, PERapellidos, idtipocargoemp, PERtelefono, PERemail, idarea, PERimagen, PERestado)
        VALUES ('$PERdni', '$PERnombre', '$PERapellidos', '$idtipocargoemp', '$PERtelefono', '$PERemail', '$PERarea', '$PERimagen','1')";
        return ejecutarConsulta($sql);
    }

    //metodo para editar registros
    public function editar($idpersona, $PERdni, $PERnombre, $PERapellidos, $idtipocargoemp, $PERtelefono, $PERemail, $PERarea, $PERimagen)
    {
        $sql="UPDATE persona SET PERdni='$PERdni', PERnombre='$PERnombre', PERapellidos='$PERapellidos',
        idtipocargoemp='$idtipocargoemp', PERtelefono='$PERtelefono', PERemail='$PERemail', idarea='$PERarea', PERimagen='$PERimagen'
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
        $sql="SELECT a.idpersona, a.PERdni,a.PERnombre,a.PERapellidos,c.TCEnombre,a.PERtelefono,a.PERemail,
        b.Anombre,a.PERimagen,a.PERestado FROM persona a INNER JOIN areaIP b
        ON a.idarea=b.idarea INNER JOIN tipocargoempleado c ON a.idtipocargoemp=c.idtipocargoemp";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql="SELECT * FROM persona WHERE PERestado=1";
        return ejecutarConsulta($sql);
    }
}
?>