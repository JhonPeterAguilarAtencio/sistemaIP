var tabla;

//funcion que se ejecute al inicio
function init()
{
    mostrarfrom(false);
    listado();

    $("#formulario1").on("submit",function(e)
    {
        guardaryeditar(e);
    });

    //Cargamos los items al select tipocodigo
    $.post("../../ajax/xips.php?op=selectarea", function(r){
        $("#idarea").html(r);
       // $('#idarea').selectpicker('refresh');
    });
    //Cargamos los items al select tipocodigo
    $.post("../../ajax/xips.php?op=selectpersona", function(r){
        $("#idpersona").html(r);
       // $('#idpersona').selectpicker('refresh');
    });
    //Cargamos los items al select tipocodigo
    $.post("../../ajax/xips.php?op=selectipoEquipo", function(r){
        $("#IPtipoequipo").html(r);
      //  $('#idordenador').selectpicker('refresh');
    });

    $("select[name=IPtipoequipo]").change(function () {
       
       var id = $('select[name=IPtipoequipo]').val(); 
       $.post("../../ajax/xips.php?op=selecEquipos&id="+id, function(r){
           $("#idequipos").html(r);
      //  $('#idordenador').selectpicker('refresh');
      });
       //alert(id_aula)
   });
    //Cargamos los items al select tipocodigo
  //  $.post("../../ajax/xips.php?op=selectlaptop", function(r){
   //     $("#idlaptop").html(r);
       // $('#idlaptop').selectpicker('refresh');
  //  });

    //Cargamos los items al select tipocodigo
   // $.post("../../ajax/xips.php?op=selectimpresora", function(r){
     //   $("#idimpresora").html(r);
     //   $('#idimpresora').selectpicker('refresh');
   // });
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
                url: '../../ajax/xips.php?op=listar',
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

//funcionn para editar y guardar
function guardaryeditar(e)
{
    
//alert("lllega aqui we")
    e.preventDefault(); //no se activara la accion predeterminada del evento
    $("#btnGuardar1").prop("disabled",true);
    var formData = new FormData($("#formulario1")[0]);

        console.log("datos",formData)
        $.ajax({
            url: "../../ajax/xips.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function(result)
            {
                //data = JSON.parse(dat os);
                if(result=="Ocupado"){
                    alert("Ip estaocupada para ese Equipo");
                    console.log(result);
                }else{  
                  console.log(result);                    
                  alert("REgistrado" );
                  mostrarfrom(false);
                  tabla.ajax.reload();
                }
               
            }, error: function (request, status, error) {
                alert("RE eroor ",);
                alert(request.responseText);
            }
        }).fail(function(){
            alert("errror");
             		})
     //   limpiar();

}

$("#btnverificar").click(function(){
    var data ={idTipoEquipo:"36",IPnumips:"123"}
    $.ajax({
        url: "../../ajax/xips.php?op=verificar",
        type: "POST",
        data: data,  
        success: function(result)
        {
           //  result = JSON.parse(result);
            console.log(result);               
           // alert(result );                
        }, error: function (request, status, error) {
        
            alert(request.responseText);
        }
    }).fail(function(error){
        alert(error);
 })
});
//FUNCION PARA EDITAR DATOS
function mostrar(idips)
{
    $.post("../../ajax/xips.php?op=mostrar",{idips : idips}, function(data, status)
    {
        data = JSON.parse(data);
        mostrarfrom(true);
        console.log(data);

        $("#idips").val(data.idips);
        $("#idarea").val(data.idarea);
        $("#idpersona").val(data.idpersona); 
        $("#IPtipoequipo").val(data.idTipoEQuipo); 
     
        $.get("../../ajax/xips.php?op=selecEquipos&id="+data.idTipoEQuipo, function(r){
            $("#idequipos").html(r);
            $("#idequipos").val(data.idequipo);        
       });
        $("#IPnumips").val(data.IPnumips); 
        $("#IPnumdns").val(data.IPnumdns); 
        $("#IPnumproxy").val(data.IPnumproxy);
        $("#IPnumpuertoproxy").val(data.IPnumpuertoproxy);
        $("#IPusuariocredencial").val(data.IPusuariocredencial);
        $("#IPclavecreencial").val(data.IPclavecreencial);
      
        //$("#IPtipoequipo").prop('disabled', true);
        //$("#idequipos").prop('disabled', true);
    })
}
function ver(idips)
{
    $.post("../../ajax/xips.php?op=ver",{idips : idips}, function(data, status)
    {
        data = JSON.parse(data);
  
        console.log(data);

        $("#txt0").text(data.Anombre);
        $("#txt1").text(data.TEdescription);
        $("#txt2").text(data.IPnumips); 
        $("#txt3").text(data.IPnumdns); 
        $("#txt4").text(data.IPnumproxy); 
        $("#txt5").text(data.IPnumpuertoproxy); 
        $("#txt6").text(data.IPusuariocredencial); 

        $("#txt7").text(data.IPclavecreencial); 
        $("#txt8").text(data.PERnombre); 
        $("#txt9").text(data.PERcargo); 
        $("#txt10").text(data.Codigopatrimonial); 
        $("#txt12").text(data.Marca); 
        $("#txt11").text(data.Modelo); 
      
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
            $.post("../../ajax/xips.php?op=desactivar",{idips : idips}, function(e){
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

            $.post("../../ajax/xips.php?op=activar",{idips : idips}, function(e){
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