$(document).ready(function()
{   
    //$('#emblema').hide();
    
    /*$("#addEntidad").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var entidad_name = window.document.getElementById("entidad_name").value;

        if(entidad_name==null || entidad_name=='')
            document.getElementById("error_entidad_name").innerHTML = "Por favor ingresa nombre del entidad!";
        else
            document.getElementById("error_entidad_name").innerHTML = "";
        
        if(entidad_name!=null && entidad_name!='')
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=1&metodo=0&nombre_entidad="+entidad_name, true);
            xmlhttp.send();
        }
        $('#progress').hide();
    });*/

    
});

function delDocument(id,desc)
{
    var xmlhttp = new XMLHttpRequest();
    //$('#progress').show();
    if(confirm('Estas seguro de eliminar el documento : '+desc.replace(/\+/g," ")))
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                //document.getElementById("tbl_entidad").innerHTML = this.responseText;
                location.reload();
            }
        };

        xmlhttp.open("GET", "datacontroller.php?dojob=1&metodo=1&id_doc="+id, true);
        xmlhttp.send();
    }
    //$('#progress').hide();
}

function delPuntos(id,puntaje,ganador)
{
    var xmlhttp = new XMLHttpRequest();
    //$('#progress').show();
    if(confirm('Estas seguro de eliminar '+puntaje+' puntos del ganador: '+ganador.replace(/\+/g," ")))
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                //document.getElementById("tbl_entidad").innerHTML = this.responseText;
                location.reload();
            }
        };

        xmlhttp.open("GET", "datacontroller.php?dojob=2&metodo=1&id_puntos="+id, true);
        xmlhttp.send();
    }
    //$('#progress').hide();
}


function delUsuario(user,nombre,apellido)
{
    var xmlhttp = new XMLHttpRequest();
    //$('#progress').show();
    if(confirm('Estas seguro de eliminar usuario: '+nombre.replace(/\+/g," ")+" "+apellido.replace(/\+/g," ")))
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                //document.getElementById("tbl_entidad").innerHTML = this.responseText;
                location.reload();
            }
        };

        xmlhttp.open("GET", "datacontroller.php?dojob=3&metodo=1&user="+user, true);
        xmlhttp.send();
    }
    //$('#progress').hide();
}

function getImpactoEmblema()
{
    var puntaje = document.getElementById("puntaje").value;
    //alert(puntaje);
    if(puntaje==1)
    {
        document.getElementById("impacto").value='SHURIKEN';
        document.getElementById("emblema").innerHTML='<img src="images/Shuriken_(-45).jpg"/>';
    }
    else if(puntaje==2)
    {
        document.getElementById("impacto").value='BAJO IMPACTO';
        document.getElementById("emblema").innerHTML='<img src="images/Bajo_Impacto.jpg"/>';
    }
    else if(puntaje==3)
    {
        document.getElementById("impacto").value='MEDIANO IMPACTO';
        document.getElementById("emblema").innerHTML='<img src="images/Mediano_Impacto.jpg"/>';
    }
    else if(puntaje==4)
    {
        document.getElementById("impacto").value='ALTO IMPACTO';
        document.getElementById("emblema").innerHTML='<img src="images/Alto_Impacto.jpg"/>';
    }

}

function addToListList(id)
{
    var myList = document.getElementById("id_equipos").value.split(",");
    var newList="";
    var ctr=0;
    //alert(myList);
    
    //alert(myList);
    for(var i=0;i<myList.length;i++)
    {
        if(myList[i]==",")
        {

        }
        else
        {
            if(id==myList[i])
                ctr++;
            else
            {   
                if(i==0)
                    newList=myList[i];
                else
                    newList=newList+","+myList[i];
            }
        }        
    }
    if(ctr==0)
        document.getElementById("id_equipos").value=newList+","+id;
    else
        document.getElementById("id_equipos").value=newList;
}

