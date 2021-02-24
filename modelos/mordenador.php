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
    public function insertar($IdtipoEquipo, $Codigopatrimonial, $Marca, $Modelo, $Area, $Imagen, $Estado,
    $Partes,$Perteneciente)
    {
        $sql="INSERT INTO Equipo(IdtipoEquipo, Codigopatrimonial, Marca, Modelo, Area, Imagen, Estado, 
        Partes, Perteneciente)
        VALUES ('$IdtipoEquipo', '$Codigopatrimonial', '$Marca', '$Modelo', '$Area', '$Imagen', '$Estado', 
        '$Partes', '$Perteneciente')";
     
        return ejecutarConsulta2($sql);
    }

    /*public function insertar2($Ocodigopatrimonial, $Omarca, $Omodelo, $Oarea, $Oimagen, $idmouse, $idteclado,
        $idpantalla)
        {
            $sql="INSERT INTO Equipo(Ocodigopatrimonial, Omarca, Omodelo, Oarea, Oimagen, idmouse, idteclado, 
            idpantalla, Oestado)
            VALUES ('$Ocodigopatrimonial', '$Omarca', '$Omodelo', '$Oarea', '$Oimagen', '$idmouse', '$idteclado', 
            '$idpantalla', '1')";
        
            return ejecutarConsulta2($sql);
        }*/

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
        $sql2=" SELECT eq.idequipo, eq.Codigopatrimonial,eq.Marca,eq.Modelo,eq.Area,eq.Imagen ,mou.idmouse,te.idteclado,pan.idpantalla,eq.Estado    ,te.Tmarca AS teclados ,pan.Pmarca,mou.Mmarca FROM equipo as eq
        INNER JOIN partesequipo as par
      ON eq.idequipo =par.idequipo         
      INNER JOIN teclado AS te
      ON par.idteclado=te.idteclado
      INNER JOIN pantalla AS pan
      ON par.idpantalla = pan.idpantalla
      INNER JOIN mouse AS mou
      ON par.idmouse=mou.idmouse
      where  eq.idequipo='$idordenador'"; 
        return ejecutarConsultaSimpleFila($sql2);
    }
    public function ver($idordenador)
    {
        $sql="SELECT * FROM ordenador WHERE idordenador='$idordenador'";
        $sql2="SELECT a.idordenador,a.Ocodigopatrimonial,a.Omarca,a.Omodelo,a.Oarea,a.Oimagen,
        b.Mcodigopatrimonial,b.Mmarca,c.Tcodigopatrimonial,c.Tmarca,d.Pcodigopatrimonial,d.Pmarca,a.Oestado FROM ordenador a INNER JOIN mouse b
        ON a.idmouse=b.idmouse INNER JOIN teclado c ON a.idteclado=c.idteclado INNER JOIN pantalla d ON  
		   a.idpantalla=d.idpantalla
		   WHERE idordenador='$idordenador'";

    $sql3="SELECT eq.idequipo, eq.Codigopatrimonial,eq.Marca,eq.Modelo,eq.Area,eq.Imagen,mou.idmouse,mou.Mcodigopatrimonial,mou.Mmarca, te.idteclado,te.Tcodigopatrimonial,pan.idpantalla,pan.Pcodigopatrimonial,pan.Pmarca, eq.Estado,te.Tmarca AS teclados ,pan.Pmarca,mou.Mmarca  FROM equipo as eq
        INNER JOIN partesequipo as par
      ON eq.idequipo =par.idequipo         
      INNER JOIN teclado AS te
      ON par.idteclado=te.idteclado
      INNER JOIN pantalla AS pan
      ON par.idpantalla = pan.idpantalla
      INNER JOIN mouse AS mou
      ON par.idmouse=mou.idmouse
      where  eq.idequipo='$idordenador'";   
      return ejecutarConsultaSimpleFila($sql3);
    }

    //metodo para listar los registros 
    public function listar()
    {
        $sql="SELECT a.idordenador,a.Ocodigopatrimonial,a.Omarca,a.Omodelo,a.Oarea,a.Oimagen,
        b.Mcodigopatrimonial,b.Mmarca,c.Tcodigopatrimonial,c.Tmarca,d.Pcodigopatrimonial,d.Pmarca,a.Oestado FROM ordenador a INNER JOIN mouse b
        ON a.idmouse=b.idmouse INNER JOIN teclado c ON a.idteclado=c.idteclado INNER JOIN pantalla d ON
         a.idpantalla=d.idpantalla";

         $sql2=" SELECT  eq.idequipo, eq.Codigopatrimonial,eq.Marca,eq.Modelo,eq.Area,eq.Imagen,eq.Estado,te.Tmarca AS teclados ,pan.Pmarca,mou.Mmarca FROM equipo as eq
         INNER JOIN partesequipo as par
       ON eq.idequipo =par.idequipo
       INNER JOIN teclado AS te
       ON par.idteclado=te.idteclado
       INNER JOIN pantalla AS pan
       ON par.idpantalla = pan.idpantalla
       INNER JOIN mouse AS mou
       ON par.idmouse=mou.idmouse
       WHERE eq.IdtipoEquipo='1'";
        return ejecutarConsulta($sql2);
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