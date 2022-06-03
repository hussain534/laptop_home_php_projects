$(document).ready(function()
{
    $("#progress").hide();

    //$("#panelPago").hide();

    $("#cedula1").hide();
    $("#cedula2").hide();
    $("#cedula3").hide();
    $("#cedula4").hide();

    $("#panelGaleria").hide();

    $("#myTab li:eq(0) a").tab('show');

    $("#user_celular").keypress(function (e) 
    {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
        {
            //display error message
            $("#user_celular_errmsg").html("Por favor ingresar solo numeros").show();
                   return false;
        }
        else
            $("#user_celular_errmsg").hide();
    });

    $("#user_landline").keypress(function (e) 
    {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
        {
            //display error message
            $("#user_landline_errmsg").html("Por favor ingresar solo numeros").show();
                   return false;
        }
        else
            $("#user_landline_errmsg").hide();
    });

    $("#user_cedula").keypress(function (e) 
    {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
        {
            //display error message
            $("#user_cedula_errmsg").html("Por favor ingresar solo numeros").show();
                   return false;
        }
        else
            $("#user_cedula_errmsg").hide();
    });

    $("#ano").keypress(function (e) 
    {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
        {
            //display error message
            $("#ano_errmsg").html("Por favor ingresar solo numeros").show();
                   return false;
        }
        else
            $("#ano_errmsg").hide();
    });

    $("#capacidad").keypress(function (e) 
    {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
        {
            //display error message
            $("#capacidad_errmsg").html("Por favor ingresar solo numeros").show();
                   return false;
        }
        else
            $("#capacidad_errmsg").hide();
    });
    $("#nrocuenta").keypress(function (e) 
    {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
        {
            //display error message
            $("#error_nrocuenta").html("Por favor ingresar solo numeros").show();
                   return false;
        }
        else
            $("#error_nrocuenta").hide();
    });

    $("#cedula1").keypress(function (e) 
    {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
        {
            //display error message
            $("#error_cedula1").html("Por favor ingresar solo numeros").show();
                   return false;
        }
        else
            $("#error_cedula1").hide();
    });

    $("#cedula2").keypress(function (e) 
    {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
        {
            //display error message
            $("#error_cedula2").html("Por favor ingresar solo numeros").show();
                   return false;
        }
        else
            $("#error_cedula2").hide();
    });

    $("#cedula3").keypress(function (e) 
    {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
        {
            //display error message
            $("#error_cedula3").html("Por favor ingresar solo numeros").show();
                   return false;
        }
        else
            $("#error_cedula3").hide();
    });

    $("#cedula4").keypress(function (e) 
    {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
        {
            //display error message
            $("#error_cedula4").html("Por favor ingresar solo numeros").show();
                   return false;
        }
        else
            $("#error_cedula4").hide();
    });







    $("#fileToUpload").on('change', function () 
    {
        //alert(1);
        $("#progress").show();
        //alert(2);
        var imgPath = $(this)[0].value;
        //alert('imgPath::'+imgPath);
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        //alert(3);
        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") 
        {
            //alert(4);
            if (typeof (FileReader) != "undefined") 
            {  
                //alert(5);
                var reader = new FileReader();
                reader.onload = function (e) 
                {
                    //alert(6);
                    $('#uploadImg').attr('src',e.target.result);
                    
                    //alert(7);
                }          
                //alert(8);      
                reader.readAsDataURL($(this)[0].files[0]);
                //alert(9);
            } else {
                alert("This browser does not support FileReader.");
            }
        } 
        else 
        {
            alert("Pls select only images");
        }
        $("#progress").hide();
    });

    $("#fileToUpload2").on('change', function () 
    {
        $("#progress").show();
        var imgPath = $(this)[0].value;
        //alert('imgPath::'+imgPath);
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") 
        {
            if (typeof (FileReader) != "undefined") 
            {  

                var reader = new FileReader();
                reader.onload = function (e) 
                {
                    $('#uploadImg2').attr('src',e.target.result);
                    $("#progress").hide();
                }                
                reader.readAsDataURL($(this)[0].files[0]);
            } else {
                alert("This browser does not support FileReader.");
            }
        } 
        else 
        {
            alert("Pls select only images");
        }
    });

    


     $("#menu01").click(function () 
    {
         $('html, body').animate({
            scrollTop: $("#how_it_works").offset().top
        }, 1000);
    });

    $("#menu02").click(function () 
    {
         $('html, body').animate({
            scrollTop: $("#services").offset().top
        }, 1000);
    });

    $("#menu03").click(function () 
    {
         $('html, body').animate({
            scrollTop: $("#proximo_viajes").offset().top
        }, 1000);
    });



    

    
    $("#btnAbrirPago").click(function () 
    {   
        $("#panelPago").show();
        var asientesctr = window.document.getElementById("asientesctr").value;
        var costoAsiento = window.document.getElementById("costoAsiento").value;
        var eligoretorno = $("input[type='radio'][name='eligoretorno']:checked").val();
        //alert(eligoretorno);
        if(eligoretorno=="1")
        {
            window.document.getElementById("costoTotal").innerHTML = "<br><br><br><br><h1 style='background:#222;padding:10px;border:1px solid #222;color:#FFF'><b>VALOR TOTAL A PAGAR : $ </b>"+((asientesctr*costoAsiento) + (1 * 6))+".00</h1>";
        }
        else
        {
            window.document.getElementById("costoTotal").innerHTML = "<br><br><br><br><h1 style='background:#222;padding:10px;border:1px solid #222;color:#FFF'><b>VALOR TOTAL A PAGAR : $ </b>"+(asientesctr*costoAsiento)+".00</h1>";
        }
        
        $('html, body').animate({
            scrollTop: $("#costoTotal").offset().top
        }, 1000);
    });


    $("#btnViajes").click(function () 
    {   
        //$("#vuelos").hide(1000);
        //$("#viajes").show(1000);
        var xmlhttp = new XMLHttpRequest();
        //alert('OK');
        //var str = $("input[type='radio'][name='tipoviaje']:checked").val();
        //var str = window.document.getElementById("tipoviaje").value;
        var fechaviajesearch = window.document.getElementById("fechaviajesearch").value;
        /*var ln=window.document.getElementById("sector").value.split(":");
        var sector = ln[0];*/

        var sector = window.document.getElementById("sector").value;
        var c_viaje = window.document.getElementById("c_viaje").value;
        var calle_principal=window.document.getElementById("calle_principal").value;
        var numeracion=window.document.getElementById("numeracion").value;
        var calle_secundario=window.document.getElementById("calle_secundario").value;
        var referencia=window.document.getElementById("referencia").value;
        var errcode=0;
        if(fechaviajesearch==null || fechaviajesearch=='')
        {
            document.getElementById("errorFecha").innerHTML = "Por favor indica su fecha de viaje!";
            errcode=1;
        }
        else
            document.getElementById("errorFecha").innerHTML = "";
        
        if(sector==0)
        {
            document.getElementById("errorSector").innerHTML = "Por favor elige su sector!";
            errcode=1;
        }
        else
            document.getElementById("errorSector").innerHTML = "";
        
        if(calle_principal==null || calle_principal=='')
        {
            document.getElementById("errorCallePrincipal").innerHTML = "Por favor Indicar su calle principal!";
            errcode=1;
        }
        else
            document.getElementById("errorCallePrincipal").innerHTML = "";
        
        if(numeracion==null || numeracion=='')
        {
            document.getElementById("errorNumeracion").innerHTML = "Por favor Indicar numeracion!";
            errcode=1;
        }
        else
            document.getElementById("errorNumeracion").innerHTML = "";
        
        if(calle_secundario==null || calle_secundario=='')
        {
            document.getElementById("errorCalleSecundario").innerHTML = "Por favor Indicar su calle secundaria!";
            errcode=1;
        }
        else
            document.getElementById("errorCalleSecundario").innerHTML = "";
        
        if(referencia==null || referencia=='')
        {
            document.getElementById("errorReferencia").innerHTML = "Por favor Indicar una referencia!";
            errcode=1;
        }
        else
            document.getElementById("errorReferencia").innerHTML = "";

        if(fechaviajesearch!=null && fechaviajesearch!='')
        fechaviajesearch = window.document.getElementById("fechaviajesearch").value+" "+
                                window.document.getElementById("horaviajesearch").value+":00";
        nroasientes=window.document.getElementById("nroasientessearch").value;
        
        //alert(fechaviajesearch);
        if(sector==0)
            getFranjas(fechaviajesearch,sector,nroasientes,c_viaje);
    });


    $("#btnViajesNacional").click(function () 
    {   
        //$("#vuelos").hide(1000);
        //$("#viajes").show(1000);
        var xmlhttp = new XMLHttpRequest();
        //alert('INSIDE');
        //var str = $("input[type='radio'][name='tipoviaje']:checked").val();
        //var str = window.document.getElementById("tipoviaje").value;
        var fechaviajesearch = window.document.getElementById("fechaviajesearch").value;
        var ciudad=document.getElementById("ciudad").value;
        var ciudaddestino=document.getElementById("ciudaddestino").value;
        var sector = window.document.getElementById("sector").value;
        var destino=document.getElementById("sectordestino").value;
        err_code=0;
        
        if(fechaviajesearch==null || fechaviajesearch=='')
        {
            document.getElementById("errorFecha").innerHTML = "Por favor indica su fecha de viaje!";
            err_code=1;
        }
        else
            document.getElementById("errorFecha").innerHTML = "";
        if(ciudad==0)
        {
            document.getElementById("errorCiudad").innerHTML = "Por favor indica su ciudad de salida!";
            err_code=1;
        }
        else
            document.getElementById("errorCiudad").innerHTML = "";
        if(ciudaddestino==0)
        {
            document.getElementById("errorCiudadDestino").innerHTML = "Por favor indica su Ciudad de destino!";
            err_code=1;
        }
        else
            document.getElementById("errorCiudadDestino").innerHTML = "";
        if(sector==0)
        {
            document.getElementById("errorSector").innerHTML = "Por favor elige su sector!";
            err_code=1;
        }
        else
            document.getElementById("errorSector").innerHTML = "";
        if(destino==0)
        {
            document.getElementById("errorSectorDestino").innerHTML = "Por favor elige su sector destino!";
            err_code=1;
        }
        else
            document.getElementById("errorSectorDestino").innerHTML = "";

        if(fechaviajesearch!=null && fechaviajesearch!='')
        fechaviajesearch = window.document.getElementById("fechaviajesearch").value+" "+
                                window.document.getElementById("horaviajesearch").value+":00";
        nroasientes=window.document.getElementById("nroasientessearch").value;
        
        //alert(fechaviajesearch);
        if(err_code==0 && fechaviajesearch!=null && fechaviajesearch!='' && sector!=0)
        {
            //alert('OK');
            var xmlhttp = new XMLHttpRequest();
            $("#viajes").show(1000);

            $("#progress").show();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    //alert(sector);
                    $("#progress").hide();
                    document.getElementById("viajes").innerHTML = this.responseText;

                }
            };

            xmlhttp.open("GET", "getfranjasNacional.php?ciudad="+ciudad+"&ciudaddestino="+ciudaddestino+"&horavuelo=" + fechaviajesearch+"&sector="+sector+"&destino="+destino+"&nroasientes="+nroasientes+"&mascotas=0&fumar=0&alcohol=0", true);
            //alert(destino);
            xmlhttp.send();
        }
    });

    
    $("#btnActualizarCuenta").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        var cid = window.document.getElementById("cid").value;
        var nrocuenta = window.document.getElementById("nrocuenta").value;
        var bancoId = window.document.getElementById("bancoId").value;

        var tipoCuenta = window.document.getElementById("tipoCuenta").value;
        if(nrocuenta==null || nrocuenta=='')
            document.getElementById("error_nrocuenta").innerHTML = "Por favor indica su Nro de cuenta banco!";
        else
            document.getElementById("error_nrocuenta").innerHTML = "";
        if(bancoId==0)
            document.getElementById("error_bancoId").innerHTML = "Por favor elige su Banco!";
        else
            document.getElementById("error_bancoId").innerHTML = "";
        if(tipoCuenta==0)
            document.getElementById("error_tipoCuenta").innerHTML = "Por favor elige su Tipo de cuenta!";
        else
            document.getElementById("error_tipoCuenta").innerHTML = "";

        if(nrocuenta!=null && nrocuenta!='' && bancoId!=0 && tipoCuenta!=0)
        {
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    document.getElementById("message").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "doActualizarCuenta.php?idcuenta="+cid+"&nrocuenta="+nrocuenta+"&bancoId="+bancoId+"&tipoCuenta="+tipoCuenta, true);
            xmlhttp.send();
        }
    });
    
    $("#btnActualizarClave").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        
        var newpwd = window.document.getElementById("newpwd").value;
        var confpwd = window.document.getElementById("confpwd").value;
        var oldpwd = window.document.getElementById("oldpwd").value;
        if(newpwd==null || newpwd=='')
            document.getElementById("error_newpwd").innerHTML = "Por favor indica su nuevo clave!";
        else
            document.getElementById("error_newpwd").innerHTML = "";
        if(confpwd==null || confpwd=='')
            document.getElementById("error_confpwd").innerHTML = "Por favor confirmar su nuevo clave nuevamente!";
        else if(confpwd!=newpwd)
            document.getElementById("error_confpwd").innerHTML = "Nuevo clave y confirmar clave no son iguales. Por favor ingresar correctamente!";
        else
            document.getElementById("error_confpwd").innerHTML = "";
        if(oldpwd==null || oldpwd=='')
            document.getElementById("error_oldpwd").innerHTML = "Por favor ingresa su clave anterior!";
        else
            document.getElementById("error_oldpwd").innerHTML = "";

        if(newpwd!=null && newpwd!='' && confpwd!=null && confpwd!='' && oldpwd!=null && oldpwd!='' && confpwd==newpwd)
        {
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    document.getElementById("message").innerHTML = this.responseText;
                    window.document.getElementById("newpwd").value="";
                    window.document.getElementById("confpwd").value="";
                    window.document.getElementById("oldpwd").value="";
                }
            };
            xmlhttp.open("GET", "doActualizarClave.php?newpwd="+newpwd+"&confpwd="+confpwd+"&oldpwd="+oldpwd, true);
            xmlhttp.send();
        }
    });


    $("#btnEliminarCuenta").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        
        var obser = window.document.getElementById("obser").value;
        //alert(obser);
        if(obser==null || obser=='')
            document.getElementById("error_obser").innerHTML = "Por favor indica su motivo de eliminacion!";
        else
            document.getElementById("error_obser").innerHTML = "";
        

        if(obser!=null && obser!='')
        {
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    //alert(2);
                    document.getElementById("message").innerHTML = this.responseText;
                    window.document.getElementById("obser").value="";
                }
                
            };
            //alert(1);
            xmlhttp.open("GET", "doEliminarCuenta.php?obser="+obser, true);
            xmlhttp.send();
        }
    });

    
    $("#btnAcceptarViaje").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        //alert('HELLO');
        var idviaje=document.getElementById("idviaje").value;
        //alert(idviaje);
        //var sector=document.getElementById("sector").value;
        //alert(sector);
        var direccion=document.getElementById("direccion").value;

        var cantpass=document.getElementById("cantpass").value;
        //alert(cantpass);
        /*if(sector==0)
            document.getElementById("errorSector").innerHTML = "Por favor elige su sector!";
        else
            document.getElementById("errorSector").innerHTML = "";*/
        if(direccion=='')
            document.getElementById("errorDireccion").innerHTML = "Por favor indica su direccion!";
        else
            document.getElementById("errorDireccion").innerHTML = "";
        if(direccion!='')
        {
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    document.getElementById("estadoReservarViaje").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "doAcceptarViaje.php?idviaje="+idviaje+"&direccion="+direccion+"&cantpass="+cantpass, true);
            xmlhttp.send();
        }

        
    });

    $("#btnPublicarViaje").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();

        var sector=document.getElementById("sector").value;
        //alert(sector);
        var horainiciodisponibilidad=document.getElementById("horainiciodisponibilidad").value;
        var duraciondisponible=document.getElementById("duraciondisponible").value;


        var fechaviaje=document.getElementById("fechaviaje").value;
        var automovilID=document.getElementById("automovilID").value;
        //var minutosviaje=document.getElementById("minutosviaje").value;
        var nroEquipaje=document.getElementById("nroEquipaje").value;
        var nroAsientes=document.getElementById("nroAsientes").value;
        
        var err_code=0;
       
        if(sector==0)
        {
            document.getElementById("errorSector").innerHTML = "Por favor elige su sector!";
            err_code=1;
        }
        else
            document.getElementById("errorSector").innerHTML = "";
        if(fechaviaje==null || fechaviaje=='')
        {
            document.getElementById("errorFecha").innerHTML = "Por favor indica su fecha de viaje!";
            err_code=1;
        }
        else
            document.getElementById("errorFecha").innerHTML = "";
        //alert(fechaviaje+"_"+horaviaje+":"+minutosviaje+"&nroequipaje="+nroEquipaje+"&nroasientes="+nroAsientes);
        if(err_code==0 && confirm("INFORMACIÓN: Has seleccionado su disponibilidad desde "+horainiciodisponibilidad+" para "+duraciondisponible+" minutos. Recuerda que a esa hora, debes estar ya en camino al aeropuerto y deberás recoger a los pasajeros con anterioridad a esa hora, con el fin de llegar puntualmente a tu destino. Se sugiere una franja de 30 minutos para recoger a todos los usuarios, pero es tu decisión y responsabilidad recogerlos a tiempo para que lleguen a tiempo"))
        {
            if(sector!=0 && !(fechaviaje==null || fechaviaje==''))
            {
                //alert("1");
                xmlhttp.onreadystatechange = function() 
                {
                    if (this.readyState == 4 && this.status == 200) 
                    {
                        document.getElementById("estadoPublicarViaje").innerHTML = this.responseText;
                    }
                };
                
                xmlhttp.open("GET", "doPublicarViaje.php?sector="+sector+"&fechaviaje="+fechaviaje+" "+horainiciodisponibilidad+":00"+"&duraciondisponible="+duraciondisponible+"&nroequipaje="+nroEquipaje+"&nroasientes="+nroAsientes+"&automovilID="+automovilID, true);
                xmlhttp.send();
            }
        }
        
    });


    
    

    $("#btnPublicarViajeNacional").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();

        var sector=document.getElementById("sector").value;
        //alert(sector);
        var fechaviaje=document.getElementById("fechaviaje").value;

        var horaviaje=document.getElementById("horaviaje").value;
        var automovilID=document.getElementById("automovilID").value;
        var paradascomer = $("input[type='radio'][name='paradascomer']:checked").val();
        var diligencias = $("input[type='radio'][name='diligencias']:checked").val();
        var mercancias = $("input[type='radio'][name='mercancias']:checked").val();
        //alert('1');
       /* var paradascomer=document.getElementById("paradascomer").value;
        var diligencias=document.getElementById("diligencias").value;
        var mercancias=document.getElementById("mercancias").value;*/
        //var minutosviaje=document.getElementById("minutosviaje").value;
        var nroEquipaje=document.getElementById("nroEquipaje").value;
        var nroAsientes=document.getElementById("nroAsientes").value;
        var destino=document.getElementById("sectordestino").value;
        var costo_viaje=document.getElementById("costo_viaje").value;
        //alert(destino);
        var err_code=0;
        var mascotas = 0;
        var fumar = 0;
        var alcohol = 0;
        /*if(document.getElementById("mascotas").checked)
            mascotas=1;
        if(document.getElementById("fumar").checked)
            fumar=1;
        if(document.getElementById("alcohol").checked)
            alcohol=1;*/
        /*alert(fechaviaje);
        alert(horaviaje);
        alert(minutosviaje);
        alert(nroEquipaje);
        alert(nroAsientes);*/
        if(sector==0)
        {
            document.getElementById("errorSector").innerHTML = "Por favor elige su sector de salida!";
            err_code=1;
        }
        else
            document.getElementById("errorSector").innerHTML = "";
        if(destino==0)
        {
            document.getElementById("errorSectorDestino").innerHTML = "Por favor elige su sector destino!";
            err_code=1;
        }
        else
            document.getElementById("errorSectorDestino").innerHTML = "";
        if(fechaviaje==null || fechaviaje=='')
        {
            document.getElementById("errorFecha").innerHTML = "Por favor indica su fecha de viaje!";
            err_code=1;
        }
        else
            document.getElementById("errorFecha").innerHTML = "";

        if(costo_viaje==null || costo_viaje=='')
        {
            document.getElementById("errorCosto").innerHTML = "Por favor indica costo de viaje por cada persona!";
            err_code=1;
        }
        else
            document.getElementById("errorCosto").innerHTML = "";
        //alert(fechaviaje+"_"+horaviaje+":"+minutosviaje+"&nroequipaje="+nroEquipaje+"&nroasientes="+nroAsientes);
        if(err_code==0 && confirm("INFORMACIÓN: Has seleccionado el horario de "+horaviaje+". Recuerda que a esa hora, debes estar ya en camino a su destino y deberás recoger a los pasajeros con anterioridad a esa hora, con el fin de llegar puntualmente a tu destino. Se sugiere una franja de 30 minutos para recoger a todos los usuarios, pero es tu decisión y responsabilidad recogerlos a tiempo para que lleguen a tiempo"))
        {
            if(sector!=0 && destino!=0 &&!(fechaviaje==null || fechaviaje==''))
            {
                //alert("1");
                xmlhttp.onreadystatechange = function() 
                {
                    if (this.readyState == 4 && this.status == 200) 
                    {
                        document.getElementById("estadoPublicarViaje").innerHTML = this.responseText;
                    }
                };
                
                xmlhttp.open("GET", "doPublicarViaje.php?sector="+sector+"&destino="+destino+"&fechaviaje="+fechaviaje+" "+horaviaje+":00"+"&nroequipaje="+nroEquipaje+"&costo_viaje="+costo_viaje+"&nroasientes="+nroAsientes+"&mascotas="+mascotas+"&fumar="+fumar+"&alcohol="+alcohol+"&automovilID="+automovilID+"&paradascomer="+paradascomer+"&diligencias="+diligencias+"&mercancias="+mercancias, true);
                xmlhttp.send();
            }
        }
        
    });

    
    $("#btnPermisosNotificacion").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();

        var noti_id=document.getElementById("noti_id").value;
        
        var noti_viaje_publicado=document.getElementById("noti_viaje_publicado").value;
        var noti_viaje_reservado=document.getElementById("noti_viaje_reservado").value;
        var noti_cambio_viaje_publicado=document.getElementById("noti_cambio_viaje_publicado").value;
        var noti_cambio_viaje_reservado=document.getElementById("noti_cambio_viaje_reservado").value;
        var noti_publicos=document.getElementById("noti_publicos").value;
        var noti_privados=document.getElementById("noti_privados").value;
        var noti_viaje_publicado=0;
        var noti_viaje_reservado = 0;
        var noti_cambio_viaje_publicado = 0;
        var noti_cambio_viaje_reservado = 0;
        var noti_publicos = 0;
        var noti_privados = 0;
        if(document.getElementById("noti_viaje_publicado").checked)
            noti_viaje_publicado=1;
        if(document.getElementById("noti_viaje_reservado").checked)
            noti_viaje_reservado=1;
        if(document.getElementById("noti_cambio_viaje_publicado").checked)
            noti_cambio_viaje_publicado=1;
        if(document.getElementById("noti_cambio_viaje_reservado").checked)
            noti_cambio_viaje_reservado=1;
        if(document.getElementById("noti_publicos").checked)
            noti_publicos=1;
        if(document.getElementById("noti_privados").checked)
            noti_privados=1;

        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                document.getElementById("message").innerHTML = this.responseText;
            }
        };
        
        xmlhttp.open("GET", "doconfigurarnotificaciones.php?noti_id="+noti_id+"&noti_viaje_publicado="+noti_viaje_publicado+"&noti_viaje_reservado="+noti_viaje_reservado+"&noti_cambio_viaje_publicado="+noti_cambio_viaje_publicado+"&noti_cambio_viaje_reservado="+noti_cambio_viaje_reservado+"&noti_publicos="+noti_publicos+"&noti_privados="+noti_privados, true);
        xmlhttp.send();
    }); 

    $("#btnSumbitConductorCalificacion").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        var rating=document.getElementById("rate_selected").value;
        var conductorID=document.getElementById("conductorID").value;
        var viajeID=document.getElementById("viajeID").value;
        //alert(rating);
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                setTimeout(
                  function() 
                  {
                    //do something special
                  }, 50000);

                location.reload();    
                document.getElementById("message").innerHTML = this.responseText;
            }
            
        };
        xmlhttp.open("GET", "updateRatings.php?tipo=1&conductorId="+conductorID+"&rating="+rating+"&viajeId="+viajeID, true);
        xmlhttp.send();
    }); 

    $("#btnSumbitVehicleCalificacion").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        var rating=document.getElementById("rate_veh_selected").value;
        var vehicleID=document.getElementById("vehicleID").value;
        var viajeID=document.getElementById("viajeID").value;
        //alert(rating);
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                setTimeout(
                  function() 
                  {
                    //do something special
                  }, 50000);

                location.reload();    
                document.getElementById("message").innerHTML = this.responseText;
            }
            
        };
        xmlhttp.open("GET", "updateRatings.php?tipo=2&vehicleId="+vehicleID+"&rating="+rating+"&viajeId="+viajeID, true);
        xmlhttp.send();
    });               

    
    $("#btnActualizarGaleria").click(function () 
    {
        $("#panelGaleria").toggle("1000","swing");
    });


    /*try
    {

        if(document.getElementById("rn_latitude").value && document.getElementById("rn_longitude").value)
        {
            //alert("1");
              lat = document.getElementById("rn_latitude").value;
              lon = document.getElementById("rn_longitude").value;
              latlon = new google.maps.LatLng(lat, lon)
              //alert("HI-2");
              mapholder = document.getElementById('mapholder')
              mapholder.style.height = '250px';
              mapholder.style.width = '100%';
              //alert("HI-3");
              var myOptions = {
              center:latlon,zoom:14,
              mapTypeId:google.maps.MapTypeId.ROADMAP,
              mapTypeControl:false,
              navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
              }
              //alert("HI-4");
              var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
              var marker = new google.maps.Marker({position:latlon,map:map,title:"You are here!"});
        }
        else
        {
            //alert("2");
            if (navigator.geolocation) 
            {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } 
            else 
            { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }
    }
    catch(err)
    {

    } */
    
});


function getFranjas(id,sector,nroasientes,c_viaje)
{
    var xmlhttp = new XMLHttpRequest();
    $("#viajes").show(1000);
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            document.getElementById("viajes").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "getfranjas.php?c_viaje="+c_viaje+"&horavuelo=" + id+"&sector="+sector+"&nroasientes="+nroasientes, true);
    xmlhttp.send();
}


function terminarViaje(codigo_viaje,codigo_pago)
{
    //alert(codigo_pago);
    var xmlhttp = new XMLHttpRequest();
    $("#viajes").show(1000);
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //document.getElementById("viajes").innerHTML = this.responseText;
            location.reload();
        }
    };
    xmlhttp.open("GET", "terminateViaje.php?codigo_viaje="+codigo_viaje+"&codigo_pago="+codigo_pago, true);
    xmlhttp.send();
}


function getTerminals()
{
    var xmlhttp = new XMLHttpRequest();
    var ciudad_id = window.document.getElementById("ciudad").value;
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //alert(ciudad_id);
            document.getElementById("sector").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "getTerminals.php?idciudad=" + ciudad_id, true);
    xmlhttp.send();
}

function getTerminalsDestino()
{
    var xmlhttp = new XMLHttpRequest();
    var ciudaddestino_id = window.document.getElementById("ciudaddestino").value;
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //alert(ciudad_id);
            document.getElementById("sectordestino").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "getTerminals.php?idciudad=" + ciudaddestino_id, true);
    xmlhttp.send();
}

function validateEmail()
{
    var email = document.getElementById("email").value;
    var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
        alert("Formato Email invalidao. Por favor ingresa su email correctamente.");
        return false;
    }
    else
        return true;
}



function calcularCosto() 
{   
    //$("#panelPago").show();

    var costoAsiento = 0;
    var costoIda = 0;
    var asientesctr = window.document.getElementById("nroasientessearch").value;
    //alert('asientesctr::'+asientesctr);
    if(asientesctr==1)
    {
        costoIda = 12;
    }
    else if(asientesctr==2)
    {
        costoIda = 20;
    }
    else if(asientesctr==5)
    {
        costoIda = 25;
    }
    
    var cantidadRetorno = window.document.getElementById("cantidadRetorno").value;
    //alert('cantidadRetorno::'+cantidadRetorno);
    //var costoAsiento = window.document.getElementById("costoAsiento").value;
    //var eligoretorno = $("input[type='radio'][name='eligoretorno']:checked").val();
    //alert(eligoretorno);
    if(cantidadRetorno>0)
    {
        window.document.getElementById("costoTotal").innerHTML = "<br><h1 style='background:#00b0f0;padding:10px;border:1px solid #00b0f0;color:#FFF'><b>VALOR TOTAL A PAGAR : $ </b> $ "+(costoIda + (cantidadRetorno * 6))+".00</h1>";
    }
    else
    {
        window.document.getElementById("costoTotal").innerHTML = "<br><h1 style='background:#00b0f0;padding:10px;border:1px solid #00b0f0;color:#FFF'><b>VALOR TOTAL A PAGAR : $ </b> $ "+costoIda+".00</h1>";
    }
    

    if(cantidadRetorno==1)
    {
        $("#cedula1").show();
        $("#cedula2").hide();
        $("#cedula3").hide();
        $("#cedula4").hide();
    }
    else if(cantidadRetorno==2)
    {
        $("#cedula1").show();
        $("#cedula2").show();
        $("#cedula3").hide();
        $("#cedula4").hide();
    }
    else if(cantidadRetorno==3)
    {
        $("#cedula1").show();
        $("#cedula2").show();
        $("#cedula3").show();
        $("#cedula4").hide();
    }
    else if(cantidadRetorno==4)
    {
        $("#cedula1").show();
        $("#cedula2").show();
        $("#cedula3").show();
        $("#cedula4").show();
    }
    else if(cantidadRetorno==0)
    {
        $("#cedula1").hide();
        $("#cedula2").hide();
        $("#cedula3").hide();
        $("#cedula4").hide();
    }
    
    /*$('html, body').animate({
        scrollTop: $("#costoTotal").offset().top
    }, 1000);*/
}


function abrirPanelSearch() 
{   
    $("#control_panel_search").show();
    var searchTipo = $("input[type='radio'][name='searchtipo']:checked").val();
    if(searchtipo=="1")
    {
        manageSearchPanel.php
    }
    
    
    $('html, body').animate({
        scrollTop: $("#costoTotal").offset().top
    }, 1000);
}

function changeRating() 
{
    document.getElementById("rate").innerHTML = document.getElementById("myRange").value;
    document.getElementById("rate_selected").value = document.getElementById("myRange").value;
}

function changeRatingVehicle() 
{
    document.getElementById("rate_veh").innerHTML = document.getElementById("myRangeVeh").value;
    document.getElementById("rate_veh_selected").value = document.getElementById("myRangeVeh").value;
}


function displayGalleryImg(imgId)
{
    $("#myCarousel").carousel(imgId);
}


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

function showPosition(position) 
{
    alert("HI");
    alert("Set Location:LAT:"+position.coords.latitude);
    alert("Set Location:LON:"+position.coords.longitude);
    document.getElementById('rn_latitude').value = position.coords.latitude;
    document.getElementById('rn_longitude').value = position.coords.longitude;
    alert("HI-1");
    lat = position.coords.latitude;
    lon = position.coords.longitude;
    latlon = new google.maps.LatLng(lat, lon)
    alert("HI-2");
    mapholder = document.getElementById('mapholder')
    mapholder.style.height = '250px';
    mapholder.style.width = '100%';
    alert("HI-3");
    var myOptions = {
    center:latlon,zoom:16,
    mapTypeId:google.maps.MapTypeId.ROADMAP,
    mapTypeControl:false,
    navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
    }
    alert("HI-4");
    var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
    var marker = new google.maps.Marker({position:latlon,map:map,title:"You are here!"});
    alert("HI-5");
}


function showMap(element) 
{   
            //alert("HI-3:"+window.document.getElementById("sector").value);
            var ln=window.document.getElementById("sector").value.split(":");
            var latitud_longitud = ln[1].split(",");
            //alert("HI-31:"+latitud_longitud[0]);
            //alert("HI-32:"+latitud_longitud[1]);
            latlon=new google.maps.LatLng(latitud_longitud[0],latitud_longitud[1]);
            //latlon=new google.maps.LatLng(-0.1815911,-78.5085319);
            
            //latlon=new google.maps.LatLng(window.document.getElementById("mapLatLon").value.trim());
            mapholder = document.getElementById('mapa')
            mapholder.style.minHeight  = '250px';
            mapholder.style.width = '100%';
            
            var myOptions = {
            center:latlon,zoom:17,
            mapTypeId:google.maps.MapTypeId.ROADMAP,
            mapTypeControl:false,
            navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
            }
            //alert("HI-4");
            var map = new google.maps.Map(document.getElementById("mapa"), myOptions);
            //alert();
            var marker = new google.maps.Marker({position:latlon,label:element.options[element.selectedIndex].text,map:map,title:"You are here!"});
            //alert("HI-5");
}

function showError(error) 
{
    
    switch(error.code) 
    {
        case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
        default: alert("Error:");
    }
}

function validatePlanificarViajeData()
{   
    var fechaviajesearch = window.document.getElementById("fechaviajesearch").value;
    var sector = window.document.getElementById("sector").value;
    var calle_principal=window.document.getElementById("calle_principal").value;
    var numeracion=window.document.getElementById("numeracion").value;
    var calle_secundario=window.document.getElementById("calle_secundario").value;
    var referencia=window.document.getElementById("referencia").value;
    
    var errcode=0;
    if(fechaviajesearch==null || fechaviajesearch=='')
    {
        document.getElementById("errorFecha").innerHTML = "Por favor indica su fecha de viaje!";
        errcode=1;
    }
    else
        document.getElementById("errorFecha").innerHTML = "";
    
    if(sector==0)
    {
        document.getElementById("errorSector").innerHTML = "Por favor elige su sector!";
        errcode=1;
    }
    else
        document.getElementById("errorSector").innerHTML = "";
    
    if(calle_principal==null || calle_principal=='')
    {
        document.getElementById("errorCallePrincipal").innerHTML = "Por favor Indicar su calle principal!";
        errcode=1;
    }
    else
        document.getElementById("errorCallePrincipal").innerHTML = "";
    
    if(numeracion==null || numeracion=='')
    {
        /*document.getElementById("errorNumeracion").innerHTML = "Por favor Indicar numeracion!";
        errcode=1;*/
        window.document.getElementById("numeracion").value="";
    }
    else
        document.getElementById("errorNumeracion").innerHTML = "";
    
    if(calle_secundario==null || calle_secundario=='')
    {
        document.getElementById("errorCalleSecundario").innerHTML = "Por favor Indicar su calle secundaria!";
        errcode=1;
    }
    else
        document.getElementById("errorCalleSecundario").innerHTML = "";
    
    if(referencia==null || referencia=='')
    {
        document.getElementById("errorReferencia").innerHTML = "Por favor Indicar una referencia!";
        errcode=1;
    }
    else
        document.getElementById("errorReferencia").innerHTML = "";

    if(errcode==1)
        return false;
    else
        return true;
}

function validatePlanificarViajeDataBeforeConfirmation()
{   
    //alert("validatePlanificarViajeDataBeforeConfirmation");
    var cantidadRetorno = window.document.getElementById("cantidadRetorno").value;
        
    var errcode=0;
    if(cantidadRetorno==1)
    {
        var ced1 = window.document.getElementById("ced1").value;
        if(ced1==null || ced1=='')
            errcode=1;
    }
    else if(cantidadRetorno==2)
    {
        var ced1 = window.document.getElementById("ced1").value;
        var ced2 = window.document.getElementById("ced2").value;
        if(ced1==null || ced1=='')
            errcode=1;
        else if(ced2==null || ced2=='')
            errcode=1;
    }
    else if(cantidadRetorno==3)
    {
        var ced1 = window.document.getElementById("ced1").value;
        var ced2 = window.document.getElementById("ced2").value;
        var ced3 = window.document.getElementById("ced3").value;
        if(ced1==null || ced1=='')
            errcode=1;
        else if(ced2==null || ced2=='')
            errcode=1;
        else if(ced3==null || ced3=='')
            errcode=1;
    }
    else if(cantidadRetorno==4)
    {
        var ced1 = window.document.getElementById("ced1").value;
        var ced2 = window.document.getElementById("ced2").value;
        var ced3 = window.document.getElementById("ced3").value;
        var ced4 = window.document.getElementById("ced4").value;
        if(ced1==null || ced1=='')
            errcode=1;
        else if(ced2==null || ced2=='')
            errcode=1;
        else if(ced3==null || ced3=='')
            errcode=1;
        else if(ced4==null || ced4=='')
            errcode=1;
    }
    

    //document.getElementById("errorReferencia").innerHTML = "";
    //alert("2");
    if(errcode==1)
    {
        document.getElementById("errorMsgCedulas").innerHTML = "INGREASR NRO IDENTIFICACIONES DE CADA PASAJERO";
        return false;
    }
    else
    {
        document.getElementById("errorMsgCedulas").innerHTML = "";
        return true;
    }
}


function checkConductorIsSelected()
{
    if(document.getElementById("conductor").value==0)
    {
        return false;
    }
    else
        return true;
}

function addToListList(id,asientos, position)
{

    if(checkConductorIsSelected())
    {
        var myList = document.getElementById("id_viaje_selected").value.split(",");
        var asientosSelectedList = document.getElementById("asientos_selected").value.split(",");
        var total_asientos = document.getElementById("total_asientos").value;

        var myListCopy = document.getElementById("id_viaje_selected").value.split(",");
        var asientosSelectedListCopy = document.getElementById("asientos_selected").value.split(",");
        var total_asientosCopy = document.getElementById("total_asientos").value;

        var conductor_capacity = document.getElementById("conductor").value.split(":")[1];
        var newList="";
        var newAsientosList="";
        var asientosCount=0;
        var ctr=0;
        //alert(asientos);
        
        //alert(conductor_capacity);
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
                    {
                        newList=myList[i];
                        newAsientosList = asientosSelectedList[i];
                        asientosCount = parseInt(asientosSelectedList[i]);
                    }
                    else
                    {
                        newList=newList+","+myList[i];
                        newAsientosList = newAsientosList+","+asientosSelectedList[i];
                        asientosCount = asientosCount+parseInt(asientosSelectedList[i]);
                    }
                }
            }        
        }
        if(ctr==0)
        {
            document.getElementById("id_viaje_selected").value=newList+","+id;
            document.getElementById("asientos_selected").value=newAsientosList+","+asientos;
            //document.getElementById("total_asientos").value=asientosCount+parseInt(asientos);
            asientosCount=asientosCount+parseInt(asientos);
        }
        else
        {
            document.getElementById("id_viaje_selected").value=newList;
            document.getElementById("asientos_selected").value=newAsientosList;
            //document.getElementById("total_asientos").value=asientosCount;
        }

        if(conductor_capacity<asientosCount)
        {
            alert("Suma de asientos seleccionados exceede numero de asientos disponible para la conductor elejido.")
            document.getElementById("id_viaje_selected").value=myListCopy;
            document.getElementById("asientos_selected").value=asientosSelectedListCopy;
            document.getElementById("total_asientos").value=total_asientosCopy;
            //this.prop('checked',false);
            document.getElementById("check_"+position).checked=false;
        }
        else
        {
            document.getElementById("total_asientos").value=asientosCount
        }
    }
    else
    {
        alert("Por favor primero elige un conductor ");
    }
}


function validateViajesYConductor()
{
    var id_viaje_selected=document.getElementById("id_viaje_selected").value;
    //var conductor=document.getElementById("conductor").value.split(":")[0];
    //alert(id_viaje_selected);
    if(id_viaje_selected.length==1)
    {
        document.getElementById("errorViajesSelected").innerHTML="Por favor elige viajes para asignar a conductor";
        return false;
    }
    else
        return true;


    //return false;
}