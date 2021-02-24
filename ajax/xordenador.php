
<?php
    require_once "../modelos/mordenador.php";
    require_once "../modelos/PartesEquipo.php";

    $ordenador=new Ordenador();
   
    $idordenador=isset($_POST["idordenador"])? limpiarCadena($_POST["idordenador"]):"";
    $Codigopatrimonial=isset($_POST["Ocodigopatrimonial"])? limpiarCadena($_POST["Ocodigopatrimonial"]):"";
    $Marca=isset($_POST["Omarca"])? limpiarCadena($_POST["Omarca"]):"";
    $Modelo=isset($_POST["Omodelo"])? limpiarCadena($_POST["Omodelo"]):"";
    $Area=isset($_POST["Oarea"])? limpiarCadena($_POST["Oarea"]):"";
    $Estado="1";
    $Partes=true;
    $Perteneciente="Propio";
    $Imagen=isset($_POST["Oimagen"])? limpiarCadena($_POST["Oimagen"]):"";
    $idmouse=isset($_POST["idmouse"])? limpiarCadena($_POST["idmouse"]):"";
    $idteclado=isset($_POST["idteclado"])? limpiarCadena($_POST["idteclado"]):"";
    $idpantalla=isset($_POST["idpantalla"])? limpiarCadena($_POST["idpantalla"]):"";
    $idetipoequipo="1";

    switch ($_GET["op"]){
        //echo $_GET["op"] ? "Implemento Mouse registrado";
        case 'guardaryeditar':

            if (!file_exists($_FILES['Oimagen']['tmp_name']) || !is_uploaded_file($_FILES['Oimagen']['tmp_name']))
            {
                $Oimagen=$_POST["Oimagenactual"];
            }
            else{

                $ext = explode(".", $_FILES["Oimagen"]["name"]);
                if ($_FILES['Oimagen']['type'] == "image/jpg" || $_FILES['Oimagen']['type'] == "image/jpeg" || 
                $_FILES['Oimagen']['type'] == "image/png")
                {
                    $Oimagen = round(microtime(true)) . '.' . end($ext);
                    move_uploaded_file($_FILES["Oimagen"]["tmp_name"], "../files/ordenador/" . $Oimagen);
                }
            }

            if(empty($idordenador)){
                $rspta=$ordenador->insertar($idetipoequipo, $Codigopatrimonial, $Marca, $Modelo, $Area, $Imagen, $Estado,$Partes,$Perteneciente);
              //  $rspta=$ordenador->insertar($Ocodigopatrimonial, $Omarca, $Omodelo, $Oarea, $Oimagen, $idmouse,
             //    $idteclado, $idpantalla,$idetipoequipo);
                 $PartesEqui= new PartesEquipo();
                 $id="1";
                 $resul=  $PartesEqui->Ingresar($rspta,$idteclado,$idmouse,$idpantalla,"12/12/2020");
                 echo  $resul;              
               // echo $rspta ? "Implemento mouse registrado" : "Implemento teclado no se pudo registrar";
            }
            else{
                $rspta=$ordenador->editar($idordenador, $Ocodigopatrimonial, $Omarca, $Omodelo, $Oarea, $Oimagen, $idmouse,
                $idteclado, $idpantalla);
                echo $rspta ? "Implemento Teclado actualizado" : "Implemento teclado no se pudo actualizado";
            }
            break;
        case 'desactivar':
                $rspta=$ordenador->desactivar($idordenador);
                echo $rspta ? "Implemento Teclado desactivado" : "Implemento teclado no se pudo desactivado";
                
            break;
        case 'activar':
                $rspta=$ordenador->activar($idordenador);
                echo $rspta ? "Implemento Teclado activado" : "Implemento teclado no se pudo activar";
                
            break;
        case 'mostrar':
                $rspta=$ordenador->mostrar($idordenador);
                //codificar el resultado utilizando json
                echo json_encode($rspta);
                
            break;
            
          case 'ver':
            
                $rspta=$ordenador->ver($idordenador);
                //codificar el resultado utilizando json
                echo json_encode($rspta);
                
            break;

        case 'listar':
                $rspta=$ordenador->listar();
                //vamos a declarar un array
                $data= Array();
                while ($reg=$rspta->fetch_object()){
                    $data[]=array(
                        "0"=>($reg->Estado) ? '<button class="btn btn-warning" onclick="mostrar('.$reg->idequipo.')"><i class="fa fa-edit"></i></button>'. 
                        ' <button class="btn btn-info" data-toggle="modal" data-target="#ordenadorModal" onclick="ver('.$reg->idequipo.')"><i class="fa fa-eye"></i></button>'.
                        ' <button class="btn btn-danger" onclick="desactivar('.$reg->idequipo.')"><i class="fa fa-toggle-off"></i></button>' :
                        '<button class="btn btn-warning" onclick="mostrar('.$reg->idequipo.')"><i class="fa fa-edit"></i></button>'.
                        ' <button class="btn btn-info" data-toggle="modal" data-target="#ordenadorModal" onclick="ver('.$reg->idequipo.')"><i class="fa fa-eye"></i></button>'.
                        ' <button class="btn btn-primary" onclick="activar('.$reg->idequipo.')"><i class="fa fa-check"></i></button>',
                        "1"=>$reg->Codigopatrimonial,
                        "2"=>$reg->Marca,
                        "3"=>$reg->Modelo,
                        "4"=>$reg->Area,   
                        "5"=>"<img src='../../files/ordenador/".$reg->Imagen."' height='60px' width='60px' class='rounded' alt='Eniun'>",
                        "6"=>($reg->Estado)?'<span class="badge badge-primary">Activado</span>':
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
            
            case 'selectcodigomouse':
                require_once "../modelos/mmouses.php";
                $Mouses = new Mouses();

                $rspta = $Mouses->select();

                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idmouse . '>' . $reg->Mcodigopatrimonial . '</option>';
                        /* Para obtener el texto */
                       // $("#txtmarcas").val(data.Mmarca);
                    }
            break;

            case 'selectcodigoteclado':
                require_once "../modelos/mteclado.php";
                $teclado = new Teclado();

                $rspta = $teclado->select();

                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idteclado . '>' . $reg->Tcodigopatrimonial . '</option>';
                    }
            break;

            case 'selectcodigopantalla':
                require_once "../modelos/mpantalla.php";
                $pantalla = new Pantalla();

                $rspta = $pantalla->select();

                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idpantalla . '>' . $reg->Pcodigopatrimonial . '</option>';
                    }
            break;
            case 'datos':
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