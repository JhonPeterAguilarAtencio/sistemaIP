<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class Mouses
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
    public function insertar($Mcodigopatrimonial, $Mmarca, $Mmodelo, $Marea, $Mimagen)
    {
        $sql="INSERT INTO mouse(Mcodigopatrimonial, Mmarca, Mmodelo, idarea, Mimagen, Mestado)
        VALUES ('$Mcodigopatrimonial', '$Mmarca', '$Mmodelo', '$Marea', '$Mimagen','1')";
        return ejecutarConsulta($sql);
    }

    //metodo para editar registros
    public function editar($idmouse, $Mcodigopatrimonial, $Mmarca, $Mmodelo, $Marea, $Mimagen)
    {
        $sql="UPDATE mouse SET Mcodigopatrimonial='$Mcodigopatrimonial', Mmarca='$Mmarca', Mmodelo='$Mmodelo', idarea='$Marea', Mimagen='$Mimagen'
        WHERE idmouse='$idmouse'";
        return ejecutarConsulta($sql);
    }

    //metodo para desactivar  
    public function desactivar($idmouse)
    {
        $sql="UPDATE mouse SET Mestado='0' WHERE idmouse='$idmouse'";
        return ejecutarConsulta($sql);
    }

    //metodo para activar
    public function activar($idmouse)
    {
        $sql="UPDATE mouse SET Mestado='1' WHERE idmouse='$idmouse'";
        return ejecutarConsulta($sql);
    }

    //metodo para mostrar los datos de un registro a modificar
    public function mostrar($idmouse)
    {
        $sql="SELECT * FROM mouse WHERE idmouse='$idmouse'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //metodo para listar los registros 
    public function listar()
    {
        $sql="SELECT a.idmouse,a.Mcodigopatrimonial,a.Mmarca,a.Mmodelo,b.Anombre,a.Mimagen,a.Mestado FROM mouse a INNER JOIN areaIP b ON a.idarea=b.idarea";
        return ejecutarConsulta($sql);
    }

    
    public function select()
    {
        $sql="SELECT * FROM mouse WHERE Mestado=1";
        return ejecutarConsulta($sql);
    }
}
?>