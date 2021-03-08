<?php
    require_once "../modelos/mpantalla.php";

    $pantalla=new Pantalla();

    $idpantalla=isset($_POST["idpantalla"])? limpiarCadena($_POST["idpantalla"]):"";
    $Pcodigopatrimonial=isset($_POST["Pcodigopatrimonial"])? limpiarCadena($_POST["Pcodigopatrimonial"]):""; 
    $Pmarca=isset($_POST["Pmarca"])? limpiarCadena($_POST["Pmarca"]):"";
    $Pmodelo=isset($_POST["Pmodelo"])? limpiarCadena($_POST["Pmodelo"]):"";
    $Parea=isset($_POST["idarea"])? limpiarCadena($_POST["idarea"]):"";
    $Pimagen=isset($_POST["Pimagen"])? limpiarCadena($_POST["Pimagen"]):"";

    switch ($_GET["op"]){
        //echo $_GET["op"] ? "Implemento Pantalla registrado";
        case 'guardaryeditar':

            if (!file_exists($_FILES['Pimagen']['tmp_name']) || !is_uploaded_file($_FILES['Pimagen']['tmp_name']))
            {
                $Pimagen=$_POST["Pimagenactual"];
            }
            else{

                $ext = explode(".", $_FILES["Pimagen"]["name"]);
                if ($_FILES['Pimagen']['type'] == "image/jpg" || $_FILES['Pimagen']['type'] == "image/jpeg" || 
                $_FILES['Pimagen']['type'] == "image/png")
                {
                    $Pimagen = round(microtime(true)) . '.' . end($ext);
                    move_uploaded_file($_FILES["Pimagen"]["tmp_name"], "../files/pantallas/" . $Pimagen);
                }
            }

            if(empty($idpantalla)){
                $resultado=$pantalla->Existe($Pcodigopatrimonial);
                if($resultado>0){
                    echo "Ocupado";
                }
                else{
                    $rspta=$pantalla->insertar($Pcodigopatrimonial, $Pmarca, $Pmodelo, $Parea, $Pimagen);
                    echo $rspta ? "Implemento mouse registrado" : "Implemento teclado no se pudo registrar";
                }
               
            }
            else{
                $rspta=$pantalla->editar($idpantalla, $Pcodigopatrimonial, $Pmarca, $Pmodelo, $Parea, $Pimagen);
                echo $rspta ? "Implemento Teclado actualizado" : "Implemento teclado no se pudo actualizado";
            }
            break;
        case 'desactivar':
                $rspta=$pantalla->desactivar($idpantalla);
                echo $rspta ? "Implemento Teclado desactivado" : "Implemento teclado no se pudo desactivado";
                
            break;
        case 'activar':
                $rspta=$pantalla->activar($idpantalla);
                echo $rspta ? "Implemento Teclado activado" : "Implemento teclado no se pudo activar";
                
            break;
        case 'mostrar':
                $rspta=$pantalla->mostrar($idpantalla);
                //codificar el resultado utilizando json
                echo json_encode($rspta);
                
            break;
        case 'listar':
                $rspta=$pantalla->listar();
                //vamos a declarar un array
                $data= Array();
                while ($reg=$rspta->fetch_object()){
                    $data[]=array(
                        "0"=>($reg->Pestado) ? '<button class="btn btn-warning btn-sm" style="margin: 2px" onclick="mostrar('.$reg->idpantalla.')"><i class="fa fa-edit"></i></button>'.
                        ' <button class="btn btn-danger btn-sm" style="margin: 2px" onclick="desactivar('.$reg->idpantalla.')"><i class="fa fa-toggle-off"></i></button>':
                        '<button class="btn btn-warning btn-sm" style="margin: 2px" onclick="mostrar('.$reg->idpantalla.')"><i class="fa fa-edit"></i></button>'.
                        ' <button class="btn btn-primary btn-sm" style="margin: 2px" onclick="activar('.$reg->idpantalla.')"><i class="fa fa-check"></i></button>',
                        "1"=>$reg->Pcodigopatrimonial,
                        "2"=>$reg->Pmarca,
                        "3"=>$reg->Pmodelo,
                        "4"=>$reg->Anombre,   
                        "5"=>"<img src='../../files/pantallas/".$reg->Pimagen."' height='60px' width='60px' class='rounded' alt='Eniun'>",
                        "6"=>($reg->Pestado)?'<span class="badge badge-primary">Activado</span>':
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

            case 'selearea':
                require_once "../modelos/marea.php";
                $pantalla = new Area();
                $rspta = $pantalla->select();
                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idarea . '>' . $reg->Anombre . '</option>';
                        //echo ("#Mmarca").val($Mmarca).text();
                    }
            break;
    }
?>