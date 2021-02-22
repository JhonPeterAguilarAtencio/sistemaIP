$("#frmAcceso").on('submit',function(e)
{
    e.preventDefault();
    logina=$("#logina").val();
    clavea=$("#clavea").val();

    $.post("../ajax/xusuario.php?op=verificar",
    {"logina":logina,"clavea":clavea}, 

    function(data)
    {
        if (data!="null")
        {
            $(location).attr("href","principal/dashboard.php");
        }
        else
        {
            alert("Usuario y/o Password incorrectos");
        }
    });
})