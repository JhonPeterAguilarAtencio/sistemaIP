<?php
    require_once "../modelos/mlaptop.php";

    $laptop=new Laptop();

    $idlaptop=isset($_POST["idlaptop"])? limpiarCadena($_POST["idlaptop"]):"";
    $idtipocodigo=isset($_POST["idtipocodigo"])? limpiarCadena($_POST["idtipocodigo"]):"";
    $Lcodigo=isset($_POST["Lcodigo"])? limpiarCadena($_POST["Lcodigo"]):"";
    $Lmarca=isset($_POST["Lmarca"])? limpiarCadena($_POST["Lmarca"]):"";
    $Lmodelo=isset($_POST["Lmodelo"])? limpiarCadena($_POST["Lmodelo"]):"";
    $Larea=isset($_POST["Larea"])? limpiarCadena($_POST["Larea"]):"";
    $Limagen=isset($_POST["Limagen"])? limpiarCadena($_POST["Limagen"]):"";
    $idetipoequipo="2";
    switch ($_GET["op"]){
        //echo $_GET["op"] ? "Implemento Mouse registrado";
        case 'guardaryeditar':

            if (!file_exists($_FILES['Limagen']['tmp_name']) || !is_uploaded_file($_FILES['Limagen']['tmp_name']))
            {
                $Limagen=$_POST["Limagenactual"];
            }
            else{

                $ext = explode(".", $_FILES["Limagen"]["name"]);
                if ($_FILES['Limagen']['type'] == "image/jpg" || $_FILES['Limagen']['type'] == "image/jpeg" || 
                $_FILES['Limagen']['type'] == "image/png")
                {
                    $Limagen = round(microtime(true)) . '.' . end($ext);
                    move_uploaded_file($_FILES["Limagen"]["tmp_name"], "../files/laptops/" . $Limagen);
                }
            }

            if(empty($idlaptop)){
                $rspta=$laptop->insertar($idtipocodigo, $Lcodigo, $Lmarca, $Lmodelo, $Larea, $Limagen,$idetipoequipo);
              //  echo $rspta ? "Implemento mouse registrado" : "Implemento teclado no se pudo registrar";
                echo $rspta ;
            }
            else{
                $rspta=$laptop->editar($idlaptop, $idtipocodigo, $Lcodigo, $Lmarca, $Lmodelo, $Larea, $Limagen);
                echo $rspta ? "Implemento Teclado actualizado" : "Implemento teclado no se pudo actualizado";
            }
            break;
        case 'desactivar':
                $rspta=$laptop->desactivar($idlaptop);
                echo $rspta ? "Implemento Teclado desactivado" : "Implemento teclado no se pudo desactivado";
                
            break;
        case 'activar':
                $rspta=$laptop->activar($idlaptop);
                echo $rspta ? "Implemento Teclado activado" : "Implemento teclado no se pudo activar";
                
            break;
        case 'mostrar':
                $rspta=$laptop->mostrar($idlaptop);
                //codificar el resultado utilizando json
                echo json_encode($rspta);
                
            break;
        case 'listar':
                $rspta=$laptop->listar();
                //vamos a declarar un array
                $data= Array();
                while ($reg=$rspta->fetch_object()){
                    $data[]=array(
                        "0"=>($reg->Lestado) ? '<button class="btn btn-warning" onclick="mostrar('.$reg->idlaptop.')"><i class="fa fa-edit"></i></button>'.
                        ' <button class="btn btn-danger" onclick="desactivar('.$reg->idlaptop.')"><i class="fa fa-toggle-off"></i></button>':
                        '<button class="btn btn-warning" onclick="mostrar('.$reg->idlaptop.')"><i class="fa fa-edit"></i></button>'.
                        ' <button class="btn btn-primary" onclick="activar('.$reg->idlaptop.')"><i class="fa fa-check"></i></button>',
                        "1"=>$reg->tiponombre,
                        "2"=>$reg->Lcodigo,
                        "3"=>$reg->Lmarca,
                        "4"=>$reg->Lmodelo,
                        "5"=>$reg->Larea,   
                        "6"=>"<img src='../../files/laptops/".$reg->Limagen."' height='60px' width='60px' class='rounded' alt='Eniun'>",
                        "7"=>($reg->Lestado)?'<span class="badge badge-primary">Activado</span>':
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

        case 'selectTipocodigo':
                require_once "../modelos/mtipocodigo.php";
                $tipocodigo = new Tipocodigo();

                $rspta = $tipocodigo->select();

                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idtipocodigo . '>' . $reg->TCnombre . '</option>';
                    }
            break;
                    
            case 'selectArea':
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