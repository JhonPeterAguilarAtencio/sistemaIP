var tabla;

//funcion que se ejecute al inicio
function init()
{
    mostrarfrom(false);
    listado();

    $.post("../../ajax/xordenador.php?op=datos", function(r){
        //alert("AAAAAA");
      //  $("#perra").html(r);
        $("#Oarea1").html(r);
        $("#Oarea1").selectpicker('refresh');
    });

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

    $("select[name=idmouse]").change(function () {        
          var id = $('select[name=idmouse]').val();   
          var data={idmouse:id}
           $.ajax({
            url: "../../ajax/xmouses.php?op=mostrar",
            type: "POST",
            data: data,         
            success: function(datos)
            {  
                dato=jQuery.parseJSON(datos);
			    $('#txtmarcasmouse').val(dato['Mmarca']);
             
            },error: function(error){
               alert("ERror :"+error)
            }
        }); 
    });
    $("select[name=idpantalla]").change(function () {        
          var id = $('select[name=idpantalla]').val();   
          var data={idpantalla:id}
           $.ajax({
            url: "../../ajax/xpantalla.php?op=mostrar",
            type: "POST",
            data: data,         
            success: function(datos)
            {  // console.log(datos);
                dato=jQuery.parseJSON(datos);
               
			   $('#txtmarcapantalla').val(dato['Pmarca']);
             
            },error: function(error){
               alert("ERror :"+error)
            }
        }); 
    });
    $("select[name=idteclado]").change(function () {        
        var id = $('select[name=idteclado]').val();   
        var data={idteclado:id}
         $.ajax({
          url: "../../ajax/xteclado.php?op=mostrar",
          type: "POST",
          data: data,         
          success: function(datos)
          {   //console.log(datos);
              dato=jQuery.parseJSON(datos);
             
             $('#txtmarcateclado').val(dato['Tmarca']);
           
          },error: function(error){
             alert("ERror :"+error)
          }
      }); 
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
                  //  alert(datos);
                   
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
        $("#Ocodigopatrimonial").val(data.Codigopatrimonial);
        $("#Omarca").val(data.Marca); 
        $("#Omodelo").val(data.Modelo); 
        $("#Oarea").val(data.Area); 
        $("#Oimagenmuestra").show();
        $("#Oimagenmuestra").attr("src","../../files/ordenador/"+data.Imagen);
        $("#Oimagenactual").val(data.Imagen);
        $("#idmouse").val(data.idmouse);
        $("#idteclado").val(data.idteclado);
        $("#idpantalla").val(data.idpantalla);
        $("#idordenador").val(data.idequipo); 
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
        $("#txtmarcaordenador").val(data.Marca);
        $("#txtOcodigopatrimonial").val(data.Codigopatrimonial);

        //teclado
        $("#txtpatrimonioanlteclado").val(data.Tcodigopatrimonial);
        $("#txtmarcateclado1").val(data.teclados); 

       //pantalla 
        $("#txtcodigopatpantalla").val(data.Pcodigopatrimonial); 
        $("#txtmarcapantalla1").val(data.Pmarca); 
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