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

    //Cargamos los items al select tipocodigo
    $.post("../../ajax/xusuario.php?op=selectpersona", function(r){
        $("#idpersona").html(r);
        //$('#idpersona').selectpicker('refresh');
    });

     //Cargamos los items al select tipocodigo
     $.post("../../ajax/xusuario.php?op=selectcargousuario", function(r){
        $("#idtipocargousu").html(r);
        //$('#idpersona').selectpicker('refresh');
    });

    $("#Uimagenmuestra").hide();

    //Mostramos los permisos
    $.post("../../ajax/xusuario.php?op=permisos&id=", function(r){
        $("#permisos").html(r);
        //$('#idpersona').selectpicker('refresh');
    });
}

//funcion Limpiar
function limpiar()
{
    
    $("#idpersona").val("");
    $("#idtipocargousu").val(""); 
    $("#Ulogin").val(""); 
    $("#Uclave").val("");
    $("#Uimagen").val("");
    $("#Uimagenmuestra").attr("src","");
    $("#Uimagenactual").val("");
    $("#idusuario").val("");

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
                url: '../../ajax/xusuario.php?op=listar',
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
                url: "../../ajax/xusuario.php?op=guardaryeditar",
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
function mostrar(idusuario)
{
    $.post("../../ajax/xusuario.php?op=mostrar",{idusuario : idusuario}, function(data, status)
    {
        data = JSON.parse(data);
        mostrarfrom(true);

        $("#idpersona").val(data.idpersona);
        $("#idtipocargousu").val(data.idtipocargousu); 
        $("#Ulogin").val(data.Ulogin); 
        $("#Uclave").val(data.Uclave); 
        $("#Uimagenmuestra").show();
        $("#Uimagenmuestra").attr("src","../../files/usuario/"+data.Uimagen);
        $("#Uimagenactual").val(data.Uimagen);
        $("#idusuario").val(data.idusuario); 

    });

    //Mostramos los permisos
    $.post("../../ajax/xusuario.php?op=permisos&id="+idusuario, function(r){
        $("#permisos").html(r);
        //$('#idpersona').selectpicker('refresh');
    });
}

//FUNCION PARA DESACTIVAR REGISTROS

function desactivar(idusuario)
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
            $.post("../../ajax/xusuario.php?op=desactivar",{idusuario : idusuario}, function(e){
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
function activar(idusuario)
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

            $.post("../../ajax/xusuario.php?op=activar",{idusuario : idusuario}, function(e){
                //alert(e)
                Swal.fire(
                    'Activado!',
                    'El estado del Usuario',
                    'success'
                  )
                tabla.ajax.reload();
            });
        }
      })
}

init(); 
