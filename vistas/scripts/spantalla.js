var tabla;

//funcion que se ejecute al inicio
function init()
{
    mostrarfrom(false);
    listado();

    $("#formulario").on("submit",function(e)
    {
        guardaryeditar(e);
    });

    $("#Pimagenmuestra").hide();

    //Cargamos los items al select tipocodigo
    $.get("../../ajax/xpantalla.php?op=selearea", function(r){
        $("#idarea").html(r);
       
    });
}

//funcion Limpiar
function limpiar()
{
    $("#idpantalla").val("");
    $("#Pcodigopatrimonial").val("");
    $("#Pmarca").val(""); 
    $("#Pmodelo").val(""); 
    $("#idarea").val("");
    $("#Pimagen").val("");
    $("#Pimagenmuestra").attr("src","");
    $("#Pimagenactual").val("");

}

//funcion mostrar formulario
function mostrarfrom(flag)
{
    limpiar();
    if (flag)
    {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled",false);
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
                url: '../../ajax/xpantalla.php?op=listar',
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
    e.preventDefault(); //no se activara la accion predeterminada del evento
    $("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);

    Swal.fire({
        title: '¿Estas Seguro del Registro?',
        text: " del Teclado!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Ok!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "../../ajax/xpantalla.php?op=guardaryeditar",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
        
                success: function(resultado)
                {
                    console.log(resultado);
                    if(resultado=="Ocupado"){
                        alert("Codigo patrimonial ocuapdo por otro EQuipo o partes de equipo");
                      
                    }else{  
                        Swal.fire(
                            'Registrado!',
                            'Pantalla',
                            'success'
                          )
                        mostrarfrom(false);
                        tabla.ajax.reload();
                    }
                }
            });
            limpiar();
        }
    })

}

//FUNCION PARA EDITAR DATOS
function mostrar(idpantalla)
{
    $.post("../../ajax/xpantalla.php?op=mostrar",{idpantalla : idpantalla}, function(data, status)
    {
        data = JSON.parse(data);
        mostrarfrom(true);

        $("#Pcodigopatrimonial").val(data.Pcodigopatrimonial);
        $("#Pmarca").val(data.Pmarca); 
        $("#Pmodelo").val(data.Pmodelo); 
        $("#idarea").val(data.idarea); 
        $("#Pimagenmuestra").show();
        $("#Pimagenmuestra").attr("src","../../files/pantallas/"+data.Pimagen);
        $("#Pimagenactual").val(data.Pimagen);
        $("#idpantalla").val(data.idpantalla); 

    })
}

//FUNCION PARA DESACTIVAR REGISTROS

function desactivar(idpantalla)
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
            $.post("../../ajax/xpantalla.php?op=desactivar",{idpantalla : idpantalla}, function(e){
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
function activar(idpantalla)
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

            $.post("../../ajax/xpantalla.php?op=activar",{idpantalla : idpantalla}, function(e){
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
