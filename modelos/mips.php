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
    public function insertar($idarea, $idpersona, $idequipo, $IPnumips, $IPnumdns, $IPnumproxy, $IPnumpuertoproxy, $IPusuariocredencial, $IPclavecreencial,$idTipoEquipo)
    {
        ///$sql="INSERT INTO ips(idarea, idpersona, IPtipoequipo, idlaptop, idordenador, idimpresora, 
        ///IPnumips, IPnumdns, IPnumproxy, IPnumpuertoproxy, IPusuariocredencial, IPclavecreencial, IPestado)
        ///VALUES ('$idarea', '$idpersona', '$IPtipoequipo', '$idlaptop', '$idordenador', '$idimpresora', 
       ///'$IPnumips', '$IPnumdns', '$IPnumproxy', '$IPnumpuertoproxy', '$IPusuariocredencial', '$IPclavecreencial', '1')";
       /// return ejecutarConsulta($sql);


        $sql="INSERT INTO ips2(idarea, idpersona, idequipo, IPnumips, IPnumdns, IPnumproxy, IPnumpuertoproxy, IPusuariocredencial, IPclavecreencial, IPestado,idTipoEQuipo)
        VALUES ('$idarea', '$idpersona', '$idequipo', '$IPnumips', '$IPnumdns', '$IPnumproxy', '$IPnumpuertoproxy', '$IPusuariocredencial', '$IPclavecreencial', '1','$idTipoEquipo')";
        return ejecutarConsulta($sql);
    }

    //metodo para editar registros
    public function editar($idips,$idarea, $idpersona, $idequipo, $IPnumips, $IPnumdns, $IPnumproxy, $IPnumpuertoproxy, $IPusuariocredencial, $IPclavecreencial,$idTipoEquipo)
    {
        $sql="UPDATE ips2 SET idarea='$idarea', idpersona='$idpersona', idequipo='$idequipo',      
         IPnumips='$IPnumips', IPnumdns='$IPnumdns',
         IPnumproxy='$IPnumproxy', IPnumpuertoproxy='$IPnumpuertoproxy', IPusuariocredencial='$IPusuariocredencial',
         IPclavecreencial='$IPclavecreencial' ,idTipoEQuipo='$idTipoEquipo' WHERE idips='$idips'";
        return ejecutarConsulta($sql);
    }

    public function ver($id)
    {     // $idequipo=5;
       
                $sql3="SELECT  eq.idequipo, eq.idtipoequipo,eq.Codigopatrimonial,eq.Marca,
                eq.Modelo,a.Anombre,eq.Estado,eq.Partes,eq.Perteneciente  FROM equipo AS eq
                INNER JOIN areaip AS a
                ON eq.Area = a.idarea
                WHERE eq.idequipo='$id'";   

               
               return ejecutarConsultaSimpleFila($sql3);
        }  

    
    }
    //metodo para desactivar  
    public function desactivar($idips)
    {
        $sql="UPDATE ips2 SET IPestado='0' WHERE idips='$idips'";
        return ejecutarConsulta($sql);
    }

    //metodo para activar
    public function activar($idips)
    {
        $sql="UPDATE ips2 SET IPestado='1' WHERE idips='$idips'";
        return ejecutarConsulta($sql);
    }

    //metodo para mostrar los datos de un registro a modificar
    public function mostrar($idips)
    {
        $sql="SELECT * FROM ips2 WHERE idips='$idips'";
        return ejecutarConsultaSimpleFila($sql);
    }
    
    //metodo para listar los registros 
    public function listar()
    {
        $sql="SELECT  a.idips,b.Asiglas,b.Anombre,a.IPtipoequipo,a.IPnumips,c.PERnombre,a.IPusuariocredencial,
        c.PERcargo, a.IPestado FROM ips a INNER JOIN areaIP b
        ON a.idarea=b.idarea INNER JOIN persona c ON a.idpersona=c.idpersona INNER JOIN laptop d ON
         a.idlaptop=d.idlaptop";

         $sql2="SELECT ip.idips,are.Asiglas, are.Anombre,tipo.TEdescription,ip.IPnumips,p.PERnombre,p.PERcargo,ip.IPusuariocredencial,ip.IPestado FROM ips2  AS ip

         INNER JOIN areaip AS are
         ON ip.idarea = are.idarea
         INNER JOIN equipo AS eq
         ON ip.idequipo=eq.idequipo
         INNER JOIN persona AS p
         ON ip.idpersona = p.idpersona
         INNER JOIN tipoequipo AS tipo
         ON ip.idTipoEQuipo= tipo.idtipoequipo";

        return ejecutarConsulta($sql2);
    }
}
?>