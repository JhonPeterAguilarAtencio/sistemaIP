<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class Laptop
{
    //Implementacion nuestro constructor
    public function __construct()
    {

    }

    //Implementacion un metodo para insertar registros
    public function insertar($idtipocodigo, $Lcodigo, $Lmarca, $Lmodelo, $Larea, $Limagen)
    {
        $sql="INSERT INTO laptop(idtipocodigo, Lcodigo, Lmarca, Lmodelo, Larea, Limagen, Lestado)
        VALUES ('$idtipocodigo', '$Lcodigo', '$Lmarca', '$Lmodelo', '$Larea', '$Limagen','1')";
        return ejecutarConsulta($sql);
    }

    //metodo para editar registros
    public function editar($idlaptop, $idtipocodigo, $Lcodigo, $Lmarca, $Lmodelo, $Larea, $Limagen)
    {
        $sql="UPDATE laptop SET idtipocodigo='$idtipocodigo', Lcodigo='$Lcodigo', Lmarca='$Lmarca', Lmodelo='$Lmodelo', Larea='$Larea', Limagen='$Limagen'
        WHERE idlaptop='$idlaptop'";
        return ejecutarConsulta($sql);
    }

    //metodo para desactivar  
    public function desactivar($idlaptop)
    {
        $sql="UPDATE laptop SET Lestado='0' WHERE idlaptop='$idlaptop'";
        return ejecutarConsulta($sql);
    }

    //metodo para activar
    public function activar($idlaptop)
    {
        $sql="UPDATE laptop SET Lestado='1' WHERE idlaptop='$idlaptop'";
        return ejecutarConsulta($sql);
    }

    //metodo para mostrar los datos de un registro a modificar
    public function mostrar($idlaptop)
    {
        $sql="SELECT * FROM laptop WHERE idlaptop='$idlaptop'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //metodo para listar los registros 
    public function listar()
    {
        $sql="SELECT a.idlaptop,a.idtipocodigo,c.TCnombre as tiponombre,a.Lcodigo,a.Lmarca,
        a.Lmodelo,a.Larea,a.Limagen,a.Lestado FROM laptop a INNER JOIN tipocodigo c 
        ON a.idtipocodigo=c.idtipocodigo";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql="SELECT * FROM laptop WHERE Lestado=1";
        return ejecutarConsulta($sql);
    }
}
?>