<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class Teclado
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