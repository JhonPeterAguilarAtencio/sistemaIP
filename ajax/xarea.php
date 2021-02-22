<?php
    require_once "../modelos/marea.php";

    $area=new Area();

    $idarea=isset($_POST["idarea"])? limpiarCadena($_POST["idarea"]):"";
    $Asiglas=isset($_POST["Asiglas"])? limpiarCadena($_POST["Asiglas"]):"";
    $Anombre=isset($_POST["Anombre"])? limpiarCadena($_POST["Anombre"]):"";
    $Adescripcion=isset($_POST["Adescripcion"])? limpiarCadena($_POST["Adescripcion"]):"";

    switch ($_GET["op"]){
        //echo $_GET["op"] ? "Implemento Teclado registrado";
        case 'guardaryeditar':

            if(empty($idarea)){
                $rspta=$area->insertar($Asiglas, $Anombre, $Adescripcion);
                echo $rspta ? "Area registrada" : "Area no se pudo registrar";
            }
            else{
                $rspta=$area->editar($idarea, $Asiglas, $Anombre, $Adescripcion);
                echo $rspta ? "Area actualizado" : "Area no se pudo actualizado";
            }
            break;
        case 'desactivar':
                $rspta=$area->desactivar($idarea);
                echo $rspta ? "Area desactivado" : "Area no se pudo desactivado";
                
            break;
        case 'activar':
                $rspta=$area->activar($idarea);
                echo $rspta ? "Area activado" : "Area no se pudo activar";
                
            break;
        case 'mostrar':
                $rspta=$area->mostrar($idarea);
                //codificar el resultado utilizando json
                echo json_encode($rspta);
                
            break;
        case 'listar':
                $rspta=$area->listar();
                //vamos a declarar un array
                $data= Array();
                while ($reg=$rspta->fetch_object()){
                    $data[]=array(
                        "0"=>($reg->Aestado) ? '<button class="btn btn-warning" onclick="mostrar('.$reg->idarea.')"><i class="fa fa-edit"></i></button>'.
                        ' <button class="btn btn-danger" onclick="desactivar('.$reg->idarea.')"><i class="fa fa-toggle-off"></i></button>':
                        '<button class="btn btn-warning" onclick="mostrar('.$reg->idarea.')"><i class="fa fa-edit"></i></button>'.
                        ' <button class="btn btn-primary" onclick="activar('.$reg->idarea.')"><i class="fa fa-check"></i></button>',
                        "1"=>$reg->Asiglas,
                        "2"=>$reg->Anombre,
                        "3"=>$reg->Adescripcion,
                        "4"=>($reg->Aestado)?'<span class="badge badge-primary">Activado</span>':
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
    }
?>