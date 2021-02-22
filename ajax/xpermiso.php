<?php
    require_once "../modelos/mpermiso.php"; 

    $permiso=new Permiso();

    switch ($_GET["op"]){

        case 'listar':
                $rspta=$permiso->listar();
                //vamos a declarar un array
                $data= Array();

                while ($reg=$rspta->fetch_object()){
                    $data[]=array(
                        "0"=>$reg->idpermiso,
                        "1"=>$reg->PEnombre
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