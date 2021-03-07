<?php

//Incluir inicialmente la conexion a la base de datos
require "../config/conexion.php";

Class Usuario
{
    //Implementacion nuestro constructor
    public function __construct()
    {

    }

    //Implementacion un metodo para insertar registros
    public function insertar($idpersona, $idtipocargousu, $Ulogin, $Uclave, $Uimagen, $permisos)
    {
        $sql="INSERT INTO usuario(idpersona, idtipocargousu, Ulogin, Uclave, Uimagen, Uestado)
        VALUES ('$idpersona', '$idtipocargousu', '$Ulogin', '$Uclave', '$Uimagen','1')";
        //return ejecutarConsulta($sql);

        //voy a llamar a la funcion de la conexion config guardando en el sql y 
        //almacenandolo en la variableidusuarrionew
        $idusuarionew=ejecutarConsulta_retornarID($sql);

        $num_elementos=0;
        $sw=true;

        //va a contar todos los marcados por el usuario
        while ($num_elementos < count($permisos))
        {
            $sql_detalle = "INSERT INTO usuario_permisos(idusuario,idpermiso)
            VALUES('$idusuarionew', '$permisos[$num_elementos]')";
            ejecutarConsulta($sql_detalle) or $sw = false;

            $num_elementos=$num_elementos + 1;
        }

        return $sw;
    }

    //metodo para editar registros
    public function editar($idusuario, $idpersona, $idtipocargousu, $Ulogin, $Uclave, $Uimagen, $permisos)
    {
        $sql="UPDATE usuario SET idpersona='$idpersona', idtipocargousu='$idtipocargousu', Ulogin='$Ulogin', Uclave='$Uclave', 
        Uimagen='$Uimagen' WHERE idusuario='$idusuario'";
        ejecutarConsulta($sql);

        //Eliminamos todos los permisos asignados para volverlos a registrar
        $sqldel="DELETE FROM usuario_permisos WHERE idusuario='$idusuario'";
        ejecutarConsulta($sqldel);

        $num_elementos=0;
        $sw=true;

        //va a contar todos los marcados por el usuario
        while ($num_elementos < count($permisos))
        {
            $sql_detalle = "INSERT INTO usuario_permisos(idusuario,idpermiso)
            VALUES('$idusuario', '$permisos[$num_elementos]')";
            ejecutarConsulta($sql_detalle) or $sw = false;

            $num_elementos=$num_elementos + 1;
        }

        return $sw;
    }

    //metodo para desactivar  
    public function desactivar($idusuario)
    {
        $sql="UPDATE usuario SET Uestado='0' WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }

    //metodo para activar
    public function activar($idusuario)
    {
        $sql="UPDATE usuario SET Uestado='1' WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }

    //metodo para mostrar los datos de un registro a modificar
    public function mostrar($idusuario)
    {
        $sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function select()
    {
        $sql="SELECT * FROM usuario WHERE Uestado=1";
        return ejecutarConsulta($sql);
    }

    //metodo para listar los registros 
    public function listar()
    {
        $sql="SELECT a.idusuario,c.PERnombre,c.PERapellidos,b.TCUnombre,a.Ulogin,
        a.Uclave,a.Uimagen,a.Uestado FROM usuario a INNER JOIN persona c 
        ON a.idpersona=c.idpersona INNER JOIN tipocargousuario b ON a.idtipocargousu=b.idtipocargousu";
        return ejecutarConsulta($sql);
    }

    //metodo para listar los permisos del usuario 
    public function listarmarcados($idusuario)
    {
        $sql="SELECT * FROM usuario_permisos WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }

    //funcion para verificar el acceso al sistema 
    public function verificar($Ulogin,$Uclave)
    {
        $sql="SELECT idusuario, idpersona, idtipocargousu, Ulogin, Uclave, Uimagen FROM usuario 
        WHERE Ulogin='$Ulogin' AND Uclave='$Uclave' AND Uestado='1'";
        return ejecutarConsulta($sql);
    }



}
?>