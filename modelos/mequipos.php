<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class Equipos
{
    //Implementacion nuestro constructor
    public function __construct()
    {

    }

    public function insertar($idetipoequipo, $Ecodigo, $Emarca, $Emodelo, $Earea, $Eimagen,$Estado,$EPartes,$Eperteneciente)
    {
                
        $sql="INSERT INTO equipo(idtipoequipo, Codigopatrimonial, Marca, Modelo, Area, Imagen, Estado,Partes,Perteneciente)
        VALUES ('$idetipoequipo', '$Ecodigo', '$Emarca', '$Emodelo', '$Earea','$Eimagen','$Estado','$EPartes','$Eperteneciente')";
        //return $idtipocodigo;
        return ejecutarConsulta2($sql);
    }

    //metodo para editar registros
    public function editar($Eidequipo,$idetipoequipo, $Ecodigo, $Emarca, $Emodelo, $Earea, $Eimagen,$Estado,$EPartes,$Eperteneciente)
    {
        $sql="UPDATE equipo SET idtipoequipo='$idetipoequipo', Codigopatrimonial='$Ecodigo', Marca='$Emarca', Modelo='$Emodelo', Area='$Earea', Imagen='$Eimagen' , 
        Perteneciente ='$Eperteneciente'
           WHERE idequipo='$Eidequipo'";
        return ejecutarConsulta($sql);
    }


    public function ver($idequipo)
    {     // $idequipo=5;
        if($idequipo==null || $idequipo==""){
            $msg->mensaje = "Vacio";           
             return   json_encode($msg);
            }else{
                $sql3="SELECT  eq.idequipo, eq.idtipoequipo,eq.Codigopatrimonial,eq.Marca,
                eq.Modelo,a.Anombre,eq.Estado,eq.Partes,eq.Perteneciente  FROM equipo AS eq
                INNER JOIN areaip AS a
                ON eq.Area = a.idarea
                WHERE eq.idequipo='$idequipo'";   

                $consulta="SELECT eq.idequipo, eq.Codigopatrimonial,eq.Marca,eq.Modelo,a.Anombre,eq.Partes, eq.Imagen,mou.idmouse,mou.Mcodigopatrimonial,mou.Mmarca, te.idteclado,te.Tcodigopatrimonial,pan.idpantalla,pan.Pcodigopatrimonial,pan.Pmarca, eq.Estado,te.Tmarca AS teclados ,pan.Pmarca,mou.Mmarca  FROM equipo as eq
                    INNER JOIN partesequipo as par
                 ON eq.idequipo =par.idequipo    
                     INNER JOIN areaip AS a
                    ON eq.Area = a.idarea     
                INNER JOIN teclado AS te
                ON par.idteclado=te.idteclado
                INNER JOIN pantalla AS pan
                ON par.idpantalla = pan.idpantalla
                INNER JOIN mouse AS mou
                ON par.idmouse=mou.idmouse
                where  eq.idequipo='$idequipo'";
               
               return ejecutarConsultaSimpleFila($consulta);
        }  

    
    }

     function ver2($idequipo){
        $consulta="SELECT eq.idequipo, eq.Codigopatrimonial,eq.Marca,eq.Modelo,a.Anombre,eq.Partes, eq.Imagen,Estado  FROM equipo as eq	       
				      
        INNER JOIN areaip AS a
       ON eq.Area = a.idarea  
         where  eq.idequipo='$idequipo'";         
       return ejecutarConsultaSimpleFila($consulta);
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
        $sql="SELECT * FROM equipo WHERE idequipo='$idlaptop'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //metodo para listar los registros 
    public function listar()
    {
        $sql=" SELECT  eq.idequipo, eq.idtipoequipo,tipo.TEdescription, eq.Codigopatrimonial,eq.Marca,
                eq.Modelo,a.Anombre,eq.Estado,eq.Partes,eq.Perteneciente  FROM equipo AS eq
                INNER JOIN areaip AS a
                ON eq.Area = a.idarea                
                INNER JOIN tipoequipo AS tipo
                ON eq.idtipoequipo=tipo.idtipoequipo";
        return ejecutarConsulta($sql);
    }

    public function select()
    {
        $sql="SELECT * FROM laptop WHERE Lestado=1";
        return ejecutarConsulta($sql);
    }
}
?>