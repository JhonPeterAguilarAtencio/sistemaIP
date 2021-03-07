<?php
    require_once "../modelos/mpersona.php";

    $persona=new Persona();

    $idpersona=isset($_POST["idpersona"])? limpiarCadena($_POST["idpersona"]):"";
    $PERdni=isset($_POST["PERdni"])? limpiarCadena($_POST["PERdni"]):""; 
    $PERnombre=isset($_POST["PERnombre"])? limpiarCadena($_POST["PERnombre"]):"";
    $PERapellidos=isset($_POST["PERapellidos"])? limpiarCadena($_POST["PERapellidos"]):"";
    $idtipocargoemp=isset($_POST["idtipocargoemp"])? limpiarCadena($_POST["idtipocargoemp"]):"";
    $PERtelefono=isset($_POST["PERtelefono"])? limpiarCadena($_POST["PERtelefono"]):"";
    $PERemail=isset($_POST["PERemail"])? limpiarCadena($_POST["PERemail"]):"";
    $PERarea=isset($_POST["idarea"])? limpiarCadena($_POST["idarea"]):"";
    $PERimagen=isset($_POST["PERimagen"])? limpiarCadena($_POST["PERimagen"]):"";

    switch ($_GET["op"]){
        //echo $_GET["op"] ? "Implemento Teclado registrado";
        case 'guardaryeditar':

            if (!file_exists($_FILES['PERimagen']['tmp_name']) || !is_uploaded_file($_FILES['PERimagen']['tmp_name']))
            {
                $PERimagen=$_POST["PERimagenactual"];
            }
            else{

                $ext = explode(".", $_FILES["PERimagen"]["name"]);
                if ($_FILES['PERimagen']['type'] == "image/jpg" || $_FILES['PERimagen']['type'] == "image/jpeg" || 
                $_FILES['PERimagen']['type'] == "image/png")
                {
                    $PERimagen = round(microtime(true)) . '.' . end($ext);
                    move_uploaded_file($_FILES["PERimagen"]["tmp_name"], "../files/personas/" . $PERimagen);
                }
            }

            if(empty($idpersona)){
                $rspta=$persona->insertar($PERdni, $PERnombre, $PERapellidos, $idtipocargoemp, $PERtelefono, $PERemail, $PERarea, $PERimagen);
                echo $rspta ? "Implemento Teclado registrado" : "Implemento teclado no se pudo registrar";
            }
            else{
                $rspta=$persona->editar($idpersona, $PERdni, $PERnombre, $PERapellidos, $idtipocargoemp, $PERtelefono, $PERemail, $PERarea, $PERimagen);
                echo $rspta ? "Implemento Teclado actualizado" : "Implemento teclado no se pudo actualizado";
            }
            break;
        case 'desactivar':
                $rspta=$persona->desactivar($idpersona);
                echo $rspta ? "Implemento Teclado desactivado" : "Implemento teclado no se pudo desactivado";
                
            break;
        case 'activar':
                $rspta=$persona->activar($idpersona);
                echo $rspta ? "Implemento Teclado activado" : "Implemento teclado no se pudo activar";
                
            break;
        case 'mostrar':
                $rspta=$persona->mostrar($idpersona);
                //codificar el resultado utilizando json
                echo json_encode($rspta);
                
            break;
        case 'listar':
                $rspta=$persona->listar();
                //vamos a declarar un array
                $data= Array();
                while ($reg=$rspta->fetch_object()){
                    $data[]=array(
                        "0"=>($reg->PERestado) ? '<button class="btn btn-warning btn-sm" style="margin: 2px" onclick="mostrar('.$reg->idpersona.')"><i class="fa fa-edit"></i></button>'.
                        ' <button class="btn btn-danger btn-sm" style="margin: 2px" onclick="desactivar('.$reg->idpersona.')"><i class="fa fa-toggle-off"></i></button>':
                        '<button class="btn btn-warning btn-sm" style="margin: 2px" onclick="mostrar('.$reg->idpersona.')"><i class="fa fa-edit"></i></button>'.
                        ' <button class="btn btn-primary btn-sm" style="margin: 2px" onclick="activar('.$reg->idpersona.')"><i class="fa fa-check"></i></button>',
                        "1"=>$reg->PERdni,
                        "2"=>$reg->PERnombre ." ".$reg->PERapellidos,
                        "3"=>$reg->TCEnombre,
                        "4"=>$reg->PERtelefono,
                        "5"=>$reg->PERemail,
                        "6"=>$reg->Anombre,
                        "7"=>"<img src='../../files/personas/".$reg->PERimagen."' height='60px' width='60px' class='rounded' alt='Eniun'>",
                        "8"=>($reg->PERestado)?'<span class="badge badge-warning">A</span>':
                        '<span class="right badge badge-danger">I</span>'
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
                $persona = new Area();
                $rspta = $persona->select();
                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idarea . '>' . $reg->Anombre . '</option>';
                        //echo ("#Mmarca").val($Mmarca).text();
                    }
            break;

            case 'selecargoempleado':
                require_once "../modelos/mcargoempleado.php";
                $persona = new Tipocargoempleado();
                $rspta = $persona->select();
                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idtipocargoemp . '>' . $reg->TCEnombre . '</option>';
                        //echo ("#Mmarca").val($Mmarca).text();
                    }
            break;

    }
?>