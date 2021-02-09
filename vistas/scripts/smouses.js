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

    $("#Mimagenmuestra").hide();
}

//funcion Limpiar
function limpiar()
{
    $("#idmouse").val("");
    $("#Mcodigopatrimonial").val("");
    $("#Mmarca").val(""); 
    $("#Mmodelo").val(""); 
    $("#Marea").val("");
    $("#Mimagen").val("");
    $("#Mimagenmuestra").attr("src","");
    $("#Mimagenactual").val("");

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
                url: '../../ajax/xmouses.php?op=listar',
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
                url: "../../ajax/xmouses.php?op=guardaryeditar",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
        
                success: function(datos)
                {
                    //alert(datos);
                    Swal.fire(
                        'Registrado!',
                        'Teclado',
                        'success'
                      )
                    mostrarfrom(false);
                    tabla.ajax.reload();
                }
            });
            limpiar();
        }
    })

}

//FUNCION PARA EDITAR DATOS
function mostrar(idmouse)
{
    $.post("../../ajax/xmouses.php?op=mostrar",{idmouse : idmouse}, function(data, status)
    {
        data = JSON.parse(data);
        mostrarfrom(true);

        $("#Mcodigopatrimonial").val(data.Mcodigopatrimonial);
        $("#Mmarca").val(data.Mmarca); 
        $("#Mmodelo").val(data.Mmodelo); 
        $("#Marea").val(data.Marea); 
        $("#Mimagenmuestra").show();
        $("#Mimagenmuestra").attr("src","../../files/mouse/"+data.Mimagen);
        $("#Mimagenactual").val(data.Mimagen);
        $("#idmouse").val(data.idmouse); 

    })
}

//FUNCION PARA DESACTIVAR REGISTROS

function desactivar(idmouse)
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
            $.post("../../ajax/xmouses.php?op=desactivar",{idmouse : idmouse}, function(e){
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
function activar(idmouse)
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

            $.post("../../ajax/xmouses.php?op=activar",{idmouse : idmouse}, function(e){
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