<?php
    require_once "../modelos/mmouses.php";

    $mouses=new Mouses();

    $idmouse=isset($_POST["idmouse"])? limpiarCadena($_POST["idmouse"]):"";
    $Mcodigopatrimonial=isset($_POST["Mcodigopatrimonial"])? limpiarCadena($_POST["Mcodigopatrimonial"]):""; 
    $Mmarca=isset($_POST["Mmarca"])? limpiarCadena($_POST["Mmarca"]):"";
    $Mmodelo=isset($_POST["Mmodelo"])? limpiarCadena($_POST["Mmodelo"]):"";
    $Marea=isset($_POST["idarea"])? limpiarCadena($_POST["idarea"]):"";
    $Mimagen=isset($_POST["Mimagen"])? limpiarCadena($_POST["Mimagen"]):"";
    
    switch ($_GET["op"]){
        //echo $_GET["op"] ? "Implemento Teclado registrado";
        case 'guardaryeditar':

            if (!file_exists($_FILES['Mimagen']['tmp_name']) || !is_uploaded_file($_FILES['Mimagen']['tmp_name']))
            {
                $Mimagen=$_POST["Mimagenactual"];
            }
            else{

                $ext = explode(".", $_FILES["Mimagen"]["name"]);
                if ($_FILES['Mimagen']['type'] == "image/jpg" || $_FILES['Mimagen']['type'] == "image/jpeg" || 
                $_FILES['Mimagen']['type'] == "image/png")
                {
                    $Mimagen = round(microtime(true)) . '.' . end($ext);
                    move_uploaded_file($_FILES["Mimagen"]["tmp_name"], "../files/mouse/" . $Mimagen);
                }
            }

            if(empty($idmouse)){


                $resultado=$mouses->Existe($Mcodigopatrimonial);
                if($resultado>0){
                    echo "Ocupado";
                }
                else{
                    $rspta=$mouses->insertar($Mcodigopatrimonial, $Mmarca, $Mmodelo, $Marea, $Mimagen);
                    echo $rspta ? "Implemento Teclado registrado" : "Implemento teclado no se pudo registrar";
                }
              
            }
            else{
                $rspta=$mouses->editar($idmouse, $Mcodigopatrimonial, $Mmarca, $Mmodelo, $Marea, $Mimagen);
                echo $rspta ? "Implemento Teclado actualizado" : "Implemento teclado no se pudo actualizado";
            }
            break;
        case 'desactivar':
                $rspta=$mouses->desactivar($idmouse);
                echo $rspta ? "Implemento Teclado desactivado" : "Implemento teclado no se pudo desactivado";
                
            break;
        case 'activar':
                $rspta=$mouses->activar($idmouse);
                echo $rspta ? "Implemento Teclado activado" : "Implemento teclado no se pudo activar";
                
            break;
        case 'mostrar':
                $rspta=$mouses->mostrar($idmouse);
                //codificar el resultado utilizando json
                echo json_encode($rspta);
                
            break;
        case 'listar':
                $rspta=$mouses->listar();
                //vamos a declarar un array
                $data= Array();
                while ($reg=$rspta->fetch_object()){
                    $data[]=array(
                        "0"=>($reg->Mestado) ? '<button class="btn btn-warning btn-sm" style="margin: 2px" onclick="mostrar('.$reg->idmouse.')"><i class="fa fa-edit"></i></button>'.
                        ' <button class="btn btn-danger btn-sm" style="margin: 2px" onclick="desactivar('.$reg->idmouse.')"><i class="fa fa-toggle-off"></i></button>':
                        '<button class="btn btn-warning btn-sm" style="margin: 2px" onclick="mostrar('.$reg->idmouse.')"><i class="fa fa-edit"></i></button>'.
                        ' <button class="btn btn-primary btn-sm" style="margin: 2px" onclick="activar('.$reg->idmouse.')"><i class="fa fa-check"></i></button>',
                        "1"=>$reg->Mcodigopatrimonial,
                        "2"=>$reg->Mmarca,
                        "3"=>$reg->Mmodelo,
                        "4"=>$reg->Anombre,   
                        "5"=>"<img src='../../files/mouse/".$reg->Mimagen."' height='60px' width='60px' class='rounded' alt='Eniun'>",
                        "6"=>($reg->Mestado)?'<span class="badge badge-primary">Activado</span>':
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
                $mouses = new Area();
                $rspta = $mouses->select();
                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idarea . '>' . $reg->Anombre . '</option>';
                        //echo ("#Mmarca").val($Mmarca).text();
                    }
            break;
    }
?>