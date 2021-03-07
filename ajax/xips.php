<?php
    require_once "../modelos/mips.php";

    $ips=new Ips();

    $idips=isset($_POST["idips"])? limpiarCadena($_POST["idips"]):"";
    $idarea=isset($_POST["idarea"])? limpiarCadena($_POST["idarea"]):"";
   
    $idpersona=isset($_POST["idpersona"])? limpiarCadena($_POST["idpersona"]):"";
    $idequipo=isset($_POST["idequipos"])? limpiarCadena($_POST["idequipos"]):"";
    $idTipoEquipo =isset($_POST["IPtipoequipo"])? limpiarCadena($_POST["IPtipoequipo"]):"";
    $IPnumips=isset($_POST["IPnumips"])? limpiarCadena($_POST["IPnumips"]):"";
    $IPnumdns=isset($_POST["IPnumdns"])? limpiarCadena($_POST["IPnumdns"]):"";
    $IPnumproxy=isset($_POST["IPnumproxy"])? limpiarCadena($_POST["IPnumproxy"]):"";
    $IPnumpuertoproxy=isset($_POST["IPnumpuertoproxy"])? limpiarCadena($_POST["IPnumpuertoproxy"]):"";
    $IPusuariocredencial=isset($_POST["IPusuariocredencial"])? limpiarCadena($_POST["IPusuariocredencial"]):"";
    $IPclavecreencial=isset($_POST["IPclavecreencial"])? limpiarCadena($_POST["IPclavecreencial"]):"";
    

    switch ($_GET["op"]){
        //echo $_GET["op"] ? "Implemento Mouse registrado";
        case 'guardaryeditar':

            if(empty($idips)){
                $rspta=$ips->insertar($idarea, $idpersona, $idequipo,$IPnumips, $IPnumdns, $IPnumproxy, $IPnumpuertoproxy, $IPusuariocredencial, $IPclavecreencial,$idTipoEquipo);
                echo $rspta ? "Implemento ip registrado" : "Implemento teclado no se pudo registrar -- Area es ->>". $idarea;
            }
            else{
                $rspta=$ips->editar($idips, $idarea, $idpersona, $idequipo,$IPnumips, $IPnumdns, $IPnumproxy, $IPnumpuertoproxy, $IPusuariocredencial, $IPclavecreencial,$idTipoEquipo);
                echo $rspta ? "Implemento  actualizado" : "Implemento  no se pudo actualizado";
            }
            break;
        case 'desactivar':
                $rspta=$ips->desactivar($idips);
                echo $rspta ? "Implemento Teclado desactivado" : "Implemento teclado no se pudo desactivado";
                
            break;
        case 'activar':
                $rspta=$ips->activar($idips);
                echo $rspta ? "Implemento Teclado activado" : "Implemento teclado no se pudo activar";
                
            break;
        case 'mostrar':
                $rspta=$ips->mostrar($idips);
                //codificar el resultado utilizando json
                echo json_encode($rspta);
                
            break;
            
          case 'ver':
            
                $rspta=$ips->ver($idips);
                //codificar el resultado utilizando json
                echo json_encode($rspta);
                
            break;

        case 'listar':
                $rspta=$ips->listar();
                //vamos a declarar un array
                $data= Array();
                while ($reg=$rspta->fetch_object()){
                    $data[]=array(
                        "0"=>($reg->IPestado) ? '<button style="margin: 2px" class="btn btn-warning btn-sm" onclick="mostrar('.$reg->idips.')"><i class="fa fa-edit"></i></button>'. 
                        '<button style="margin: 2px" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ipsModal" onclick="ver('.$reg->idips.')"><i class="fa fa-eye"></i></button>'.
                        ' <button class="btn btn-danger btn-sm" onclick="desactivar('.$reg->idips.')"><i class="fa fa-times-circle"></i></button>' :
                        '<button style="margin: 2px" class="btn btn-warning btn-sm" onclick="mostrar('.$reg->idips.')"><i class="fa fa-edit"></i></button>'.
                        '<button style="margin: 2px" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ipsModal" onclick="ver('.$reg->idips.')"><i class="fa fa-eye"></i></button>'.
                        ' <button class="btn btn-primary btn-sm" onclick="activar('.$reg->idips.')"><i class="fa fa-times-circle"></i></button>',
                        "1"=>$reg->Asiglas,
                        "2"=>$reg->Anombre,
                        "3"=>$reg->TEdescription,
                        "4"=>$reg->IPnumips,
                        "5"=>$reg->PERnombre,
                        "6"=>$reg->idtipocargoemp,
                        "7"=>$reg->IPusuariocredencial,
                        "8"=>($reg->IPestado)?'<span class="badge badge-warning">Libre</span>':
                        '<span class="right badge badge-danger">Ocupado</span>'
                    );
                }

                $results = array(
                    "sEcho"=>1, //Informacion para el datatables
                    "iTotalRecords"=>count($data), //enviamos el total registros al datatable
                    "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
                    "aaData"=>$data);

                    echo json_encode($results);
            break;
            
            case 'selectarea':
                require_once "../modelos/marea.php";
                $Area = new Area();

                $rspta = $Area->select();

                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idarea . '>' . $reg->Anombre . '</option>';
                        /* Para obtener el texto */
                       // $("#txtmarcas").val(data.Mmarca);
                    }
            break;
           // idarea
            case 'selectpersona':
                require_once "../modelos/mpersona.php";
                $Persona = new Persona();

                $rspta = $Persona->select();

                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idpersona . '>' . $reg->PERnombre . '</option>';
                    }
            break;

            case 'selectlaptop':
                require_once "../modelos/mlaptop.php";
                $Laptop = new Laptop();

                $rspta = $Laptop->select();

                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idlaptop . '>' . $reg->Lmarca . '</option>';
                    }
            break;

            case 'selectordenador':
                require_once "../modelos/mordenador.php";
                $Ordenador = new Ordenador();

                $rspta = $Ordenador->select();

                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idordenador . '>' . $reg->Omarca . '</option>';
                    }
            break;

            case 'selectimpresora':
                require_once "../modelos/mimpresora.php";
                $Impresora = new Impresora();

                $rspta = $Impresora->select();

                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idimpresora . '>' . $reg->Icodigopatrimonial . '</option>';
                    }
            break;
            case 'selectipoEquipo':
                require_once "../modelos/mtipoEquipo.php";
              
                $tipo = new tipoEquipo();

                $rspta = $tipo->select();

                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idtipoequipo . '>' . $reg->TEdescription . '</option>';
                    }
            break;

         

            case 'selecEquipos':
                require_once "../modelos/mtipoEquipo.php";
                $id=$_GET["id"];
                $tipo = new tipoEquipo();

                $rspta = $tipo->ListarTipoDeEquipo($id);

                while ($reg = $rspta->fetch_object())
                    {
                        echo '<option value=' . $reg->idequipo . '>' .$reg->Codigopatrimonial.'-'.$reg->Marca . '</option>';
                    }
            break;
    }
?>