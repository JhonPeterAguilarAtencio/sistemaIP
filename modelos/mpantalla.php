<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class Pantalla
{
    //Implementacion nuestro constructor
    public function __construct()
    {

    }
    public function Existe($Codigopatrimonial){
        $sql="SELECT  Count(*) as cantidad FROM  equipo  WHERE Codigopatrimonial ='$Codigopatrimonial'";   
        $resultado1=ejecutarConsultaCantidad($sql);

        $sql2="SELECT  Count(*) as cantidad FROM  pantalla  WHERE Pcodigopatrimonial ='$Codigopatrimonial'"; 
        $resultado2=ejecutarConsultaCantidad($sql2);

        $sql3="SELECT  Count(*) as cantidad FROM  teclado  WHERE Tcodigopatrimonial ='$Codigopatrimonial'";           
        $resultado3=ejecutarConsultaCantidad($sql3);

        $sql4="SELECT  Count(*) as cantidad FROM  mouse  WHERE Mcodigopatrimonial ='$Codigopatrimonial'";           
        $resultado4=ejecutarConsultaCantidad($sql4);

        $lista1=json_encode($resultado1);                      
        $info1 = json_decode($lista1);
        $num1 =$info1->cantidad;

        $lista2=json_encode($resultado2);                      
        $info2 = json_decode($lista2);
        $num2 =$info2->cantidad;

        $lista3=json_encode($resultado3);                      
        $info3 = json_decode($lista3);
        $num3 =$info3->cantidad;

        $lista4=json_encode($resultado4);                      
        $info4 = json_decode($lista4);
        $num4 =$info4->cantidad;

        $total =$num1+$num2+$num3+$num4;
        return  $total;
     
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