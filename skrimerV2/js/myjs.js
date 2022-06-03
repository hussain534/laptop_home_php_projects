window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 6000);



$(document).ready(function()
{
    $('#item_id').focus();

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
                   //alert(this.responseText);
                   var myObj = JSON.parse(this.responseText);
                   //alert(myObj.length);
                   document.getElementById("client_name").value = myObj[0][2];
                   document.getElementById("client_phone").value = myObj[0][4];
                   document.getElementById("client_email").value = myObj[0][5];
                   document.getElementById("client_address").value = myObj[0][3];
                   document.getElementById("error_client_name").innerHTML = "";
                    document.getElementById("error_client_phone").innerHTML = "";
                    document.getElementById("error_client_email").innerHTML = "";
                    document.getElementById("error_client_address").innerHTML = "";
                    if(myObj[0][2]==null || myObj[0][2]=='')
                        $("#client_name").focus();
                    else if(myObj[0][4]==null || myObj[0][4]=='')
                        $("#client_phone").focus();
                    else if(myObj[0][5]==null || myObj[0][5]=='')
                        $("#client_email").focus();
                    else if(myObj[0][3]==null || myObj[0][3]=='')
                        $("#client_address").focus();/*
                    else
                        $("#item_id").focus();*/
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

    /*$("#addItemForSale").click(function () 
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
                   if(this.responseText!=null && this.responseText.length>26)
                       alert(this.responseText);
                   $("#basket").load(location.href + " #basket");
                }
            };

            xmlhttp.open("GET", "controller.php?controller=6&task=2&id="+id+"&item_id="+item_id+"&item_qty="+item_qty, true);
            xmlhttp.send();
        }
    });*/

    $("#item_qty").on("keydown", function(event)
    {   
        if(event.which == 13)
        {
            var id = window.document.getElementById("id").value;
            var item_id = window.document.getElementById("item_id").value;
            var item_qty = window.document.getElementById("item_qty").value;
            //alert("ADDING ITEM TO CART");
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
            if(item_qty==null || item_qty=='' || parseInt(item_qty)<=0)
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
                       if(this.responseText!=null && this.responseText.length>26)
                           alert(this.responseText);
                       //alert(location.href + " #basket");
                       //$("#basket").load(location.href + " #basket");
                       location.reload();
                       $('#item_id').focus();
                    }
                };

                xmlhttp.open("GET", "controller.php?controller=6&task=2&id="+id+"&item_id="+item_id+"&item_qty="+item_qty, true);
                xmlhttp.send();
            }
            else
                $('#item_id').focus();
        }
    });

    $("#valor_recibido").focusout(function () 
    {   
        //alert("123");
        var valor_factura = window.document.getElementById("valor_factura").value;
        var valor_recibido = window.document.getElementById("valor_recibido").value;
        var zeroValue=0;
        //alert(valor_factura+":"+valor_recibido);
        var validateData=0;
        if(!isNaN(valor_recibido) && !isNaN(valor_factura)&& parseInt(valor_recibido)>=0 && parseInt(valor_factura)>parseInt(valor_recibido))
        {
            alert("Por favor ingresa valor recibido correcto!");
            window.document.getElementById("valor_recibido").value=zeroValue.toFixed(2);
            window.document.getElementById("valor_cambio").value=zeroValue.toFixed(2);
            //$('#valor_recibido').focus();
            validateData=1;
        }
        else if(isNaN(valor_recibido))
        {
            alert("Valor recibido no es numerico.");
            window.document.getElementById("valor_recibido").value=zeroValue.toFixed(2);
            window.document.getElementById("valor_cambio").value=zeroValue.toFixed(2);
            validateData=1;
        }
        if(validateData==0 && parseInt(valor_factura)>0)
        {
            var valor_cambio=valor_recibido-valor_factura;
            window.document.getElementById("valor_recibido").value=parseInt(valor_recibido).toFixed(2);
            window.document.getElementById("valor_cambio").value=valor_cambio.toFixed(2);
        }
    });

    $("#btnConfirmSale").click(function () 
    {   
        
        var client_doc_type = window.document.getElementById("client_doc_type").value;
        var client_ruc = window.document.getElementById("client_ruc").value;
        var client_name = window.document.getElementById("client_name").value;
        var client_phone = window.document.getElementById("client_phone").value;
        var client_email = window.document.getElementById("client_email").value;
        var client_address = window.document.getElementById("client_address").value;

        var tipo_pago = window.document.getElementById("tipo_pago").value;
        var bill_amount = window.document.getElementById("valor_factura").value;

        //alert("::"+item_qty);
        var validateData=0;
        if(client_ruc==null || client_ruc=='')
        {
            document.getElementById("error_cust_id_num").innerHTML = "Por favor ingresa nro documento!";
            validateData=1;
        }
        else
            document.getElementById("error_cust_id_num").innerHTML = "";
        
        if(client_name==null || client_name=='')
        {
            document.getElementById("error_client_name").innerHTML = "Por favor ingresa nombre del cliente!";
            validateData=1;
        }
        else
            document.getElementById("error_client_name").innerHTML = "";

        if(client_phone==null || client_phone=='')
        {
            document.getElementById("error_client_phone").innerHTML = "Por favor ingresa nro telefono!";
            validateData=1;
        }
        else
            document.getElementById("error_client_phone").innerHTML = "";

        if(client_email==null || client_email=='')
        {
            document.getElementById("error_client_email").innerHTML = "Por favor ingresa email!";
            validateData=1;
        }
        else
            document.getElementById("error_client_email").innerHTML = "";

        if(client_address==null || client_address=='')
        {
            document.getElementById("error_client_address").innerHTML = "Por favor ingresa direccion!";
            validateData=1;
        }
        else
            document.getElementById("error_client_address").innerHTML = "";
        if(bill_amount==0)
        {
            validateData=1;
            alert("No puede generar factura. Elegir productos");
        }


        //alert(validateData);
        if(validateData==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                   if(this.responseText!=null && this.responseText.length>26)
                       alert(this.responseText);
                   //$("#basket").load(location.href + " #basket");
                   location.reload();
                }
            };

            xmlhttp.open("GET", "controller.php?controller=6&task=4&client_doc_type="+client_doc_type+"&client_ruc="+client_ruc+"&client_name="+client_name+"&client_phone="+client_phone+"&client_email="+client_email+"&client_address="+client_address+"&bill_amount="+bill_amount+"&id_payment_mode="+tipo_pago, true);
            //xmlhttp.open("GET", "controller.php?controller=6&task=4&bill_amount="+bill_amount+"&id_payment_mode="+tipo_pago, true);
            xmlhttp.send();
        }
    });

    $("#btnBuscarItemsForVentas").click(function () 
    {   
        var item_name_busqueda = window.document.getElementById("item_name_busqueda").value;
        var item_desc_busqueda = window.document.getElementById("item_desc_busqueda").value;
        var item_barcode= document.getElementById("item_barcode").value;
        var item_category_busqueda= document.getElementById("item_category_busqueda").value;
        var item_prov_ruc_busqueda= document.getElementById("item_prov_ruc_busqueda").value;
        var validateData=0;
        if(     (item_name_busqueda==null || item_name_busqueda=='') && 
                (item_desc_busqueda==null || item_desc_busqueda=='') && 
                (item_barcode==null || item_barcode=='') && 
                (item_category_busqueda==-1) &&
                (item_prov_ruc_busqueda==-1)
          )
        {
            alert("Por favor ingresa una data para buscar");
            validateData=1;
        }
        if(validateData==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                   document.getElementById("dataItemsBusqueda").innerHTML = this.responseText;
                }
            };

            xmlhttp.open("GET", "controller.php?controller=7&task=1&item_name_busqueda="+item_name_busqueda+"&item_category_busqueda="+item_category_busqueda+"&item_desc_busqueda="+item_desc_busqueda+"&item_prov_ruc_busqueda="+item_prov_ruc_busqueda+"&barcode="+item_barcode, true);
            xmlhttp.send();
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

function habilitarEditInventory(id,name,desc,qty,ppu,category,ruc,fecha_exp,barcode,purchase_price,tipo_gasto,alerta_almacen,do_inventory_movement)
{
    //alert('HI:');
    //alert(do_inventory_movement);
    document.getElementById("item_id").value=id;
    document.getElementById("item_name").value=name.replace(/\+/g," ");
    
    //document.getElementById("item_desc").value=desc.replace(/\+/g," ");
    
    document.getElementById("item_qty").value=qty;
    document.getElementById("item_ppu").value=ppu;
    document.getElementById("item_exp_dt").value=fecha_exp;
    var x = document.getElementById("item_category");
    var i;
    for (i = 0; i < x.length; i++) 
    {
        if(x.options[i].value==category)
            x.selectedIndex=i;
    }
    /*var y = document.getElementById("item_prov_ruc");
    var j;
    for (j = 0; j < y.length; j++) 
    {
        if(y.options[j].value==ruc)
            y.selectedIndex=j;
    }*/
    document.getElementById("item_prov_ruc").value=ruc;
    document.getElementById("item_accion").selectedIndex=1;
    var z = document.getElementById("item_expenditure_type");
    var k;
    for (k = 0; k < z.length; k++) 
    {
        if(z.options[k].value==tipo_gasto)
            z.selectedIndex=k;
    }
    var d = document.getElementById("item_lleva_inventario");
    var f;
    for (f = 0; f < d.length; f++) 
    {
        if(d.options[f].value==do_inventory_movement)
            d.selectedIndex=f;
    }
    document.getElementById("item_barcode").value=barcode.replace(/\+/g," ");
    document.getElementById("item_purchase_price").value=purchase_price;
    document.getElementById("item_store_min_alert").value=alerta_almacen;
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
                //$("#basket").load(location.href + " #basket");
                location.reload();
            }
        };

        xmlhttp.open("GET", "controller.php?controller=6&task=3&id="+id, true);
        xmlhttp.send();
    }
    //$('#progress').hide();
}
function selectItemForVenta(id)
{
    document.getElementById("item_id").value=id;
    //document.getElementById("buscarItem").style.display = "none";
    $('#buscarItem').modal("hide");
    $('#item_qty').focus();
}


function setInventoryValues()
{
    var lleva_inventario = document.getElementById("item_lleva_inventario").value;
    if(lleva_inventario==0)
    {
        document.getElementById("item_store_min_alert").value=0;
        document.getElementById("item_store_min_alert").readOnly = true;
        document.getElementById("item_qty").value=9999999999;
        document.getElementById("item_qty").readOnly = true;
    }
    else
    {
        document.getElementById("item_store_min_alert").value=0;
        document.getElementById("item_store_min_alert").readOnly = false;
        document.getElementById("item_qty").value=0;
        document.getElementById("item_qty").readOnly = false;
    }
}