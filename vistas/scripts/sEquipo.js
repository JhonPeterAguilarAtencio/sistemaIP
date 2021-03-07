var tabla;
var partes="";
//funcion que se ejecute al inicio
function init()
{
    mostrarfrom(false);
    listado();
   var estado="";
    $("#PartesEquipo").hide();
    $("#formulario").on("submit",function(e)
    {
        guardaryeditar(e);
    });

    //Cargamos los items al select tipocodigo
    $.get("../../ajax/xips.php?op=selectarea", function(r){
        $("#Earea").html(r);
       
    });
    //Cargamos los items al select tipocodigo PartesEquipo
  
    //Cargamos los items al select tipocodigo
    $.get("../../ajax/xips.php?op=selectipoEquipo", function(r){
    
        $("#IPtipoequipo").html(r);
      
    });

   $("select[name=IPtipoequipo]").change(function () {
      var id=""; 
      id = $('select[name=IPtipoequipo]').val(); 
      if(id=="1"){
         $("#PartesEquipo").show();
         estado="1";
         partes="si";
      } else if(id=="2"){
        $("#PartesEquipo").hide();
        estado="0";
        partes="no";
      } 
      else if (id=="3"){
        $("#PartesEquipo").hide();
        estado="0";
        partes="no"
      }

      if(estado="1"){
        $.post("../../ajax/xordenador.php?op=selectcodigomouse", function(r){
            $("#idmouse").html(r);
         
        });
        //Cargamos los items al select tipocodigo
        $.post("../../ajax/xordenador.php?op=selectcodigoteclado", function(r){
            $("#idteclado").html(r);
           
        });
        //Cargamos los items al select tipocodigo
        $.post("../../ajax/xordenador.php?op=selectcodigopantalla", function(r){
            $("#idpantalla").html(r);
          
        });
      }    
     ///  $.post("../../ajax/xips.php?op=selecEquipos&id="+id, function(r){
      ///     $("#idequipos").html(r);
     ///
//});
       
        });
   
}

//funcion Limpiar
function limpiar()
{
    $("#idips").val("");
    $("#idarea").val("");
    $("#idpersona").val(""); 
    $("#IPtipoequipo").val(""); 
    $("#idlaptop").val("");
    $("#idordenador").val("");
    $("#idimpresora").val("");
    $("#IPnumips").val("");
    $("#IPnumdns").val("");
    $("#IPnumproxy").val("");
    $("#IPnumpuertoproxy").val("");
    $("#IPusuariocredencial").val("");
    $("#IPclavecreencial").val("");
    $("#IPnumproxy").val("");
}

//funcion mostrar formulario
function mostrarfrom(flag)
{
   // limpiar();
    if (flag)
    {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
      //  $("#btnGuardar").prop("disabled",false);
        $("#btnAgregar").hide();

    }
    else{
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnAgregar").show();
    }
}

//funcion cancelarfrom
function cancelarfrom()
{
    limpiar();
    mostrarfrom(false);
}

//funcion listar
function listado()
{
    tabla=$('#tbllistado').dataTable(
        {
        "aProcessing": true,//Activamos el procedimiento del datatables
        "aServerSide": true,//Paginamos y filtrado realizados por el servidor
        dom: 'Bfrtip',//Definimos los elementos del control de tabla
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
            ],
            "ajax":
            {
                url: '../../ajax/xequipo.php?op=listar',
                type : "get",
                dataType : "json",
                error: function(e){
                    console.log(e.responseText);
                }
            },
            "bDestroy": true,
            "iDisplayLength": 5, //Paginacion
            "order": [[ 0, "desc" ]] //Ordenar (columna, orden)
    }).DataTable();
}

//funcionn para editar y guardarEdtipoapoderado
function guardaryeditar(e)
{
    //init(); 
   // alert(partes)
    if(partes=="no")
    {
       //   e.preventDefault();      
            var data ={
            Eidequipo:      $("#idequipo").val(),    
            IPtipoequipo:   $("#IPtipoequipo").val(),
            Ecodigo:        $("#Ecodigo").val(),
            Emarca:         $("#Emarca").val(),
            Emodelo:        $("#Emodelo").val(),
            Earea:          $("#Earea").val(),
            Eimagen:        $("#Eimagen").val(),
            Eperteneciente:$('input:radio[name=perteneciente]:checked').val(),
            EPartes:"0"           
                      }         
            $.ajax({
                url: "../../ajax/xEquipo.php?op=guardaryeditar",
                type: "POST",
                data: data,  
                success: function(datos)
                {
                    console.log(datos);               
                    alert("Registrado",datos );                
                }, error: function (request, status, error) {
                
                    alert(request.responseText);
                }
            }).fail(function(){
                alert("errror");
         })
    }  else if(partes=="si"){
         
        var dataPartes={
            Eidequipo:      $("#idequipo").val(), 
            IPtipoequipo:       $("#IPtipoequipo").val(),
            Ecodigo:            $("#Ecodigo").val(),
            Emarca:             $("#Emarca").val(),
            Emodelo:            $("#Emodelo").val(),
            Earea:              $("#Earea").val(),
            Eimagen:            $("#Eimagen").val(),
            Eperteneciente:    $('input:radio[name=perteneciente]:checked').val(), 
            EPartes:"1"  ,
            Eidteclado:         $("#idteclado").val(),
            Eidmouse:           $("#idmouse").val(),
            Eidpantalla:        $("#idpantalla").val()
        }
        $.ajax({
            url: "../../ajax/xEquipo.php?op=guardaryeditar",
            type: "POST",
            data: dataPartes,  
            success: function(datos)
            {
                //console.log(datos);               
                alert("Registrado",datos );                
            }, error: function (request, status, error) {
            
                alert(request.responseText);
            }
        }).fail(function(error){
            alert(error);
     })
    }      
}

function ver(idequipo,partes)
{  
    
    $.post("../../ajax/xEquipo.php?op=ver",{Eidequipo : idequipo,EPartes:partes}, function(data, status)
    {
        data = JSON.parse(data);       
       
        $("#divpartes").hide();
       $("#txtOcodigopatrimonial").text(data.Codigopatrimonial); 
       $("#txtmarcaordenador").val(data.Marca); 
       $("#txtodelo").val(data.Modelo);
       $("#txtArea").val(data.Anombre);


       if(data.Partes=="1"){
        $("#divpartes").show();


        $("#txtcodigopatpantalla").val(data.Pcodigopatrimonial);
        $("#txtmarcapantalla1").val(data.Pmarca);
        
       } else{
        $("#divpartes").hide();
       }
       
    })
}

//FUNCION PARA EDITAR DATOS
function mostrar(idips)
{
    
    $.post("../../ajax/xequipo.php?op=mostrar",{Eidequipo : idips}, function(data, status)
    {
        data = JSON.parse(data);
       
        console.log(data);
      //  $("#idarea").val(data.idarea);
        if(data.Partes=="1"){
            partes="si";
            estado="1";
            $.post("../../ajax/xordenador.php?op=selectcodigomouse", function(r){
                $("#idmouse").html(r);
             
            });
            //Cargamos los items al select tipocodigo
            $.post("../../ajax/xordenador.php?op=selectcodigoteclado", function(r){
                $("#idteclado").html(r);
               
            });
            //Cargamos los items al select tipocodigo
            $.post("../../ajax/xordenador.php?op=selectcodigopantalla", function(r){
                $("#idpantalla").html(r);
              
            });
            $("#PartesEquipo").show();
            $.post("../../ajax/xequipo.php?op=PartesEQuipo",{Eidequipo : data.idequipo}, function(data, status)
            {
                data = JSON.parse(data);
                console.log(data);
                $("#idteclado").val(data.idteclado);
                $("#idmouse").val(data.idmouse);
                $("#idpantalla").val(data.idpantalla);
               // alert(data);
            })
          
           // alert(data.partes)
          //  Eidteclado:         $("#idteclado").val(),
          //  Eidmouse:           $("#idmouse").val(),
           // Eidpantalla:        $("#idpantalla").val()
       //    $("#PartesEquipo").show();
        }  else{
            partes="no";
        }
      
        mostrarfrom(true);
        if(data.Perteneciente=="Propio") {
            //alert$('#rbdpropio').checked = true
            $("#rbdpropio").prop("checked", true);
        } else if(data.Perteneciente=="Entidad"){
          //  $('#rbdentidad').checked = true
            $("#rbdentidad").prop("checked", true);
        }
        $("#idequipo").val(data.idequipo); 
        $("#IPtipoequipo").val(data.idtipoequipo);
        $("#Ecodigo").val(data.Codigopatrimonial); 
        $("#Emarca").val(data.Marca); 
        $("#Emodelo").val(data.Modelo); 
        $("#Earea").val(data.Area);



    })
}

//FUNCION PARA DESACTIVAR REGISTROS

function desactivar(idips)
{
    Swal.fire({
        title: '¿Estas Seguro de Desactivar?',
        text: "El estado del Teclado!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Desactivar!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.post("../../ajax/xEquipo.php?op=desactivar",{Eidequipo : idips}, function(e){
                //alert(e)
                Swal.fire(
                    'Desactivado!',
                    'El estado del Teclado',
                    'success'
                  )
                tabla.ajax.reload();
            });
        }
      })
}

//FUNCION PARA ACTIVAR REGISTROS
function activar(idips)
{
    Swal.fire({
        title: '¿Estas Seguro de Activar?',
        text: "El estado del Teclado!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Activar!'
      }).then((result) => {
        if (result.isConfirmed) {

            $.post("../../ajax/xEquipo.php?op=activar",{Eidequipo : idips}, function(e){
                //alert(e)
                Swal.fire(
                    'Activado!',
                    'El estado del Teclado',
                    'success'
                  )
                tabla.ajax.reload();
            });
        }
      })
}

init(); 