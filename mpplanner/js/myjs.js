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
    xmlhttp.open("GET", "002_aclController.php?task=3&id_profile="+id_profile+"&idMenu="+idMenu, true);
    xmlhttp.send();
}

function findProfileList() 
{
    //alert('inside');
    /*$id=$users[0][0];
    $user_name=$users[0][1];
    $user_email=$users[0][2];
    $user_phone=$users[0][3];
    $user_mobile=$users[0][4];
    $user_address=$users[0][5];
    $user_profile_id=$users[0][6];
    $user_profile_name=$users[0][7];
    $user_client_id=$users[0][8];
    $user_client_name=$users[0][9];
    $user_cost_per_hour=$users[0][10];
    $user_joining_dt=$users[0][11];
    $user_red=$users[0][12];

    id=document.getElementById("id").value;
    user_name=document.getElementById("user_name").value;
    user_email=document.getElementById("user_email").value;
    user_phone=document.getElementById("user_phone").value;
    user_mobile=document.getElementById("user_mobile").value;
    user_address=document.getElementById("user_address").value;
    user_client_id=document.getElementById("user_client_id").value;
    user_profile_is=document.getElementById("user_profile_is").value;
    user_cost_per_hour=document.getElementById("user_cost_per_hour").value;
    user_joining_dt=document.getElementById("user_joining_dt").value;
    user_red=document.getElementById("user_red").value;*/

    user_client_id=document.getElementById("user_client_id").value;
    //alert('user_client_id:'+user_client_id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //alert(this.responseText);
            document.getElementById("user_profile_id").innerHTML = this.responseText;
            //location.reload();
        }
    };
    xmlhttp.open("GET", "002_aclController.php?task=6&cid="+user_client_id, true);
    xmlhttp.send();
}