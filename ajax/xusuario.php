<?php
    session_start();
    require_once "../modelos/musuario.php";

    $usuario=new Usuario();

    $idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
    $idpersona=isset($_POST["idpersona"])? limpiarCadena($_POST["idpersona"]):""; 
    $Ucargo=isset($_POST["Ucargo"])? limpiarCadena($_POST["Ucargo"]):"";
    $Ulogin=isset($_POST["Ulogin"])? limpiarCadena($_POST["Ulogin"]):"";
    $Uclave=isset($_POST["Uclave"])? limpiarCadena($_POST["Uclave"]):""; //la clave sera encriptada con shat
    $Uimagen=isset($_POST["Uimagen"])? limpiarCadena($_POST["Uimagen"]):"";

    switch ($_GET["op"]){
        //echo $_GET["op"] ? "Implemento Teclado registrado";
        case 'guardaryeditar':

            if (!file_exists($_FILES['Uimagen']['tmp_name']) || !is_uploaded_file($_FILES['Uimagen']['tmp_name']))
            {
                $Uimagen=$_POST["Uimagenactual"];
            }
            else{

                $ext = explode(".", $_FILES["Uimagen"]["name"]);
                if ($_FILES['Uimagen']['type'] == "image/jpg" || $_FILES['Uimagen']['type'] == "image/jpeg" || 
                $_FILES['Uimagen']['type'] == "image/png")
                {
                    $Uimagen = round(microtime(true)) . '.' . end($ext);
                    move_uploaded_file($_FILES["Uimagen"]["tmp_name"], "../files/usuario/" . $Uimagen);
                }
            }

            //funcion Hash SHA256 en la contraseña
            $clavehash=hash("SHA256",$Uclave);

            if(empty($idusuario)){
                $rspta=$usuario->insertar($idpersona, $Ucargo, $Ulogin, $clavehash, $Uimagen, $_POST['permiso']);
                echo $rspta ? "Implemento Teclado registrado" : "Implemento teclado no se pudo registrar";
            }
            else{
                $rspta=$usuario->editar($idusuario, $idpersona, $Ucargo, $Ulogin, $clavehash, $Uimagen, $_POST['permiso']);
                echo $rspta ? "Implemento Teclado actualizado" : "Implemento teclado no se pudo actualizado";
            }
            break;
        case 'desactivar':
                $rspta=$usuario->desactivar($idusuario);
                echo $rspta ? "Implemento Teclado desactivado" : "Implemento teclado no se pudo desactivado";
                
            break;
        case 'activar':
                $rspta=$usuario->activar($idusuario);
                echo $rspta ? "Implemento Teclado activado" : "Implemento teclado no se pudo activar";
                
            break;
        case 'mostrar':
                $rspta=$usuario->mostrar($idusuario);
                //codificar el resultado utilizando json
                echo json_encode($rspta);
                
            break;
        case 'listar':
                $rspta=$usuario->listar();
                //vamos a declarar un array
                $data= Array();
                while ($reg=$rspta->fetch_object()){
                    $data[]=array(
                        "0"=>($reg->Uestado) ? '<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-edit"></i></button>'.
                        ' <button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-toggle-off"></i></button>':
                        '<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-edit"></i></button>'.
                        ' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
                        "1"=>$reg->PERnombre ." ". $reg->PERapellidos,
                        "2"=>$reg->Ucargo,
                        "3"=>$reg->Ulogin, 
                        "4"=>"<img src='../../files/usuario/".$reg->Uimagen."' height='60px' width='60px' class='rounded' alt='Eniun'>",
                        "5"=>($reg->Uestado)?'<span class="badge badge-primary">Activado</span>':
                        '<span class="right badge badge-danger">Desactivado</span>'
                    );
                }

                $results = array(
                    "sEcho"=>1, //Informacion para el datatables
                    "iTotalRecords"=>count($data), //enviamos el total registros al datatable
                    "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
                    "aaData"=>$data);

                    echo json_encode($results);
            break;

            case 'selectpersona':
                require_once "../modelos/mpersona.php";
                $usuario = new Persona();

                $rspta = $usuario->select();

                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idpersona . '>' . $reg->PERnombre ." ". $reg->PERapellidos . '</option>';
                    }
            break;

            case 'permisos':
                //Obtener todos los permisos de la tabla permisos
                require_once "../modelos/mpermiso.php";
                $permiso = new Permiso();
                $rspta = $permiso->listar();

                //Obtenemos los permisos asignados al usuario
                $id=$_GET['id'];
                $marcados = $usuario->listarmarcados($id);
                //Declarar el array para almacenar todos los permisos marcados
                $valores=array();

                //Almacenar los permisos asignados al usuario en el array
                while ($per = $marcados->fetch_object())
                {
                    array_push($valores, $per->idpermiso);
                }

                //recorremos por el obj reg todos los registros
                //mostrar la lista de permisos en la vista y si estan o no marcados ARRAY
                while ($reg = $rspta->fetch_object())
                    {   
                        //voy a conparar con inarray si 
                        $sw=in_array($reg->idpermiso,$valores)?'checked':'';
                        echo '<li> <input type="checkbox" '.$sw.' name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->PEnombre.'</li>'; 
                    }
            break;

            case 'verificar':
                
                //declaramos variables para obtener los valores de login y clave
                $logina=$_POST['logina'];
                $clavea=$_POST['clavea'];

                //Hash SHA256 en la contraseña
                $clavehash=hash("SHA256",$clavea);

                //enviamos los dos parametro login y clave a la funcion verificar
                $rspta=$usuario->verificar($logina, $clavehash);

                //guardo en los campos con la propiedad del fetch
                $fetch=$rspta->fetch_object();
                if(isset($fetch))
                {
                    //Declaramos las variables de sesion
                    $_SESSION['idusuario']=$fetch->idusuario;
                    $_SESSION['Ulogin']=$fetch->Ulogin;
                    $_SESSION['Uimagen']=$fetch->Uimagen;

                    //Obtenemos los permisos del usuario
                    $marcados = $usuario->listarmarcados($fetch->idusuario);

                    //Declaramos el array para almacenar todos los permisos marcados
                    $valores=array();

                    //Almacenamos los permisos marcados en el array
                    while ($per = $marcados->fetch_object()) {
                        array_push($valores, $per->idpermiso);
                    }

                    //DETERMINAMOS LOS ACCESOS DEL USUARIO
                    in_array(1,$valores)?$_SESSION['']=1:$_SESSION['']=0;
                }
                echo json_encode($fetch);
            break;

            case 'salir':
                //limpiamos todas las variables de session
                session_unset();
                //destruimos la session
                session_destroy();
                //rediccionamos al login
                header("Location: ../index.php");
            break;  
    }
?>