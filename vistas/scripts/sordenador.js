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
    $.post("../../ajax/xordenador.php?op=selectcodigomouse", function(r){
        $("#idmouse").html(r);
        $('#idmouse').selectpicker('refresh');
    });
    //Cargamos los items al select tipocodigo
    $.post("../../ajax/xordenador.php?op=selectcodigoteclado", function(r){
        $("#idteclado").html(r);
        $('#idteclado').selectpicker('refresh');
    });
    //Cargamos los items al select tipocodigo
    $.post("../../ajax/xordenador.php?op=selectcodigopantalla", function(r){
        $("#idpantalla").html(r);
        $('#idpantalla').selectpicker('refresh');
    });

    $("#Oimagenmuestra").hide();
}

//funcion Limpiar
function limpiar()
{
    $("#idordenador").val("");
    $("#Ocodigopatrimonial").val("");
    $("#Omarca").val(""); 
    $("#Omodelo").val(""); 
    $("#Oarea").val("");
    $("#Oimagen").val("");
    $("#Oimagenmuestra").attr("src","");
    $("#Oimagenactual").val("");
    $("#idmouse").val("");
    $("#idteclado").val("");
    $("#idpantalla").val("");
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
                url: '../../ajax/xordenador.php?op=listar',
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
                url: "../../ajax/xordenador.php?op=guardaryeditar",
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
function mostrar(idordenador)
{
    $.post("../../ajax/xordenador.php?op=mostrar",{idordenador : idordenador}, function(data, status)
    {
        data = JSON.parse(data);
        mostrarfrom(true);
        console.log(data);
        $("#Ocodigopatrimonial").val(data.Ocodigopatrimonial);
        $("#Omarca").val(data.Omarca); 
        $("#Omodelo").val(data.Omodelo); 
        $("#Oarea").val(data.Oarea); 
        $("#Oimagenmuestra").show();
        $("#Oimagenmuestra").attr("src","../../files/ordenador/"+data.Oimagen);
        $("#Oimagenactual").val(data.Oimagen);
        $("#idmouse").val(data.idmouse);
        $("#idteclado").val(data.idteclado);
        $("#idpantalla").val(data.idpantalla);
        $("#idordenador").val(data.idordenador);
    })
}
function ver(idordenador)
{
  
    $.post("../../ajax/xordenador.php?op=ver",{idordenador : idordenador}, function(data, status)
    {
        data = JSON.parse(data);
       // mostrarfrom(true);
        console.log(data);
        //ordenador
        $("#txtmarcaordenador").val(data.Omarca);
        $("#txtOcodigopatrimonial").val(data.Ocodigopatrimonial);

        //teclado
        $("#txtpatrimonioanlteclado").val(data.Tcodigopatrimonial);
        $("#txtmarcateclado").val(data.Tmarca); 

       //pantalla 

        $("#txtcodigopatpantalla").val(data.Pcodigopatrimonial); 
        $("#txtmarcapantalla").val(data.Pmarca); 

        //mouse 
        $("#txtcodigomouse").val(data.Mcodigopatrimonial);
        $("#txtmarcamouse").val(data.Mmarca);

       
     

    })
}

//FUNCION PARA DESACTIVAR REGISTROS

function desactivar(idordenador)
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
            $.post("../../ajax/xordenador.php?op=desactivar",{idordenador : idordenador}, function(e){
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
function activar(idordenador)
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

            $.post("../../ajax/xordenador.php?op=activar",{idordenador : idordenador}, function(e){
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