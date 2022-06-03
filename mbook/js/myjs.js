window.setTimeout(function() {
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
    $('#busquedaBtn').click(function() 
    {
        var x=parseInt(document.getElementById('busquedaBtnValue').value);
        //alert(x);
        if(x==1)
            document.getElementById('busquedaBtn').innerHTML="CERRAR PANEL DE BUSQUEDA";
        else
            document.getElementById('busquedaBtn').innerHTML="ABRIR PANEL DE BUSQUEDA";
        document.getElementById('busquedaBtnValue').value=document.getElementById('busquedaBtnValue').value*(-1);
    });   


});




function getLocation() 
{
    alert("Get Location");
    if (navigator.geolocation) 
    {
        alert("IF");
        navigator.geolocation.getCurrentPosition(showPosition, showError);
        alert("END IF");
    } 
    else 
    { 
        alert("ELSE");
        x.innerHTML = "Geolocation is not supported by this browser.";

    }
    alert("OUTSIDE");
}
