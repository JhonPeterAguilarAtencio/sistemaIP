<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class Ordenador
{
    //Implementacion nuestro constructor
    public function __construct()
    {

    }

    //Implementacion un metodo para insertar registros
    public function insertar($Ocodigopatrimonial, $Omarca, $Omodelo, $Oarea, $Oimagen, $idmouse, $idteclado,
    $idpantalla)
    {
        $sql="INSERT INTO ordenador(Ocodigopatrimonial, Omarca, Omodelo, Oarea, Oimagen, idmouse, idteclado, 
        idpantalla, Oestado)
        VALUES ('$Ocodigopatrimonial', '$Omarca', '$Omodelo', '$Oarea', '$Oimagen', '$idmouse', '$idteclado', 
        '$idpantalla', '1')";
        return ejecutarConsulta($sql);
    }

    //metodo para editar registros
    public function editar($idordenador, $Ocodigopatrimonial, $Omarca, $Omodelo, $Oarea, $Oimagen,
     $idmouse, $idteclado, $idpantalla)
    {
        $sql="UPDATE ordenador SET Ocodigopatrimonial='$Ocodigopatrimonial', Omarca='$Omarca', Omodelo='$Omodelo', Oarea='$Oarea',
         Oimagen='$Oimagen', idmouse='$idmouse', idteclado='$idteclado', idpantalla='$idpantalla' WHERE idordenador='$idordenador'";
        return ejecutarConsulta($sql);
    }

    //metodo para desactivar  
    public function desactivar($idordenador)
    {
        $sql="UPDATE ordenador SET Oestado='0' WHERE idordenador='$idordenador'";
        return ejecutarConsulta($sql);
    }

    //metodo para activar
    public function activar($idordenador)
    {
        $sql="UPDATE ordenador SET Oestado='1' WHERE idordenador='$idordenador'";
        return ejecutarConsulta($sql);
    }

    //metodo para mostrar los datos de un registro a modificar
    public function mostrar($idordenador)
    {
        $sql="SELECT * FROM ordenador WHERE idordenador='$idordenador'";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function ver($idordenador)
    {
        $sql="SELECT * FROM ordenador WHERE idordenador='$idordenador'";
        $sql2="SELECT a.idordenador,a.Ocodigopatrimonial,a.Omarca,a.Omodelo,a.Oarea,a.Oimagen,
        b.Mcodigopatrimonial,b.Mmarca,c.Tcodigopatrimonial,c.Tmarca,d.Pcodigopatrimonial,d.Pmarca,a.Oestado FROM ordenador a INNER JOIN mouse b
        ON a.idmouse=b.idmouse INNER JOIN teclado c ON a.idteclado=c.idteclado INNER JOIN pantalla d ON  
		   a.idpantalla=d.idpantalla
		   WHERE idordenador='$idordenador'";
        return ejecutarConsultaSimpleFila($sql2);
    }

    //metodo para listar los registros 
    public function listar()
    {
        $sql="SELECT a.idordenador,a.Ocodigopatrimonial,a.Omarca,a.Omodelo,a.Oarea,a.Oimagen,
        b.Mcodigopatrimonial,b.Mmarca,c.Tcodigopatrimonial,c.Tmarca,d.Pcodigopatrimonial,d.Pmarca,a.Oestado FROM ordenador a INNER JOIN mouse b
        ON a.idmouse=b.idmouse INNER JOIN teclado c ON a.idteclado=c.idteclado INNER JOIN pantalla d ON
         a.idpantalla=d.idpantalla";
        return ejecutarConsulta($sql);
    }

    //metodo para listar los Equipos 
    public function listarequipos()
    {
        $sql="SELECT a.idordenador,a.Ocodigopatrimonial,a.Omarca,a.Omodelo,a.Oarea,a.Oimagen,
        b.Mcodigopatrimonial,b.Mmarca,c.Tcodigopatrimonial,c.Tmarca,d.Pcodigopatrimonial,d.Pmarca,a.Oestado FROM ordenador a INNER JOIN mouse b
        ON a.idmouse=b.idmouse INNER JOIN teclado c ON a.idteclado=c.idteclado INNER JOIN pantalla d ON
         a.idpantalla=d.idpantalla";
        return ejecutarConsulta($sql);
    }

    
    public function select()
    {
        $sql="SELECT * FROM ordenador WHERE Oestado=1";
        return ejecutarConsulta($sql);
    }
}
?>