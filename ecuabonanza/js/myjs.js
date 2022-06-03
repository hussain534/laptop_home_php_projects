window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 6000);

$(document).ready(function()
{
    $("#buscarNroDoc").click(function () 
    {   
        var cust_id_type = window.document.getElementById("client_doc_type").value;
        var cust_id_num = window.document.getElementById("client_ruc").value;
        //alert(cust_id_type+":"+cust_id_num);
        var validateData=0;
        if(cust_id_num==null || cust_id_num=='')
        {
            document.getElementById("error_cust_id_num").innerHTML = "Por favor ingresa nro. documento!";
            validateData=1;
        }
        else
            document.getElementById("error_cust_id_num").innerHTML = "";
        //alert(validateData);
        if(validateData==0)
        {
            document.getElementById("client_name").value = "";
            document.getElementById("client_phone").value = "";
            document.getElementById("client_email").value = "";
            document.getElementById("client_address").value = "";
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                   var myObj = JSON.parse(this.responseText);
                   //alert(myObj.length);
                   document.getElementById("client_name").value = myObj[0][2];
                   document.getElementById("client_phone").value = myObj[0][4];
                   document.getElementById("client_email").value = myObj[0][5];
                   document.getElementById("client_address").value = myObj[0][3];
                   //alert(this.responseText);
                }
            };

            xmlhttp.open("GET", "controller.php?controller=6&task=0&cust_id_type="+cust_id_type+"&cust_id_num="+cust_id_num, true);
            xmlhttp.send();
        }
    });

    $("#client_ruc").focusout(function () 
    {   
        var cust_id_type = window.document.getElementById("client_doc_type").value;
        var cust_id_num = window.document.getElementById("client_ruc").value;
        //alert(cust_id_type+":"+cust_id_num);
        var validateData=0;
        if(cust_id_num==null || cust_id_num=='')
        {
            document.getElementById("error_cust_id_num").innerHTML = "Por favor ingresa nro. documento!";
            validateData=1;
        }
        else
            document.getElementById("error_cust_id_num").innerHTML = "";
        //alert(validateData);
        if(validateData==0)
        {
            document.getElementById("client_name").value = "";
            document.getElementById("client_phone").value = "";
            document.getElementById("client_email").value = "";
            document.getElementById("client_address").value = "";
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                   var myObj = JSON.parse(this.responseText);
                   //alert(myObj.length);
                   document.getElementById("client_name").value = myObj[0][2];
                   document.getElementById("client_phone").value = myObj[0][4];
                   document.getElementById("client_email").value = myObj[0][5];
                   document.getElementById("client_address").value = myObj[0][3];
                   //alert(this.responseText);
                }
            };

            xmlhttp.open("GET", "controller.php?controller=6&task=0&cust_id_type="+cust_id_type+"&cust_id_num="+cust_id_num, true);
            xmlhttp.send();
        }
    });

    $("#client_ruc").on( "keypress", function(event)
    {   
        if(event.which == 13)
        {
            var cust_id_type = window.document.getElementById("client_doc_type").value;
            var cust_id_num = window.document.getElementById("client_ruc").value;
            //alert(cust_id_type+":"+cust_id_num);
            var validateData=0;
            if(cust_id_num==null || cust_id_num=='')
            {
                document.getElementById("error_cust_id_num").innerHTML = "Por favor ingresa nro. documento!";
                validateData=1;
            }
            else
                document.getElementById("error_cust_id_num").innerHTML = "";
            //alert(validateData);
            if(validateData==0)
            {
                document.getElementById("client_name").value = "";
                document.getElementById("client_phone").value = "";
                document.getElementById("client_email").value = "";
                document.getElementById("client_address").value = "";
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() 
                {
                    if (this.readyState == 4 && this.status == 200) 
                    {
                       var myObj = JSON.parse(this.responseText);
                       if(myObj.length>0)
                       {
                       document.getElementById("client_name").value = myObj[0][2];
                       document.getElementById("client_phone").value = myObj[0][4];
                       document.getElementById("client_email").value = myObj[0][5];
                       document.getElementById("client_address").value = myObj[0][3];

                       if(myObj[0][2]==null || myObj[0][2]=='')
                           $("#client_name").focus();
                       else if(myObj[0][4]==null || myObj[0][4]=='')
                           $("#client_phone").focus();
                       else if(myObj[0][5]==null || myObj[0][5]=='')
                           $("#client_email").focus();
                       else if(myObj[0][3]==null || myObj[0][3]=='')
                           $("#client_address").focus();
                       else
                           $("#item_id").focus();
                       }
                       else
                       {
                           alert('CUSTOMER NO REGISTRADO');
                          $("#client_name").focus(); 
                       }
                       //alert(this.responseText);
                    }
                };

                xmlhttp.open("GET", "controller.php?controller=6&task=0&cust_id_type="+cust_id_type+"&cust_id_num="+cust_id_num, true);
                xmlhttp.send();
            }
        }
    });

    $("#addNewCustInVentas").click(function () 
    {   
        var cust_id_type = window.document.getElementById("client_doc_type").value;
        var cust_id_num = window.document.getElementById("client_ruc").value;
        var cust_name= document.getElementById("client_name").value;
        var cust_phone= document.getElementById("client_phone").value;
        var cust_email= document.getElementById("client_email").value;
        var cust_dir= document.getElementById("client_address").value;
        //alert(cust_name+":"+cust_phone+":"+cust_email+":"+cust_dir);
        var validateData=0;
        if(cust_id_num==null || cust_id_num=='')
        {
            document.getElementById("error_cust_id_num").innerHTML = "Por favor ingresa nro. documento!";
            validateData=1;
        }
        else
            document.getElementById("error_cust_id_num").innerHTML = "";
        if(cust_name==null || cust_name=='')
        {
            document.getElementById("error_client_name").innerHTML = "Por favor ingresa nombre customer!";
            validateData=1;
        }
        else
            document.getElementById("error_client_name").innerHTML = "";
        if(cust_phone==null || cust_phone=='')
        {
            document.getElementById("error_client_phone").innerHTML = "Por favor ingresa nro. contacto!";
            validateData=1;
        }
        else
            document.getElementById("error_client_phone").innerHTML = "";
        if(cust_email==null || cust_email=='')
        {
            document.getElementById("error_client_email").innerHTML = "Por favor ingresa customer email!";
            validateData=1;
        }
        else
            document.getElementById("error_client_email").innerHTML = "";
        if(cust_dir==null || cust_dir=='')
        {
            document.getElementById("error_client_address").innerHTML = "Por favor ingresa customer direccion!";
            validateData=1;
        }
        else
            document.getElementById("error_client_address").innerHTML = "";
        //alert(validateData);
        if(validateData==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                   document.getElementById("addCustDocInVentas").innerHTML = this.responseText;
                   $("#addCustDocInVentas").addClass("addCustDocInVentas");
                }
            };

            xmlhttp.open("GET", "controller.php?controller=6&task=1&client_doc_type="+cust_id_type+"&client_name="+cust_name+"&client_ruc="+cust_id_num+"&client_address="+cust_dir+"&client_phone="+cust_phone+"&client_email="+cust_email, true);
            xmlhttp.send();
        }
    });

    $("#addItemForSale").click(function () 
    {   
        var id = window.document.getElementById("id").value;
        var item_id = window.document.getElementById("item_id").value;
        var item_qty = window.document.getElementById("item_qty").value;
        //alert("::"+item_qty);
        var validateData=0;
        if(id==null || id=='')
        {
            alert("ERROR");
            validateData=1;
        }
        if(item_id==null || item_id=='')
        {
            document.getElementById("error_item_id").innerHTML = "Por favor ingresa codigo del producto!";
            validateData=1;
        }
        else
            document.getElementById("error_item_id").innerHTML = "";
        if(item_qty==null || item_qty=='')
        {
            document.getElementById("error_item_qty").innerHTML = "Por favor ingresa cantidad del producto!";
            validateData=1;
        }
        else
            document.getElementById("error_item_qty").innerHTML = "";
        //alert(validateData);
        if(validateData==0)
        {
            document.getElementById("item_id").value = "";
            document.getElementById("item_qty").value = "1";
            document.getElementById("id").value = "0";
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                   /*var myObj = JSON.parse(this.responseText);
                   //alert(myObj.length);
                   document.getElementById("client_name").value = myObj[0][2];
                   document.getElementById("client_phone").value = myObj[0][4];
                   document.getElementById("client_email").value = myObj[0][5];
                   document.getElementById("client_address").value = myObj[0][3];
                   //alert(this.responseText);*/
                   if(this.responseText!=null && this.responseText.length>26)
                       alert(this.responseText);
                   $("#basket").load(location.href + " #basket");
                }
            };

            xmlhttp.open("GET", "controller.php?controller=6&task=2&id="+id+"&item_id="+item_id+"&item_qty="+item_qty, true);
            xmlhttp.send();
        }
    });

    $("#item_qty").on( "keydown", function(event)
    {   
        if(event.which == 13)
        {
            var id = window.document.getElementById("id").value;
            var item_id = window.document.getElementById("item_id").value;
            var item_qty = window.document.getElementById("item_qty").value;
            //alert("::"+item_qty);
            var validateData=0;
            if(id==null || id=='')
            {
                alert("ERROR");
                validateData=1;
            }
            if(item_id==null || item_id=='')
            {
                document.getElementById("error_item_id").innerHTML = "Por favor ingresa codigo del producto!";
                validateData=1;
            }
            else
                document.getElementById("error_item_id").innerHTML = "";
            if(item_qty==null || item_qty=='')
            {
                document.getElementById("error_item_qty").innerHTML = "Por favor ingresa cantidad del producto!";
                validateData=1;
            }
            else
                document.getElementById("error_item_qty").innerHTML = "";
            //alert(validateData);
            if(validateData==0)
            {
                document.getElementById("item_id").value = "";
                document.getElementById("item_qty").value = "1";
                document.getElementById("id").value = "0";
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() 
                {
                    if (this.readyState == 4 && this.status == 200) 
                    {
                       /*var myObj = JSON.parse(this.responseText);
                       //alert(myObj.length);
                       document.getElementById("client_name").value = myObj[0][2];
                       document.getElementById("client_phone").value = myObj[0][4];
                       document.getElementById("client_email").value = myObj[0][5];
                       document.getElementById("client_address").value = myObj[0][3];
                       //alert(this.responseText);*/
                       if(this.responseText!=null && this.responseText.length>26)
                           alert(this.responseText);
                       $("#basket").load(location.href + " #basket");
                       $('#item_id').focus();
                    }
                };

                xmlhttp.open("GET", "controller.php?controller=6&task=2&id="+id+"&item_id="+item_id+"&item_qty="+item_qty, true);
                xmlhttp.send();
            }
        }
    });
    
});


function habilitarEditCliente(id,ruc,name,direccion,telefono,email)
{
    document.getElementById("client_ruc").value=ruc.replace(/\+/g," ");
    document.getElementById("client_name").value=name.replace(/\+/g," ");
    document.getElementById("client_address").value=direccion.replace(/\+/g," ");
    document.getElementById("client_phone").value=telefono.replace(/\+/g," ");
    //document.getElementById("client_email").value=email.replace(/\+/g,"@");
    document.getElementById("client_email").value=email;

}

function delCliente(id,ruc,name,enabled)
{
    var xmlhttp = new XMLHttpRequest();
    //$('#progress').show();
    var text="";
    if(enabled==0)
        text="habilitar";
    else
        text="deshabilitar";
    if(confirm('Estas seguro de '+text+' el cliente : '+ruc.replace(/\+/g," ")+':'+name.replace(/\+/g," ")))
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                //alert('RELOADING.....');
                location.reload();
            }
        };

        xmlhttp.open("GET", "controller.php?controller=1&task=1&id_cliente="+id, true);
        xmlhttp.send();
    }
    //$('#progress').hide();
}

function habilitarEditDistributor(id,doc_type,ruc,name,direccion,telefono,email)
{
    document.getElementById("client_ruc").value=ruc.replace(/\+/g," ");
    document.getElementById("client_name").value=name.replace(/\+/g," ");
    document.getElementById("client_address").value=direccion.replace(/\+/g," ");
    document.getElementById("client_phone").value=telefono.replace(/\+/g," ");
    //document.getElementById("client_email").value=email.replace(/\+/g,"@");
    document.getElementById("client_email").value=email;
    var x = document.getElementById("client_doc_type");
    var i;
    for (i = 0; i < x.length; i++) 
    {
        if(x.options[i].value==doc_type)
            x.selectedIndex=i;
    }

}

function delDistributor(id,ruc,name,enabled)
{
    var xmlhttp = new XMLHttpRequest();
    //$('#progress').show();
    var text="";
    if(enabled==0)
        text="habilitar";
    else
        text="deshabilitar";
    if(confirm('Estas seguro de '+text+' el distribuidor : '+ruc.replace(/\+/g," ")+':'+name.replace(/\+/g," ")))
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                //alert('RELOADING.....');
                location.reload();
            }
        };

        xmlhttp.open("GET", "controller.php?controller=2&task=1&id_cliente="+id, true);
        xmlhttp.send();
    }
    //$('#progress').hide();
}

function habilitarEditBranch(id,name,direccion,telefono,email,branch_emision_code,branch_bill_start_num,branch_bill_end_num)
{
    document.getElementById("branch_id").value=id.replace(/\+/g," ");
    document.getElementById("branch_name").value=name.replace(/\+/g," ");
    document.getElementById("branch_address").value=direccion.replace(/\+/g," ");
    document.getElementById("branch_telephone").value=telefono.replace(/\+/g," ");
    //document.getElementById("client_email").value=email.replace(/\+/g,"@");
    document.getElementById("branch_email").value=email;
    document.getElementById("branch_emision_code").value=branch_emision_code;
    document.getElementById("branch_bill_start_num").value=branch_bill_start_num;
    document.getElementById("branch_bill_end_num").value=branch_bill_end_num;
}

function delBranch(id,name,address,enabled)
{
    var xmlhttp = new XMLHttpRequest();
    //$('#progress').show();
    var text="";
    if(enabled==0)
        text="habilitar";
    else
        text="deshabilitar";
    if(confirm('Estas seguro de '+text+' el punto emission : '+id.replace(/\+/g," ")+':'+name.replace(/\+/g," ")))
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                //alert('RELOADING.....');
                location.reload();
            }
        };

        xmlhttp.open("GET", "controller.php?controller=3&task=1&id_cliente="+id, true);
        xmlhttp.send();
    }
    //$('#progress').hide();
}

function habilitarEditUser(id,name,email,phone,perfil,branch)
{
    //alert('HI:'+phone);
    document.getElementById("user_id").value=id.replace(/\+/g," ");
    document.getElementById("user_name").value=name.replace(/\+/g," ");
    document.getElementById("user_email").value=email.replace(/\+/g," ");
    document.getElementById("user_phone").value=phone;
    var x = document.getElementById("user_perfil");
    var i;
    for (i = 0; i < x.length; i++) 
    {
        if(x.options[i].value==perfil)
            x.selectedIndex=i;
    }
    var y = document.getElementById("user_branch");
    var j;
    for (j = 0; j < y.length; j++) 
    {
        if(y.options[j].value==branch)
            y.selectedIndex=j;
    }
}

function delUser(id,name,address,enabled)
{
    var xmlhttp = new XMLHttpRequest();
    //$('#progress').show();
    var text="";
    if(enabled==0)
        text="habilitar";
    else
        text="deshabilitar";
    if(confirm('Estas seguro de '+text+' el usuario : '+id.replace(/\+/g," ")+':'+name.replace(/\+/g," ")))
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                //alert('RELOADING.....');
                location.reload();
            }
        };

        xmlhttp.open("GET", "controller.php?controller=4&task=1&user_id="+id, true);
        xmlhttp.send();
    }
    //$('#progress').hide();
}

function habilitarEditInventory(id,name,desc,qty,ppu,iva,category,ruc,fecha_exp)
{
    //alert('HI:');
    document.getElementById("item_id").value=id;
    document.getElementById("item_name").value=name.replace(/\+/g," ");
    
    document.getElementById("item_desc").value=desc.replace(/\+/g," ");;
    document.getElementById("item_qty").value=qty;
    document.getElementById("item_ppu").value=ppu;
    document.getElementById("item_iva").value=iva;
    document.getElementById("item_exp_dt").value=fecha_exp;
    var x = document.getElementById("item_category");
    var i;
    for (i = 0; i < x.length; i++) 
    {
        if(x.options[i].value==category)
            x.selectedIndex=i;
    }
    var y = document.getElementById("item_prov_ruc");
    var j;
    for (j = 0; j < y.length; j++) 
    {
        if(y.options[j].value==ruc)
            y.selectedIndex=j;
    }
    document.getElementById("item_accion").selectedIndex=1;
}

function delInventory(id,name,address,enabled)
{
    var xmlhttp = new XMLHttpRequest();
    //$('#progress').show();
    var text="";
    if(enabled==0)
        text="habilitar";
    else
        text="deshabilitar";
    if(confirm('Estas seguro de '+text+' el item : '+id.replace(/\+/g," ")+':'+name.replace(/\+/g," ")))
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                //alert('RELOADING.....');
                location.reload();
            }
        };

        xmlhttp.open("GET", "controller.php?controller=5&task=1&item_id="+id, true);
        xmlhttp.send();
    }
    //$('#progress').hide();
}

function habilitarEditItemEnVenta(id,qty,code)
{
    document.getElementById("item_id").value=code;
    document.getElementById("item_qty").value=qty;
    document.getElementById("id").value=id;

}

function delItemEnVenta(id,name,code)
{
    var text="";
    if(confirm('Estas seguro de quitar el item desde venta : '+code+':'+name.replace(/\+/g," ")))
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                if(this.responseText!=null && this.responseText.length>26)
                    alert(this.responseText.length+":"+this.responseText);
                $("#basket").load(location.href + " #basket");
            }
        };

        xmlhttp.open("GET", "controller.php?controller=6&task=3&id="+id, true);
        xmlhttp.send();
    }
    //$('#progress').hide();
}

function updateTimer(id)
{
    //alert("hello"+id);
    //var countDownDate = new Date("Feb 5, 2018 15:37:25").getTime();
    var countDownDate = new Date(id+"/Feb/2018 23:59:59").getTime();
    //alert(countDownDate);

    // Update the count down every 1 second
    var x = setInterval(function() {

      // Get todays date and time
      var now = new Date().getTime();

      // Find the distance between now an the count down date
      var distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Display the result in the element with id="demo"
      document.getElementById("demo"+id).innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";

      // If the count down is finished, write some text 
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo"+id).innerHTML = "EXPIRED";
      }
    }, 1000);
}