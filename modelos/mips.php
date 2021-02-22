<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class IPS
{
    //Implementacion nuestro constructor
    public function __construct()
    {

    }

    //Implementacion un metodo para insertar registros
    public function insertar($idarea, $idpersona, $IPtipoequipo, $idlaptop, $idordenador, $idimpresora, 
    $IPnumips, $IPnumdns, $IPnumproxy, $IPnumpuertoproxy, $IPusuariocredencial, $IPclavecreencial)
    {
        $sql="INSERT INTO ips(idarea, idpersona, IPtipoequipo, idlaptop, idordenador, idimpresora, 
        IPnumips, IPnumdns, IPnumproxy, IPnumpuertoproxy, IPusuariocredencial, IPclavecreencial, IPestado)
        VALUES ('$idarea', '$idpersona', '$IPtipoequipo', '$idlaptop', '$idordenador', '$idimpresora', 
    '$IPnumips', '$IPnumdns', '$IPnumproxy', '$IPnumpuertoproxy', '$IPusuariocredencial', '$IPclavecreencial', '1')";
        return ejecutarConsulta($sql);
    }

    //metodo para editar registros
    public function editar($idips, $idarea, $idpersona, $IPtipoequipo, $idlaptop, $idordenador, $idimpresora, 
    $IPnumips, $IPnumdns, $IPnumproxy, $IPnumpuertoproxy, $IPusuariocredencial, $IPclavecreencial)
    {
        $sql="UPDATE ips SET idarea='$idarea', idpersona='$idpersona', IPtipoequipo='$IPtipoequipo', 
         idlaptop='$idlaptop',
         idordenador='$idordenador', idimpresora='$idimpresora', IPnumips='$IPnumips', IPnumdns='$IPnumdns',
         IPnumproxy='$IPnumproxy', IPnumpuertoproxy='$IPnumpuertoproxy', IPusuariocredencial='$IPusuariocredencial',
         IPclavecreencial='$IPclavecreencial' WHERE idips='$idips'";
        return ejecutarConsulta($sql);
    }

    //metodo para desactivar  
    public function desactivar($idips)
    {
        $sql="UPDATE ips SET IPestado='0' WHERE idips='$idips'";
        return ejecutarConsulta($sql);
    }

    //metodo para activar
    public function activar($idips)
    {
        $sql="UPDATE ips SET IPestado='1' WHERE idips='$idips'";
        return ejecutarConsulta($sql);
    }

    //metodo para mostrar los datos de un registro a modificar
    public function mostrar($idips)
    {
        $sql="SELECT * FROM ips WHERE idips='$idips'";
        return ejecutarConsultaSimpleFila($sql);
    }
    
    //metodo para listar los registros 
    public function listar()
    {
        $sql="SELECT a.idips,b.Asiglas,b.Anombre,a.IPtipoequipo,a.IPnumips,c.PERnombre,a.IPusuariocredencial,
        c.PERcargo, a.IPestado FROM ips a INNER JOIN areaIP b
        ON a.idarea=b.idarea INNER JOIN persona c ON a.idpersona=c.idpersona INNER JOIN laptop d ON
         a.idlaptop=d.idlaptop";
        return ejecutarConsulta($sql);
    }
}
?>