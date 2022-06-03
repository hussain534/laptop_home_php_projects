window.setTimeout(function() 
{
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 6000);

$(document).ready(function()
{
    $('img').each(function() 
    {
        $(this).attr('height','600px');
    });

    $("#consultarAlepo").click(function()
    {
        //alert('inside');
        consulta_integrador=document.getElementById("consulta_integrador").value;
        //alert(consulta_integrador);
        consulta_fecha_conciliacion=document.getElementById("consulta_fecha_conciliacion").value;
        //alert(consulta_fecha_conciliacion);
        if(consulta_fecha_conciliacion=="")
        {
            alert('FECHA CONCILIACION PARA CONSULTAR DATOS NO DEBE SER NULL');
        }
        else
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    //document.getElementById("idPerfil").value = this.responseText;
                    location.reload();
                    //alert(this.responseText);
                }
            };
            xmlhttp.open("GET", "controladorProceso.php?proceso=3&task=4&consulta_integrador="+consulta_integrador+"&consulta_fecha_conciliacion="+consulta_fecha_conciliacion, true);
            xmlhttp.send();
        }
        
    }); 
});

function buscarPermisos() 
{
    //alert('inside');
    idPerfil=document.getElementById("idPerfil").value;
    //alert(idPerfil);
    idMenu=document.getElementById("idMenu").value;
    //alert(idMenu);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //document.getElementById("idPerfil").value = this.responseText;
            location.reload();
        }
    };
    xmlhttp.open("GET", "controladorProceso.php?proceso=6&task=3&idPerfil="+idPerfil+"&idMenu="+idMenu, true);
    xmlhttp.send();
}