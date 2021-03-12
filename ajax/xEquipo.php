<?php
    require_once "../modelos/mequipos.php";
    require_once "../modelos/PartesEquipo.php";
    $ips=new Equipos();

    $Eidequipo      =isset($_POST["Eidequipo"])?limpiarCadena($_POST["Eidequipo"]):"";
    $IPtipoequipo   =isset($_POST["IPtipoequipo"])?limpiarCadena($_POST["IPtipoequipo"]):"";   
    $Ecodigo        =isset($_POST["Ecodigo"])?limpiarCadena($_POST["Ecodigo"]):"";
    $Emarca         =isset($_POST["Emarca"])?limpiarCadena($_POST["Emarca"]):"";
    $Emodelo        =isset($_POST["Emodelo"])?limpiarCadena($_POST["Emodelo"]):"";
    $idarea          =isset($_POST["idarea"])?limpiarCadena($_POST["idarea"]):"";
    $Eimagenactual  =isset($_POST["Eimagenactual"])?limpiarCadena($_POST["Eimagenactual"]):"";
    $EPartes        =isset($_POST["EPartes"])?limpiarCadena($_POST["EPartes"]):"";
    $Edtipoapoderado=isset($_POST["Edtipoapoderado"])?limpiarCadena($_POST["Edtipoapoderado"]):"";
    $Eidteclado     =isset($_POST["Eidteclado"])?limpiarCadena($_POST["Eidteclado"]):"";
    $Eidmouse       =isset($_POST["Eidmouse"])?limpiarCadena($_POST["Eidmouse"]):"";
    $Eidpantalla    =isset($_POST["Eidpantalla"])?limpiarCadena($_POST["Eidpantalla"]):"";
    $Eperteneciente =isset($_POST["Eperteneciente"])?limpiarCadena($_POST["Eperteneciente"]):"";
   
    switch ($_GET["op"]){        
        case 'guardaryeditar':
            $Estado=true;
            if(empty($Eidequipo)){
                if($EPartes=="1"){


                    $resultado=$ips->Existe($Ecodigo);
                    if($resultado>0){
                        echo "Ocupado";
                    }
                    else{
                        $par='1';
                        $IdEquipoLast=$ips->insertar($IPtipoequipo, $Ecodigo, $Emarca,$Emodelo, $idarea, $Eimagenactual,$Estado,"1",$Eperteneciente);
                        $ParteEquipo= new PartesEquipo();                  
                        $resul= $ParteEquipo->Ingresar($IdEquipoLast,$Eidteclado,$Eidmouse,$Eidpantalla,"12/12/2020");
                        echo $resul ? "Registrado Equipo" : "Implemento EQuopo no se pudo registrar ";  
                    }
                  
                
                
                }    
                else  if($EPartes=="0"){
                    $resultado=$ips->Existe($Ecodigo);
                    if($resultado>0){
                        echo "Ocupado";
                    }
                    else{
                    
                    $rspta=$ips->insertar($IPtipoequipo, $Ecodigo, $Emarca,$Emodelo, $idarea, $Eimagenactual,$Estado,"0",$Eperteneciente);
                    echo $rspta ? "Implemento ip registrado" : "Implemento teclado no se pudo registrar -- Area es ->>". $idarea;
                    }
                }                 
            }
            else{

                if ($EPartes=="1"){

                    $rspta=$ips->editar($Eidequipo,$IPtipoequipo, $Ecodigo, $Emarca,$Emodelo, $idarea, $Eimagenactual,$Estado,"0",$Eperteneciente);
                  ///  echo $rspta ? "Implemento  actualizado" : "Implemento  no se pudo actualizado";
                    $ParteEquipo= new PartesEquipo(); 
                    $resul= $ParteEquipo->editar($Eidequipo,$Eidteclado,$Eidmouse,$Eidpantalla,"12/12/2020");    
                    echo $rspta ? "Implemento  actualizado" : "Implemento  no se pudo actualizado";

                 }
                   else{
                    $rspta=$ips->editar($Eidequipo,$IPtipoequipo, $Ecodigo, $Emarca,$Emodelo, $idarea, $Eimagenactual,$Estado,"0",$Eperteneciente);
                    echo $rspta ? "Implemento  actualizado" : "Implemento  no se pudo actualizado";
                 }

                
            }
            break;
            case 'desactivar':
                $rspta=$ips->desactivar($Eidequipo);
                echo $rspta ? "Implemento Teclado desactivado" : "Implemento teclado no se pudo desactivado";
                
            break;
        case 'activar':
                $rspta=$ips->activar($Eidequipo);
                echo $rspta ? "Implemento Teclado activado" : "Implemento teclado no se pudo activar";
                
            break;
        case 'mostrar':
                $rspta=$ips->mostrar($Eidequipo);
            
                echo json_encode($rspta);
                
            break;
        case 'PartesEQuipo':
                 $ParteEquipo= new PartesEquipo();

                 $resul=$ParteEquipo->mostrar($Eidequipo);
            
                 echo json_encode($resul);
                
            break;
            
          case 'ver':         

               if($EPartes=="1"){
                $rspta=$ips->ver($Eidequipo);   
                        
                echo json_encode($rspta);
               }  else if($EPartes=="0"){
                $rspta=$ips->ver2($Eidequipo);                           
                echo json_encode($rspta);
               }
                   
                //echo $datos;                 
            break;

        case 'listar':
                $rspta=$ips->listar();
                             
                
                $data= Array();
                while ($reg=$rspta->fetch_object()){
                    $data[]=array(
                        "0"=>($reg->Estado) ? 
                        
                        '<button style="margin: 2px" class="btn btn-warning btn-sm" onclick="mostrar('.$reg->idequipo.')"><i class="fa fa-edit"></i></button>'.
                        '<button style="margin: 2px" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ordenadorModal" onclick="ver('.$reg->idequipo.','.$reg->Partes.')"><i class="fa fa-eye"></i></button>'.
                        ' <button style="margin: 0px" class="btn btn-danger btn-sm" onclick="desactivar('.$reg->idequipo.')"><i class="fa fa-times-circle"></i></button>' :
                        '<button style="margin: 2px" class="btn btn-warning btn-sm" onclick="mostrar('.$reg->idequipo.')"><i class="fa fa-edit"></i></button>'.
                        '<button style="margin: 2px" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ordenadorModal" onclick="ver('.$reg->idequipo.','.$reg->Partes.')"><i class="fa fa-eye"></i></button>'.
                        ' <button class="btn btn-primary btn-sm" onclick="activar('.$reg->idequipo.')"><i class="fa fa-check-square"></i></button>',
                           
                        "1"=>$reg->TEdescription,
                        "2"=>$reg->Codigopatrimonial,
                        "3"=>$reg->Marca,
                        "4"=>$reg->Modelo,
                        "5"=>$reg->Anombre,  
                        "6"=>($reg->Estado)?'<span class="badge badge-primary">A</span>':
                        '<span class="right badge badge-danger">D</span>'
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