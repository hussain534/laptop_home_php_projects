/*window.setTimeout(function() 
{
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 6000);
*/

function findAccessList() 
{
    //alert('inside');
    id_profile=document.getElementById("id_profile").value;
    //alert(idPerfil);
    idMenu=document.getElementById("idMenu").value;
    //alert(idMenu);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //document.getElementById("id_profile").value = this.responseText;
            location.reload();
        }
    };
    xmlhttp.open("GET", "loginController.php?task=10&id_profile="+id_profile+"&idMenu="+idMenu, true);
    xmlhttp.send();
}