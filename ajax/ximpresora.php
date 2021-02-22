<?php
    require_once "../modelos/mimpresora.php";

    $Impresora=new Impresora();

    $idimpresora=isset($_POST["idimpresora"])? limpiarCadena($_POST["idimpresora"]):"";
    $Icodigopatrimonial=isset($_POST["Icodigopatrimonial"])? limpiarCadena($_POST["Icodigopatrimonial"]):""; 
    $Imarca=isset($_POST["Imarca"])? limpiarCadena($_POST["Imarca"]):"";
    $Imodelo=isset($_POST["Imodelo"])? limpiarCadena($_POST["Imodelo"]):"";
    $idarea=isset($_POST["idarea"])? limpiarCadena($_POST["idarea"]):"";
    $Iimagen=isset($_POST["Iimagen"])? limpiarCadena($_POST["Iimagen"]):"";

    switch ($_GET["op"]){
        //echo $_GET["op"] ? "Implemento Teclado registrado";
        case 'guardaryeditar':

            if (!file_exists($_FILES['Iimagen']['tmp_name']) || !is_uploaded_file($_FILES['Iimagen']['tmp_name']))
            {
                $Iimagen=$_POST["Iimagenactual"];
            }
            else{

                $ext = explode(".", $_FILES["Iimagen"]["name"]);
                if ($_FILES['Iimagen']['type'] == "image/jpg" || $_FILES['Iimagen']['type'] == "image/jpeg" || 
                $_FILES['Iimagen']['type'] == "image/png")
                {
                    $Iimagen = round(microtime(true)) . '.' . end($ext);
                    move_uploaded_file($_FILES["Iimagen"]["tmp_name"], "../files/impresora/" . $Iimagen);
                }
            }

            if(empty($idimpresora)){
                $rspta=$Impresora->insertar($Icodigopatrimonial, $Imarca, $Imodelo, $idarea, $Iimagen);
                echo $rspta ? "Implemento Teclado registrado" : "Implemento teclado no se pudo registrar";
            }
            else{
                $rspta=$Impresora->editar($idimpresora, $Icodigopatrimonial, $Imarca, $Imodelo, $idarea, $Iimagen);
                echo $rspta ? "Implemento Teclado actualizado" : "Implemento teclado no se pudo actualizado";
            }
            break;
        case 'desactivar':
                $rspta=$Impresora->desactivar($idimpresora);
                echo $rspta ? "Implemento Teclado desactivado" : "Implemento teclado no se pudo desactivado";
                
            break;
        case 'activar':
                $rspta=$Impresora->activar($idimpresora);
                echo $rspta ? "Implemento Teclado activado" : "Implemento teclado no se pudo activar";
                
            break;
        case 'mostrar':
                $rspta=$Impresora->mostrar($idimpresora);
                //codificar el resultado utilizando json
                echo json_encode($rspta);
                
            break;
        case 'listar':
                $rspta=$Impresora->listar();
                //vamos a declarar un array
                $data= Array();
                while ($reg=$rspta->fetch_object()){
                    $data[]=array(
                        "0"=>($reg->Iestado) ? '<button class="btn btn-warning" onclick="mostrar('.$reg->idimpresora.')"><i class="fa fa-edit"></i></button>'.
                        ' <button class="btn btn-danger" onclick="desactivar('.$reg->idimpresora.')"><i class="fa fa-toggle-off"></i></button>':
                        '<button class="btn btn-warning" onclick="mostrar('.$reg->idimpresora.')"><i class="fa fa-edit"></i></button>'.
                        ' <button class="btn btn-primary" onclick="activar('.$reg->idimpresora.')"><i class="fa fa-check"></i></button>',
                        "1"=>$reg->Icodigopatrimonial,
                        "2"=>$reg->Imarca,
                        "3"=>$reg->Imodelo,
                        "4"=>$reg->Anombre,   
                        "5"=>"<img src='../../files/impresora/".$reg->Iimagen."' height='60px' width='60px' class='rounded' alt='Eniun'>",
                        "6"=>($reg->Iestado)?'<span class="badge badge-primary">Activado</span>':
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

            case 'selectimpresora':
                require_once "../modelos/marea.php";
                $Impresora = new Area();

                $rspta = $Impresora->select();

                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idarea . '>' . $reg->Anombre . '</option>';
                        //echo ("#Mmarca").val($Mmarca).text();
                    }
            break;
    }
?>