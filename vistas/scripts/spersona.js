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

    $("#PERimagenmuestra").hide();

    //Cargamos los items al select tipocodigo
    $.get("../../ajax/xpersona.php?op=selearea", function(r){
        $("#idarea").html(r);
       
    });

    //Cargamos los items al select tipocodigo
    $.get("../../ajax/xpersona.php?op=selecargoempleado", function(r){
        $("#idtipocargoemp").html(r);
       
    });
}

//funcion Limpiar
function limpiar()
{
    $("#idpersona").val("");
    $("#PERdni").val("");
    $("#PERnombre").val(""); 
    $("#PERapellidos").val("");
    $("#idtipocargoemp").val("");
    $("#PERtelefono").val("");
    $("#PERemail").val("");
    $("#idarea").val("");
    $("#PERimagen").val("");
    $("#PERimagenmuestra").attr("src","");
    $("#PERimagenactual").val("");

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
                url: '../../ajax/xpersona.php?op=listar',
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
    //$("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);

    Swal.fire({
        title: '¿Estas Seguro del Registro?',
        text: " del Persoma!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Ok!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "../../ajax/xpersona.php?op=guardaryeditar",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
        
                success: function(result)
                {
                    if(result=="Ocupado"){
                        alert("Este Dni ya existe We");
                        console.log(result);
                    }else{  
                        Swal.fire(
                            'Registrado!',
                            'Persona',
                            'success'
                          )
                        mostrarfrom(false);
                        tabla.ajax.reload();
                        limpiar();
                    }
                   
                }
            });
           
        }
    })

}

//FUNCION PARA EDITAR DATOS
function mostrar(idpersona)
{
    $.post("../../ajax/xpersona.php?op=mostrar",{idpersona : idpersona}, function(data, status)
    {
        data = JSON.parse(data);
        mostrarfrom(true);

        $("#PERdni").val(data.PERdni);
        $("#PERnombre").val(data.PERnombre); 
        $("#PERapellidos").val(data.PERapellidos);
        $("#idtipocargoemp").val(data.idtipocargoemp);
        $("#PERtelefono").val(data.PERtelefono);
        $("#PERemail").val(data.PERemail);
        $("#idarea").val(data.idarea);
        $("#PERimagenmuestra").show();
        $("#PERimagenmuestra").attr("src","../../files/personas/"+data.PERimagen);
        $("#PERimagenactual").val(data.PERimagen);
        $("#idpersona").val(data.idpersona); 

    })
}

//FUNCION PARA DESACTIVAR REGISTROS

function desactivar(idpersona)
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
            $.post("../../ajax/xpersona.php?op=desactivar",{idpersona : idpersona}, function(e){
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
function activar(idpersona)
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

            $.post("../../ajax/xpersona.php?op=activar",{idpersona : idpersona}, function(e){
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