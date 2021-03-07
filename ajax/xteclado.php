<?php
    require_once "../modelos/mteclado.php";

    $teclado=new Teclado();

    $idteclado=isset($_POST["idteclado"])? limpiarCadena($_POST["idteclado"]):"";
    $Tcodigopatrimonial=isset($_POST["Tcodigopatrimonial"])? limpiarCadena($_POST["Tcodigopatrimonial"]):""; 
    $Tmarca=isset($_POST["Tmarca"])? limpiarCadena($_POST["Tmarca"]):"";
    $Tmodelo=isset($_POST["Tmodelo"])? limpiarCadena($_POST["Tmodelo"]):"";
    $Tarea=isset($_POST["idarea"])? limpiarCadena($_POST["idarea"]):"";
    $Timagen=isset($_POST["Timagen"])? limpiarCadena($_POST["Timagen"]):"";

    switch ($_GET["op"]){
        //echo $_GET["op"] ? "Implemento Teclado registrado";
        case 'guardaryeditar':

            if (!file_exists($_FILES['Timagen']['tmp_name']) || !is_uploaded_file($_FILES['Timagen']['tmp_name']))
            {
                $Timagen=$_POST["Timagenactual"];
            }
            else{

                $ext = explode(".", $_FILES["Timagen"]["name"]);
                if ($_FILES['Timagen']['type'] == "image/jpg" || $_FILES['Timagen']['type'] == "image/jpeg" || 
                $_FILES['Timagen']['type'] == "image/png")
                {
                    $Timagen = round(microtime(true)) . '.' . end($ext);
                    move_uploaded_file($_FILES["Timagen"]["tmp_name"], "../files/teclados/" . $Timagen);
                }
            }

            if(empty($idteclado)){
                $rspta=$teclado->insertar($Tcodigopatrimonial, $Tmarca, $Tmodelo, $Tarea, $Timagen);
                echo $rspta ? "Implemento Teclado registrado" : "Implemento teclado no se pudo registrar";
            }
            else{
                $rspta=$teclado->editar($idteclado, $Tcodigopatrimonial, $Tmarca, $Tmodelo, $Tarea, $Timagen);
                echo $rspta ? "Implemento Teclado actualizado" : "Implemento teclado no se pudo actualizado";
            }
            break;
        case 'desactivar':
                $rspta=$teclado->desactivar($idteclado);
                echo $rspta ? "Implemento Teclado desactivado" : "Implemento teclado no se pudo desactivado";
                
            break;
        case 'activar':
                $rspta=$teclado->activar($idteclado);
                echo $rspta ? "Implemento Teclado activado" : "Implemento teclado no se pudo activar";
                
            break;
        case 'mostrar':
                $rspta=$teclado->mostrar($idteclado);
                //codificar el resultado utilizando json
                echo json_encode($rspta);
                
            break;
        case 'listar':
                $rspta=$teclado->listar();
                //vamos a declarar un array
                $data= Array();
                while ($reg=$rspta->fetch_object()){
                    $data[]=array(
                        "0"=>($reg->Testado) ? '<button class="btn btn-warning btn-sm" style="margin: 2px" onclick="mostrar('.$reg->idteclado.')"><i class="fa fa-edit"></i></button>'.
                        ' <button class="btn btn-danger btn-sm" style="margin: 2px" onclick="desactivar('.$reg->idteclado.')"><i class="fa fa-toggle-off"></i></button>':
                        '<button class="btn btn-warning btn-sm" style="margin: 2px" onclick="mostrar('.$reg->idteclado.')"><i class="fa fa-edit"></i></button>'.
                        ' <button class="btn btn-primary btn-sm" style="margin: 2px" onclick="activar('.$reg->idteclado.')"><i class="fa fa-check"></i></button>',
                        "1"=>$reg->Tcodigopatrimonial,
                        "2"=>$reg->Tmarca,
                        "3"=>$reg->Tmodelo,
                        "4"=>$reg->Anombre,   
                        "5"=>"<img src='../../files/teclados/".$reg->Timagen."' height='60px' width='60px' class='rounded' alt='Eniun'>",
                        "6"=>($reg->Testado)?'<span class="badge badge-primary">Activado</span>':
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
                $teclado = new Area();
                $rspta = $teclado->select();
                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idarea . '>' . $reg->Anombre . '</option>';
                        //echo ("#Mmarca").val($Mmarca).text();
                    }
            break;
    }
?>