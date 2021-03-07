<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class Teclado
{
    //Implementacion nuestro constructor
    public function __construct()
    {

    }

    //Implementacion un metodo para insertar registros
    public function insertar($Tcodigopatrimonial, $Tmarca, $Tmodelo, $Tarea, $Timagen)
    {
        $sql="INSERT INTO teclado(Tcodigopatrimonial, Tmarca, Tmodelo, idarea, Timagen, Testado)
        VALUES ('$Tcodigopatrimonial','$Tmarca','$Tmodelo','$Tarea','$Timagen','1')";
        return ejecutarConsulta($sql);
    }

    //metodo para editar registros
    public function editar($idteclado, $Tcodigopatrimonial, $Tmarca, $Tmodelo, $Tarea, $Timagen)
    {
        $sql="UPDATE teclado SET Tcodigopatrimonial='$Tcodigopatrimonial', Tmarca='$Tmarca', Tmodelo='$Tmodelo', idarea='$Tarea', Timagen='$Timagen'
        WHERE idteclado='$idteclado'";
        return ejecutarConsulta($sql);
    }

    //metodo para desactivar  
    public function desactivar($idteclado)
    {
        $sql="UPDATE teclado SET Testado='0' WHERE idteclado='$idteclado'";
        return ejecutarConsulta($sql);
    }

    //metodo para activar
    public function activar($idteclado)
    {
        $sql="UPDATE teclado SET Testado='1' WHERE idteclado='$idteclado'";
        return ejecutarConsulta($sql);
    }

    //metodo para mostrar los datos de un registro a modificar
    public function mostrar($idteclado)
    {
        $sql="SELECT * FROM teclado WHERE idteclado='$idteclado'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //metodo para listar los registros 
    public function listar()
    {
        $sql="SELECT a.idteclado,a.Tcodigopatrimonial,a.Tmarca,a.Tmodelo,b.Anombre,a.Timagen,a.Testado FROM teclado a INNER JOIN areaIP b ON a.idarea=b.idarea";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql="SELECT * FROM teclado WHERE Testado=1";
        return ejecutarConsulta($sql);
    }
}
?>