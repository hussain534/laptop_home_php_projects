$(document).ready(function()
{   
    $('#progress').hide();
    $('#editPerfilPanel').hide();
    $('#editSucursalPanel').hide();
    $('#editClientePanel').hide();
    $('#editMenuPanel').hide();
    $('#editSalaPanel').hide();
    $('#editCiudadPanel').hide();
    $('#editUserPanel').hide();

    //handleEquipoList();
    

    //$("#tbl_entidad_solicitud").hide();    
   
    $("#addEntidad").click(function () 
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
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $("#addPerfil").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var perfil_name = window.document.getElementById("perfil_name").value;
        var idPerfilPadre = window.document.getElementById("idPerfilPadre").value;

        if(perfil_name==null || perfil_name=='')
            document.getElementById("error_perfil_name").innerHTML = "Por favor ingresa nombre del perfil!";
        else
            document.getElementById("error_perfil_name").innerHTML = "";
        if(idPerfilPadre==0)
            document.getElementById("error_perfil_padre").innerHTML = "Por favor elige padre del perfil!";
        else
            document.getElementById("error_perfil_padre").innerHTML = "";
        if(perfil_name!=null && perfil_name!='' && idPerfilPadre>0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=2&metodo=0&nombre_perfil="+perfil_name+"&perfil_padre="+idPerfilPadre, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $("#addSucursal").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var sucursal_name = window.document.getElementById("sucursal_name").value;
        var idCiudad = window.document.getElementById("idCiudad").value;

        if(sucursal_name==null || sucursal_name=='')
            document.getElementById("error_sucursal_name").innerHTML = "Por favor ingresa nombre del sucursal!";
        else
            document.getElementById("error_sucursal_name").innerHTML = "";
        if(idCiudad==0)
            document.getElementById("error_ciudad").innerHTML = "Por favor elige ciudad del sucursal!";
        else
            document.getElementById("error_ciudad").innerHTML = "";
        if(sucursal_name!=null && sucursal_name!='' && idCiudad>0)
        {sucursal_name
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=7&metodo=0&sucursal_name="+sucursal_name+"&idCiudad="+idCiudad, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $("#editPerfil").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var perfil_name = window.document.getElementById("perfil_name").value;
        var id_perfil = window.document.getElementById("id_perfil").value;
        var idPerfilPadre = window.document.getElementById("idPerfilPadre").value;
        //alert(idPerfilPadre);
        if(perfil_name==null || perfil_name=='')
            document.getElementById("error_perfil_name").innerHTML = "Por favor ingresa nombre del perfil!";
        else
            document.getElementById("error_perfil_name").innerHTML = "";
        if(perfil_name!=null && perfil_name!='')
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=2&metodo=2&id_perfil="+id_perfil+"&nombre_perfil="+perfil_name+"&idPerfilPadre="+idPerfilPadre, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

       

    $("#cancelEditPerfil").click(function () 
    {
        $('#editPerfilPanel').hide("slow");
        $('#addPerfil').show("slow");   
        //$('#perfilPadrePanel').show("slow");
        document.getElementById("perfil_name").value="";
        document.getElementById("id_perfil").value=0;
    });

    $("#cancelEditUser").click(function () 
    {
        $('#editUserPanel').hide("slow");
        $('#addUser').show("slow");   
        $('#buscarUser').show("slow");
        document.getElementById("user_name").value="";
        document.getElementById("user_id").value=0;
        document.getElementById("user_email").value="";
        document.getElementById("user_tele").value=""
        document.getElementById("user_celular").value=""
        document.getElementById("user_direccion").value=""
    });

    $("#cancelEditSucursal").click(function () 
    {
        $('#editSucursalPanel').hide("slow");
        $('#addSucursal').show("slow");   
        $('#sucursalPanel').show("slow");
        document.getElementById("sucursal_name").value="";
        document.getElementById("idCiudad").value=0;
    });

    $("#cancelEditCiudad").click(function () 
    {
        $('#editCiudadPanel').hide("slow");
        $('#addCiudad').show("slow");   
        //$('#sucursalPanel').show("slow");
        document.getElementById("ciudad_name").value="";
        document.getElementById("id_ciudad").value=0;
    });

    $("#cancelEditSala").click(function () 
    {
        $('#editSalaPanel').hide("slow");
        $('#addSala').show("slow");   
        $('#salaPanel').show("slow");
        document.getElementById("sala_name").value="";
        document.getElementById("id_sala").value=0;
    });

    
    $("#cancelEditCliente").click(function () 
    {
        $('#editClientePanel').hide("slow");
        $('#addCliente').show("slow");   
        //$('#perfilPadrePanel').show("slow");
        document.getElementById("client_name").value="";
        document.getElementById("client_admin").value="";
        document.getElementById("admin_id").value="";
        document.getElementById("id_cliente").value=0;
        document.getElementById("client_telefono").value="";
        document.getElementById("client_celular").value="";
        document.getElementById("client_email").value="";
    });

    
    $("#cancelEditMenu").click(function () 
    {
        $('#editMenuPanel').hide("slow");
        $('#addMenu').show("slow");   
        //$('#perfilPadrePanel').show("slow");
        document.getElementById("client_name").value="";
        document.getElementById("id_cliente").value=0;
        document.getElementById("client_telefono").value="";
        document.getElementById("client_celular").value="";
        document.getElementById("client_email").value="";

        document.getElementById("menu_sec").value="";
        document.getElementById("menu_nombre").value="";
        document.getElementById("menu_url").value="";
        document.getElementById("id_menu").value=0;
        document.getElementById("old_menu_sec").value="";
    });


    $("#addCiudad").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var ciudad_name = window.document.getElementById("ciudad_name").value;

        if(ciudad_name==null || ciudad_name=='')
            document.getElementById("error_ciudad_name").innerHTML = "Por favor ingresa nombre del ciudad!";
        else
            document.getElementById("error_ciudad_name").innerHTML = "";
        
        if(ciudad_name!=null && ciudad_name!='')
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=3&metodo=0&nombre_ciudad="+ciudad_name, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });


    $("#cambiarClave").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        var err=0;
        $('#progress').show();
        var clave_anterior = window.document.getElementById("clave_anterior").value;
        var clave_nuevo = window.document.getElementById("clave_nuevo").value;
        var confirmar_clave = window.document.getElementById("confirmar_clave").value;

        if(clave_anterior==null || clave_anterior=='')
        {
            document.getElementById("error_clave_anterior").innerHTML = "Por favor ingresa clave anterior!";
            err=1;
        }
        else
            document.getElementById("error_clave_anterior").innerHTML = "";

        if(clave_nuevo==null || clave_nuevo=='')
        {
            document.getElementById("error_clave_nuevo").innerHTML = "Por favor ingresa clave nuevo!";
            err=1;
        }
        else
            document.getElementById("error_clave_nuevo").innerHTML = "";

        if(confirmar_clave==null || confirmar_clave=='')
        {
            document.getElementById("error_confirmar_clave").innerHTML = "Por favor confirmar clave nuevo!";
            err=1;
        }
        else
            document.getElementById("error_confirmar_clave").innerHTML = "";
        
        if(confirmar_clave==clave_nuevo)
        {
            document.getElementById("error_confirmar_clave").innerHTML = "";            
        }
        else
        {
            document.getElementById("error_confirmar_clave").innerHTML = "Clave nuevo y Confirmar clave nuevo no son iguales. Por favor ingresa los dos valores correctamente!";
            err=1;   
        }


        if(err==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=98&metodo=2&clave_anterior="+clave_anterior+"&clave_nuevo="+clave_nuevo, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $("#registrarCliente").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var checkErr=0;
        var client_name = window.document.getElementById("client_name").value;
        var ciudad_cliente = window.document.getElementById("ciudad_cliente").value;
        var client_telefono = window.document.getElementById("client_telefono").value;
        var client_celular = window.document.getElementById("client_celular").value;
        var client_email = window.document.getElementById("client_email").value;
        var admin_name = window.document.getElementById("admin_name").value;
        var admin_password = window.document.getElementById("admin_password").value;
        if(client_name==null || client_name=='')
        {
            document.getElementById("error_client_name").innerHTML = "Por favor ingresa nombre del cliente!";
            checkErr=1;
        }
        else
            document.getElementById("error_client_name").innerHTML = "";
        
        if(ciudad_cliente==0)
        {
            document.getElementById("error_ciudad_cliente").innerHTML = "Por favor elige ciudad del cliente!";
            checkErr=1;
        }
        else
            document.getElementById("error_ciudad_cliente").innerHTML = "";
        
        if(client_telefono==null || client_telefono=='')
        {
            document.getElementById("error_client_telefono").innerHTML = "Por favor ingresa telefono del administrador!";
            checkErr=1;
        }
        else
            document.getElementById("error_client_telefono").innerHTML = "";
        
        if(client_celular==null || client_celular=='')
        {
            document.getElementById("error_client_celular").innerHTML = "Por favor ingresa celular del administrador!";
            checkErr=1;
        }
        else
            document.getElementById("error_client_celular").innerHTML = "";
        
        if(client_email==null || client_email=='')
        {
            document.getElementById("error_client_email").innerHTML = "Por favor ingresa email del administrador!";
            checkErr=1;
        }
        else
            document.getElementById("error_client_email").innerHTML = "";

        if(admin_name==null || admin_name=='')
        {
            document.getElementById("error_admin_name").innerHTML = "Por favor ingresa nombre del administrador!";
            checkErr=1;
        }
        else
            document.getElementById("error_admin_name").innerHTML = "";

        if(admin_password==null || admin_password=='')
        {
            document.getElementById("error_admin_password").innerHTML = "Por favor ingresa contrasena del administrador!";
            checkErr=1;
        }
        else
            document.getElementById("error_admin_password").innerHTML = "";
        
        if(checkErr==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    //location.reload();
                    document.getElementById("mensaje").innerHTML =this.responseText;
                    window.setTimeout(function() {
                        window.location.href = 'http://sistec.hutesol.com';
                    }, 20000);
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=0&metodo=0&nombre_cliente="+client_name+"&ciudad_cliente="+ciudad_cliente+"&client_telefono="+client_telefono+"&client_celular="+client_celular+"&client_email="+client_email+"&admin_name="+admin_name+"&admin_password="+admin_password, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $("#addCliente").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var checkErr=0;
        var client_name = window.document.getElementById("client_name").value;
        var ciudad_cliente = window.document.getElementById("ciudad_cliente").value;
        var client_telefono = window.document.getElementById("client_telefono").value;
        var client_celular = window.document.getElementById("client_celular").value;
        var client_email = window.document.getElementById("client_email").value;
        var id_cliente = window.document.getElementById("id_cliente").value;
        if(client_name==null || client_name=='')
        {
            document.getElementById("error_client_name").innerHTML = "Por favor ingresa nombre del cliente!";
            checkErr=1;
        }
        else
            document.getElementById("error_client_name").innerHTML = "";
        
        if(ciudad_cliente==0)
        {
            document.getElementById("error_ciudad_cliente").innerHTML = "Por favor elige ciudad del cliente!";
            checkErr=1;
        }
        else
            document.getElementById("error_ciudad_cliente").innerHTML = "";
        
        if(client_telefono==null || client_telefono=='')
        {
            document.getElementById("error_client_telefono").innerHTML = "Por favor ingresa telefono del cliente!";
            checkErr=1;
        }
        else
            document.getElementById("error_client_telefono").innerHTML = "";
        
        if(client_celular==null || client_celular=='')
        {
            document.getElementById("error_client_celular").innerHTML = "Por favor ingresa celular del cliente!";
            checkErr=1;
        }
        else
            document.getElementById("error_client_celular").innerHTML = "";
        
        if(client_email==null || client_email=='')
        {
            document.getElementById("error_client_email").innerHTML = "Por favor ingresa email del cliente!";
            checkErr=1;
        }
        else
            document.getElementById("error_client_email").innerHTML = "";
        
        if(checkErr==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=4&metodo=0&nombre_cliente="+client_name+"&ciudad_cliente="+ciudad_cliente+"&client_telefono="+client_telefono+"&client_celular="+client_celular+"&client_email="+client_email, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $("#editCliente").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var checkErr=0;
        var client_name = window.document.getElementById("client_name").value;
        var client_admin = window.document.getElementById("client_admin").value;
        var client_admin_id = window.document.getElementById("admin_id").value;
        var ciudad_cliente = window.document.getElementById("ciudad_cliente").value;
        var client_telefono = window.document.getElementById("client_telefono").value;
        var client_celular = window.document.getElementById("client_celular").value;
        var client_email = window.document.getElementById("client_email").value;
        var id_cliente = window.document.getElementById("id_cliente").value;
        if(client_name==null || client_name=='')
        {
            document.getElementById("error_client_name").innerHTML = "Por favor ingresa nombre del cliente!";
            checkErr=1;
        }
        else
            document.getElementById("error_client_name").innerHTML = "";

         if(client_admin==null || client_admin=='')
        {
            document.getElementById("error_client_admin").innerHTML = "Por favor ingresa nombre del administrador!";
            checkErr=1;
        }
        else
            document.getElementById("error_client_admin").innerHTML = "";
        
        if(ciudad_cliente==0)
        {
            document.getElementById("error_ciudad_cliente").innerHTML = "Por favor elige ciudad del cliente!";
            checkErr=1;
        }
        else
            document.getElementById("error_ciudad_cliente").innerHTML = "";
        
        if(client_telefono==null || client_telefono=='')
        {
            document.getElementById("error_client_telefono").innerHTML = "Por favor ingresa telefono del cliente!";
            checkErr=1;
        }
        else
            document.getElementById("error_client_telefono").innerHTML = "";
        
        if(client_celular==null || client_celular=='')
        {
            document.getElementById("error_client_celular").innerHTML = "Por favor ingresa celular del cliente!";
            checkErr=1;
        }
        else
            document.getElementById("error_client_celular").innerHTML = "";
        
        if(client_email==null || client_email=='')
        {
            document.getElementById("error_client_email").innerHTML = "Por favor ingresa email del cliente!";
            checkErr=1;
        }
        else
            document.getElementById("error_client_email").innerHTML = "";
        
        if(checkErr==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=4&metodo=2&id_cliente="+id_cliente+"&nombre_cliente="+client_name+"&ciudad_cliente="+ciudad_cliente+"&client_telefono="+client_telefono+"&client_celular="+client_celular+"&client_email="+client_email+"&client_admin="+client_admin+"&client_admin_id="+client_admin_id, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $("#editUser").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var checkErr=0;
        var user_id = window.document.getElementById("user_id").value;
        var user_name = window.document.getElementById("user_name").value;
        var user_email = window.document.getElementById("user_email").value;
        var user_tele = window.document.getElementById("user_tele").value;
        var user_celular = window.document.getElementById("user_celular").value;
        var user_direccion = window.document.getElementById("user_direccion").value;
        var perfil_id = window.document.getElementById("perfil_id").value;
        var client_id = window.document.getElementById("client_id").value;
        var ciudad_id = window.document.getElementById("ciudad_id").value;
        var sucursal_id = window.document.getElementById("sucursal_id").value;
        var sala_id = window.document.getElementById("sala_id").value;
        var supervision_id = window.document.getElementById("supervision_id").value;

        if(user_name==null || user_name=='')
        {
            document.getElementById("error_user_name").innerHTML = "Por favor ingresa nombre!";
            checkErr=1;
        }
        else
            document.getElementById("error_user_name").innerHTML = "";
        
        if(user_email==0)
        {
            document.getElementById("error_user_email").innerHTML = "Por favor ingresa correo electronico!";
            checkErr=1;
        }
        else
            document.getElementById("error_user_email").innerHTML = "";
        
        if(user_tele==null || user_tele=='')
        {
            document.getElementById("error_user_tele").innerHTML = "Por favor ingresa telefono!";
            checkErr=1;
        }
        else
            document.getElementById("error_user_tele").innerHTML = "";
        
        if(user_celular==null || user_celular=='')
        {
            document.getElementById("error_user_celular").innerHTML = "Por favor ingresa celular!";
            checkErr=1;
        }
        else
            document.getElementById("error_user_celular").innerHTML = "";
        
        if(user_direccion==null || user_direccion=='')
        {
            document.getElementById("error_user_direccion").innerHTML = "Por favor ingresa direccion!";
            checkErr=1;
        }
        else
            document.getElementById("error_user_direccion").innerHTML = "";

        if(perfil_id==99)
        {
            document.getElementById("error_perfil").innerHTML = "Por favor elige perfil!";
            checkErr=1;
        }
        else
            document.getElementById("error_perfil").innerHTML = "";

        if(client_id==99)
        {
            document.getElementById("error_cliente").innerHTML = "Por favor elige cliente!";
            checkErr=1;
        }
        else
            document.getElementById("error_cliente").innerHTML = "";

        if(ciudad_id==99)
        {
            document.getElementById("error_ciudad").innerHTML = "Por favor elige ciudad!";
            checkErr=1;
        }
        else
            document.getElementById("error_ciudad").innerHTML = "";

        if(sucursal_id==99)
        {
            document.getElementById("error_sucursal").innerHTML = "Por favor elige sucursal!";
            checkErr=1;
        }
        else
            document.getElementById("error_sucursal").innerHTML = "";

        if(sala_id==99)
        {
            document.getElementById("error_sala").innerHTML = "Por favor Elige sala!";
            checkErr=1;
        }
        else
            document.getElementById("error_sala").innerHTML = "";
        
        if(checkErr==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    //alert(this.responseText);
                    location.reload();
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=9&metodo=4&user_id="+user_id+"&supervision_id="+supervision_id+"&user_name="+user_name+"&user_email="+user_email+"&user_tele="+user_tele+"&user_celular="+user_celular+"&user_direccion="+user_direccion+"&perfil_id="+perfil_id+"&client_id="+client_id+"&ciudad_id="+ciudad_id+"&sucursal_id="+sucursal_id+"&sala_id="+sala_id, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $("#addMenu").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var menu_sec = window.document.getElementById("menu_sec").value;
        var menu_tipo = window.document.getElementById("menu_tipo").value;
        var menu_nombre = window.document.getElementById("menu_nombre").value;
        var menu_url = window.document.getElementById("menu_url").value;

        var err=0;
        if(menu_sec==null || menu_sec=='')
        {
            err=1;
            document.getElementById("error_menu_sec").innerHTML = "Por favor ingresa Secuencial del menu!";
        }
        else
            document.getElementById("error_menu_sec").innerHTML = "";

        if(menu_tipo==99)
        {
            err=1;
            document.getElementById("error_menu_tipo").innerHTML = "Por favor ingresa tipo(Padre/Hijo) del menu!";
        }
        else
            document.getElementById("error_menu_tipo").innerHTML = "";

        if(menu_nombre==null || menu_nombre=='')
        {
            err=1;
            document.getElementById("error_menu_nombre").innerHTML = "Por favor ingresa nombre del menu!";
        }
        else
            document.getElementById("error_menu_nombre").innerHTML = "";

        if(menu_url==null || menu_url=='')
        {
            err=1;
            document.getElementById("error_menu_url").innerHTML = "Por favor ingresa URL del menu!";
        }
        else
            document.getElementById("error_menu_url").innerHTML = "";
        
        if(err==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                //alert('1');
                if (this.readyState == 4 && this.status == 200) 
                {
                    //alert(this.responseText);
                    location.reload();
                    //document.getElementById("tbl_entidad").innerHTML =this.responseText;
                }
                //alert('3');
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=5&metodo=0&menu_sec="+menu_sec+"&menu_tipo="+menu_tipo+"&menu_nombre="+menu_nombre+"&menu_url="+menu_url, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });


    

    $("#editMenu").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var menu_sec = window.document.getElementById("menu_sec").value;
        var menu_tipo = window.document.getElementById("menu_tipo").value;
        var menu_nombre = window.document.getElementById("menu_nombre").value;
        var menu_url = window.document.getElementById("menu_url").value;
        var id_menu = window.document.getElementById("id_menu").value;
        var old_menu_sec = window.document.getElementById("old_menu_sec").value;

        var err=0;
        if(menu_sec==null || menu_sec=='')
        {
            err=1;
            document.getElementById("error_menu_sec").innerHTML = "Por favor ingresa Secuencial del menu!";
        }
        else
            document.getElementById("error_menu_sec").innerHTML = "";

        if(menu_tipo==99)
        {
            err=1;
            document.getElementById("error_menu_tipo").innerHTML = "Por favor ingresa tipo(Padre/Hijo) del menu!";
        }
        else
            document.getElementById("error_menu_tipo").innerHTML = "";

        if(menu_nombre==null || menu_nombre=='')
        {
            err=1;
            document.getElementById("error_menu_nombre").innerHTML = "Por favor ingresa nombre del menu!";
        }
        else
            document.getElementById("error_menu_nombre").innerHTML = "";

        if(menu_url==null || menu_url=='')
        {
            err=1;
            document.getElementById("error_menu_url").innerHTML = "Por favor ingresa URL del menu!";
        }
        else
            document.getElementById("error_menu_url").innerHTML = "";
        
        if(err==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                //alert('1');
                if (this.readyState == 4 && this.status == 200) 
                {
                    //alert(this.responseText);
                    location.reload();
                    //document.getElementById("tbl_entidad").innerHTML =this.responseText;
                }
                //alert('3');
            };
            //alert(id_menu);
            xmlhttp.open("GET", "datacontroller.php?dojob=5&metodo=2&id_menu="+id_menu+"&old_menu_sec="+old_menu_sec+"&menu_sec="+menu_sec+"&menu_tipo="+menu_tipo+"&menu_nombre="+menu_nombre+"&menu_url="+menu_url, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });



    $("#addPermisos").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var menu_id = window.document.getElementById("menu_id").value;
        var perfil = window.document.getElementById("perfil").value;

        var err=0;
        if(menu_id==99)
        {
            err=1;
            document.getElementById("error_menu_id").innerHTML = "Por favor elige un menu!";
        }
        else
            document.getElementById("error_menu_id").innerHTML = "";

        if(perfil==99)
        {
            err=1;
            document.getElementById("error_perfil").innerHTML = "Por favor elige perfil!";
        }
        else
            document.getElementById("error_perfil").innerHTML = "";

        
        if(err==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                //alert('1');
                if (this.readyState == 4 && this.status == 200) 
                {
                    //alert(this.responseText);
                    location.reload();
                    //document.getElementById("tbl_entidad").innerHTML =this.responseText;
                }
                //alert('3');
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=6&metodo=1&menu_id="+menu_id+"&perfil_id="+perfil, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $("#editSucursal").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var sucursal_name = window.document.getElementById("sucursal_name").value;
        var id_sucursal = window.document.getElementById("id_sucursal").value;

        if(sucursal_name==null || sucursal_name=='')
            document.getElementById("error_sucursal_name").innerHTML = "Por favor ingresa nombre del sucursal!";
        else
            document.getElementById("error_sucursal_name").innerHTML = "";
        if(sucursal_name!=null && sucursal_name!='')
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                }
            };
            //alert(sucursal_name);
            xmlhttp.open("GET", "datacontroller.php?dojob=7&metodo=2&id_sucursal="+id_sucursal+"&nombre_sucursal="+sucursal_name, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $("#editCiudad").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var ciudad_name = window.document.getElementById("ciudad_name").value;
        var id_ciudad = window.document.getElementById("id_ciudad").value;

        if(ciudad_name==null || ciudad_name=='')
            document.getElementById("error_ciudad_name").innerHTML = "Por favor ingresa nombre del ciudad!";
        else
            document.getElementById("error_ciudad_name").innerHTML = "";
        if(ciudad_name!=null && ciudad_name!='')
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                }
            };
            //alert(sucursal_name);
            xmlhttp.open("GET", "datacontroller.php?dojob=3&metodo=3&id_ciudad="+id_ciudad+"&nombre_ciudad="+ciudad_name, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $("#editSala").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var sala_name = window.document.getElementById("sala_name").value;
        var id_sala = window.document.getElementById("id_sala").value;

        if(sala_name==null || sala_name=='')
            document.getElementById("error_sala_name").innerHTML = "Por favor ingresa nombre del sucursal!";
        else
            document.getElementById("error_sala_name").innerHTML = "";
        if(sala_name!=null && sala_name!='')
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                }
            };
            //alert(sucursal_name);
            xmlhttp.open("GET", "datacontroller.php?dojob=8&metodo=2&id_sala="+id_sala+"&sala_name="+sala_name, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });
    
    $("#addSala").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var sala_name = window.document.getElementById("sala_name").value;
        var ciudad_id = window.document.getElementById("ciudad_id").value;
        var sucursal_id = window.document.getElementById("sucursal_id").value;

        if(sala_name==null || sala_name=='')
            document.getElementById("error_sala_name").innerHTML = "Por favor ingresa nombre del sala!";
        else
            document.getElementById("error_sala_name").innerHTML = "";

        if(sucursal_id==0)
            document.getElementById("error_sucursal").innerHTML = "Por favor elige sucursal!";
        else
            document.getElementById("error_sucursal").innerHTML = "";

        if(sala_name!=null && sala_name!='' && sucursal_id>0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=8&metodo=0&sala_name="+sala_name+"&sucursal_id="+sucursal_id, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $("#addUser").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var checkErr=0;
        var user_name = window.document.getElementById("user_name").value;
        var user_email = window.document.getElementById("user_email").value;
        var user_tele = window.document.getElementById("user_tele").value;
        var user_celular = window.document.getElementById("user_celular").value;
        var user_direccion = window.document.getElementById("user_direccion").value;
        var perfil_id = window.document.getElementById("perfil_id").value;
        var client_id = window.document.getElementById("client_id").value;
        var ciudad_id = window.document.getElementById("ciudad_id").value;
        var sucursal_id = window.document.getElementById("sucursal_id").value;
        var sala_id = window.document.getElementById("sala_id").value;
        var supervision_id = window.document.getElementById("supervision_id").value;

        if(user_name==null || user_name=='')
        {
            document.getElementById("error_user_name").innerHTML = "Por favor ingresa nombre!";
            checkErr=1;
        }
        else
            document.getElementById("error_user_name").innerHTML = "";
        
        if(user_email==0)
        {
            document.getElementById("error_user_email").innerHTML = "Por favor ingresa correo electronico!";
            checkErr=1;
        }
        else
            document.getElementById("error_user_email").innerHTML = "";
        
        if(user_tele==null || user_tele=='')
        {
            document.getElementById("error_user_tele").innerHTML = "Por favor ingresa telefono!";
            checkErr=1;
        }
        else
            document.getElementById("error_user_tele").innerHTML = "";
        
        if(user_celular==null || user_celular=='')
        {
            document.getElementById("error_user_celular").innerHTML = "Por favor ingresa celular!";
            checkErr=1;
        }
        else
            document.getElementById("error_user_celular").innerHTML = "";
        
        if(user_direccion==null || user_direccion=='')
        {
            document.getElementById("error_user_direccion").innerHTML = "Por favor ingresa direccion!";
            checkErr=1;
        }
        else
            document.getElementById("error_user_direccion").innerHTML = "";

        if(perfil_id==99)
        {
            document.getElementById("error_perfil").innerHTML = "Por favor elige perfil!";
            checkErr=1;
        }
        else
            document.getElementById("error_perfil").innerHTML = "";

        if(client_id==99)
        {
            document.getElementById("error_cliente").innerHTML = "Por favor elige cliente!";
            checkErr=1;
        }
        else
            document.getElementById("error_cliente").innerHTML = "";

        if(ciudad_id==99)
        {
            document.getElementById("error_ciudad").innerHTML = "Por favor elige ciudad!";
            checkErr=1;
        }
        else
            document.getElementById("error_ciudad").innerHTML = "";

        if(sucursal_id==99)
        {
            document.getElementById("error_sucursal").innerHTML = "Por favor elige sucursal!";
            checkErr=1;
        }
        else
            document.getElementById("error_sucursal").innerHTML = "";

        if(sala_id==99)
        {
            document.getElementById("error_sala").innerHTML = "Por favor Elige sala!";
            checkErr=1;
        }
        else
            document.getElementById("error_sala").innerHTML = "";
        
        if(checkErr==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=9&metodo=0&supervision_id="+supervision_id+"&user_name="+user_name+"&user_email="+user_email+"&user_tele="+user_tele+"&user_celular="+user_celular+"&user_direccion="+user_direccion+"&perfil_id="+perfil_id+"&client_id="+client_id+"&ciudad_id="+ciudad_id+"&sucursal_id="+sucursal_id+"&sala_id="+sala_id, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $("#buscarUser").click(function () 
    {   
        $('#progress').show();
        var checkErr=0;
        var user_name = window.document.getElementById("user_name").value;
        var user_email = window.document.getElementById("user_email").value;
        var user_tele = window.document.getElementById("user_tele").value;
        var user_celular = window.document.getElementById("user_celular").value;
        var user_direccion = window.document.getElementById("user_direccion").value;
        var perfil_id = window.document.getElementById("perfil_id").value;
        var client_id = window.document.getElementById("client_id").value;
        var ciudad_id = window.document.getElementById("ciudad_id").value;
        var sucursal_id = window.document.getElementById("sucursal_id").value;
        var sala_id = window.document.getElementById("sala_id").value;
        if(client_id==99)
        {
            document.getElementById("error_cliente").innerHTML="Por favor elige Cliente";
            checkErr=1;
        }
        else
        {
            document.getElementById("error_cliente").innerHTML="";
        }

        if(checkErr==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    //location.reload();
                    document.getElementById("tbl_entidad").innerHTML =this.responseText;
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=9&metodo=9&user_name="+user_name+"&user_email="+user_email+"&user_tele="+user_tele+"&user_celular="+user_celular+"&user_direccion="+user_direccion+"&perfil_id="+perfil_id+"&client_id="+client_id+"&ciudad_id="+ciudad_id+"&sucursal_id="+sucursal_id+"&sala_id="+sala_id, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $("#addEquipo").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var checkErr=0;
        //var equipo_desc = window.document.getElementById("equipo_desc").value;
        var equipo_nombre = window.document.getElementById("equipo_nombre").value;
        var equipo_modelo = window.document.getElementById("equipo_modelo").value;
        var equipo_marca = window.document.getElementById("equipo_marca").value;
        var equipo_serie = window.document.getElementById("equipo_serie").value;
        var client_id = window.document.getElementById("client_id").value;
        var ciudad_id = window.document.getElementById("ciudad_id").value;
        var sucursal_id = window.document.getElementById("sucursal_id").value;
        var sala_id = window.document.getElementById("sala_id").value;

        if(equipo_nombre==null || equipo_nombre=='')
        {
            document.getElementById("error_equipo_nombre").innerHTML = "Por favor ingresa Nombre del equipo!";
            checkErr=1;
        }
        else
            document.getElementById("error_equipo_nombre").innerHTML = "";

        if(equipo_modelo==null || equipo_modelo=='')
        {
            document.getElementById("error_equipo_modelo").innerHTML = "Por favor ingresa Modelo del equipo!";
            checkErr=1;
        }
        else
            document.getElementById("error_equipo_modelo").innerHTML = "";

        if(equipo_marca==null || equipo_marca=='')
        {
            document.getElementById("error_equipo_marca").innerHTML = "Por favor ingresa Marca del equipo!";
            checkErr=1;
        }
        else
            document.getElementById("error_equipo_marca").innerHTML = "";

        if(equipo_serie==null || equipo_serie=='')
        {
            document.getElementById("error_equipo_serie").innerHTML = "Por favor ingresa Serie del equipo!";
            checkErr=1;
        }
        else
            document.getElementById("error_equipo_serie").innerHTML = "";

        if(client_id==99)
        {
            document.getElementById("error_cliente").innerHTML = "Por favor elige cliente!";
            checkErr=1;
        }
        else
            document.getElementById("error_cliente").innerHTML = "";

        if(ciudad_id==99)
        {
            document.getElementById("error_ciudad").innerHTML = "Por favor elige ciudad!";
            checkErr=1;
        }
        else
            document.getElementById("error_ciudad").innerHTML = "";

        if(sucursal_id==99)
        {
            document.getElementById("error_sucursal").innerHTML = "Por favor elige sucursal!";
            checkErr=1;
        }
        else
            document.getElementById("error_sucursal").innerHTML = "";

        if(sala_id==99)
        {
            document.getElementById("error_sala").innerHTML = "Por favor Elige sala!";
            checkErr=1;
        }
        else
            document.getElementById("error_sala").innerHTML = "";
        
        if(checkErr==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=10&metodo=0&equipo_nombre="+equipo_nombre+"&equipo_modelo="+equipo_modelo+"&equipo_marca="+equipo_marca+"&equipo_serie="+equipo_serie+"&client_id="+client_id+"&ciudad_id="+ciudad_id+"&sucursal_id="+sucursal_id+"&sala_id="+sala_id, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $("#buscarEquipo").click(function () 
    {   
        $('#progress').show();
        window.document.getElementById("id_equipos").value=0;
        var checkErr=0;
        //var equipo_desc = window.document.getElementById("equipo_desc").value;
        var equipo_nombre = window.document.getElementById("equipo_nombre").value;
        var equipo_modelo = window.document.getElementById("equipo_modelo").value;
        var equipo_marca = window.document.getElementById("equipo_marca").value;
        var equipo_serie = window.document.getElementById("equipo_serie").value;
        var client_id = window.document.getElementById("client_id").value;
        var ciudad_id = window.document.getElementById("ciudad_id").value;
        var sucursal_id = window.document.getElementById("sucursal_id").value;
        var sala_id = window.document.getElementById("sala_id").value;
        //alert(equipo_nombre);
        //alert(equipo_modelo);
        //alert(equipo_marca);
        //alert(equipo_serie);
        //alert(client_id);
        //alert(ciudad_id);
        //alert(sucursal_id);
        //alert(sala_id);
        if(checkErr==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                //alert(1);
                if (this.readyState == 4 && this.status == 200) 
                {
                    //location.reload();
                    //alert(2);
                    document.getElementById("tbl_entidad_solicitud").innerHTML =this.responseText;
                    //alert(3);
                }
                //else
                    //alert(99);
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=10&metodo=8&equipo_nombre="+equipo_nombre+"&equipo_modelo="+equipo_modelo+"&equipo_marca="+equipo_marca+"&equipo_serie="+equipo_serie+"&client_id="+client_id+"&ciudad_id="+ciudad_id+"&sucursal_id="+sucursal_id+"&sala_id="+sala_id, true);
            //alert(1);
            xmlhttp.send();
            //alert(1);
        }
        $('#progress').hide();
    });


    $("#buscarPeticion").click(function () 
    {   
        $('#progress').show();
        var checkErr=0;
        var searchPeticionId = window.document.getElementById("searchPeticionId").value;
        var estado_id = window.document.getElementById("estado_id").value;
        var service_id = window.document.getElementById("service_id").value;
        var client_id = window.document.getElementById("client_id").value;
        var ciudad_id = window.document.getElementById("ciudad_id").value;
        var sucursal_id = window.document.getElementById("sucursal_id").value;
        var sala_id = window.document.getElementById("sala_id").value;
        var tipo_cliente = window.document.getElementById("tipo_cliente").value;

        if(checkErr==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    //location.reload();
                    //alert(this.responseText);
                    document.getElementById("tbl_entidad_gestion").innerHTML =this.responseText;
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=11&metodo=9&searchPeticionId="+searchPeticionId+"&estado_id="+estado_id+"&service_id="+service_id+"&client_id="+client_id+"&ciudad_id="+ciudad_id+"&sucursal_id="+sucursal_id+"&sala_id="+sala_id+"&tipo_cliente="+tipo_cliente, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });
    
    
    $("#crearPeticion").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var checkErr=0;
        /*var equipo_desc = window.document.getElementById("equipo_desc").value;*/
        var equipo_desc='';
        var equipo_nombre = window.document.getElementById("equipo_nombre").value;
        var equipo_modelo = window.document.getElementById("equipo_modelo").value;
        var equipo_marca = window.document.getElementById("equipo_marca").value;
        var equipo_serie = window.document.getElementById("equipo_serie").value;
        var client_id = window.document.getElementById("client_id").value;
        var ciudad_id = window.document.getElementById("ciudad_id").value;
        var sucursal_id = window.document.getElementById("sucursal_id").value;
        var sala_id = window.document.getElementById("sala_id").value;
        var service_id = window.document.getElementById("service_id").value;
        var id_equipos = window.document.getElementById("id_equipos").value;
        var obser = window.document.getElementById("obser").value;
        //alert(obser);
        obser = obser.replace(/\</g," ");
        //alert(obser);

        if(service_id>1)//service other than instalacion de equipo
        {
            if(ciudad_id==99)
            {
                document.getElementById("error_ciudad").innerHTML = "Por favor elige ciudad!";
                checkErr=1;
            }
            else
                document.getElementById("error_ciudad").innerHTML = "";

            if(sucursal_id==99)
            {
                document.getElementById("error_sucursal").innerHTML = "Por favor elige sucursal!";
                checkErr=1;
            }
            else
                document.getElementById("error_sucursal").innerHTML = "";

            if(id_equipos.length<=2)
            {
                document.getElementById("error_equipos").innerHTML = "Por favor Elige equipos para servicio!";
                checkErr=1;
            }
            else
                document.getElementById("error_equipos").innerHTML = "";
        }
        else if(service_id==1)//service other than instalacion de equipo
        {
            if(ciudad_id==99)
            {
                document.getElementById("error_ciudad").innerHTML = "Por favor elige ciudad!";
                checkErr=1;
            }
            else
                document.getElementById("error_ciudad").innerHTML = "";

            if(sucursal_id==99)
            {
                document.getElementById("error_sucursal").innerHTML = "Por favor elige sucursal!";
                checkErr=1;
            }
            else
                document.getElementById("error_sucursal").innerHTML = "";
        }



        if(obser==null || obser=='')
        {
            document.getElementById("error_obser").innerHTML = "Por favor ingresa detalle de peticion!";
            checkErr=1;
        }
        document.getElementById("peticion_status").innerHTML='';
        if(checkErr==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    //location.reload();
                    //alert(this.responseText);
                    document.getElementById("peticion_status").innerHTML =this.responseText;
                    document.getElementById("obser").value='';
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=11&metodo=0&equipo_desc="+equipo_desc+"&client_id="+client_id+"&ciudad_id="+ciudad_id+"&sucursal_id="+sucursal_id+"&sala_id="+sala_id+"&service_id="+service_id+"&id_equipos="+id_equipos+"&obser="+obser, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $("#actPeticion").click(function () 
    {   
        
        $('#progress').show();
        var checkErr=0;
        var peticion_id = window.document.getElementById("peticion_id").value;
        //alert(peticion_id);
        var equipo_id = window.document.getElementById("equipo_id").value;
        var estado_id = window.document.getElementById("estado_id").value;
        var obser = window.document.getElementById("obser").value;
        //alert(peticion_id);
        //alert(equipo_id);
        //alert(estado_id);
        //alert(obser);
        if(obser==null || obser=='')
        {
            document.getElementById("error_obser").innerHTML = "Por favor ingresa detalle de peticion!";
            checkErr=1;
        }
        if(checkErr==0 && equipo_id==99)
        {
            if(confirm("Desea actualizar observacion para todos los equipos de este peticion?"))
                checkErr=0;
            else
                checkErr=1;
            //alert(ret);
        }
            
        //alert(checkErr);
        if(checkErr==0)
        {

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    
                    //alert(this.responseText);
                    location.reload();
                    //document.getElementById("tbl_entidad_gestion").innerHTML =this.responseText;
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=12&metodo=0&peticion_id="+peticion_id+"&equipo_id="+equipo_id+"&estado_id="+estado_id+"&obser="+obser, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });


    $("#asignarTecnicoParaSucursal").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var checkErr=0;
        var tecnico_id = window.document.getElementById("tecnico_id").value;
        var id_equipos = window.document.getElementById("id_equipos").value;

        if(tecnico_id==99)
        {
            document.getElementById("error_tecnico").innerHTML = "Por favor elige tecnico a asignar!";
            checkErr=1;
        }
        else
            document.getElementById("error_tecnico").innerHTML = "";

        if(id_equipos.length<=2)
        {
            document.getElementById("error_equipos").innerHTML = "Por favor Elige sucursales para asignar!";
            checkErr=1;
        }
        else
            document.getElementById("error_equipos").innerHTML = "";
        

        if(checkErr==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                    //document.getElementById("asignacion_status").innerHTML =this.responseText;
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=9&metodo=2&tecnico_id="+tecnico_id+"&id_equipos="+id_equipos, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $("#asignarTecnicoParaPeticion").click(function () 
    {   
        var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        var checkErr=0;
        var tecnico_id = window.document.getElementById("tecnico_id").value;
        var id_equipos = window.document.getElementById("id_equipos").value;

        if(tecnico_id==99)
        {
            document.getElementById("error_tecnico").innerHTML = "Por favor elige tecnico a asignar!";
            checkErr=1;
        }
        else
            document.getElementById("error_tecnico").innerHTML = "";

        if(id_equipos.length<=2)
        {
            document.getElementById("error_equipos").innerHTML = "Por favor Elige Peticiones para asignar!";
            checkErr=1;
        }
        else
            document.getElementById("error_equipos").innerHTML = "";
        

        if(checkErr==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                    //document.getElementById("asignacion_status").innerHTML =this.responseText;
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=9&metodo=3&tecnico_id="+tecnico_id+"&id_equipos="+id_equipos, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
    });

    $('#progress').hide();

    

});

function delEntidad(id,desc)
{
    var xmlhttp = new XMLHttpRequest();
    $('#progress').show();
    if(confirm('Estas seguro de eliminar el entidad : '+desc))
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

        xmlhttp.open("GET", "datacontroller.php?dojob=1&metodo=1&id_entidad="+id, true);
        xmlhttp.send();
    }
    $('#progress').hide();
}

function delPerfil(id,desc)
{
    //alert(id);
    //alert(desc.replace("+"," "));
    var xmlhttp = new XMLHttpRequest();
    $('#progress').show();
    if(confirm('Estas seguro de eliminar el perfil : '+desc.replace("+"," ")))
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

        xmlhttp.open("GET", "datacontroller.php?dojob=2&metodo=1&id_perfil="+id, true);
        xmlhttp.send();
    }
    $('#progress').hide();
}



function habilitarEditPerfil(id,desc,padre_id)
{
    $('#addPerfil').hide("slow");
    //$('#perfilPadrePanel').hide("slow");
    $('#editPerfilPanel').show("slow");
    document.getElementById("perfil_name").value=desc.replace(/\+/g," ");
    document.getElementById("id_perfil").value=id;
    var x= document.getElementById("idPerfilPadre");
    var i;
    for (i = 0; i < x.length; i++) 
    {
        if(x.options[i].value==padre_id)
            x.selectedIndex=i;
    }

}

function habilitarEditCiudad(id,desc)
{
    $('#addCiudad').hide("slow");
    //$('#sucursalPanel').hide("slow");
    $('#editCiudadPanel').show("slow");
    document.getElementById("ciudad_name").value=desc.replace(/\+/g," ");
    document.getElementById("id_ciudad").value=id;

}

function habilitarEditSucursal(id,desc)
{
    $('#addSucursal').hide("slow");
    $('#sucursalPanel').hide("slow");
    $('#editSucursalPanel').show("slow");
    document.getElementById("sucursal_name").value=desc.replace(/\+/g," ");
    document.getElementById("id_sucursal").value=id;

}

function habilitarEditSala(id,desc)
{
    $('#addSala').hide("slow");
    $('#salaPanel').hide("slow");
    $('#editSalaPanel').show("slow");
    document.getElementById("sala_name").value=desc.replace(/\+/g," ");
    document.getElementById("id_sala").value=id;

}


function habilitarEditCliente(id,desc,admin_name,admin_id,telefono,celular,email,ciudad)
{
    //alert(ciudad);
    $('#addCliente').hide("slow");
    //$('#perfilPadrePanel').hide("slow");
    $('#editClientePanel').show("slow");
    document.getElementById("client_name").value=desc.replace(/\+/g," ");
    document.getElementById("client_admin").value=admin_name.replace(/\+/g," ");
    document.getElementById("admin_id").value=admin_id.replace(/\+/g," ");
    document.getElementById("client_telefono").value=telefono.replace(/\+/g," ");
    document.getElementById("client_celular").value=celular.replace(/\+/g," ");
    document.getElementById("client_email").value=email.replace(/\+/g,"@");
    document.getElementById("id_cliente").value=id;
    var x = document.getElementById("ciudad_cliente");
    //alert(x.length);
    var i;
    for (i = 0; i < x.length; i++) 
    {
        if(x.options[i].value==ciudad)
            x.selectedIndex=i;
    }

}


function habilitarEditUser(id,nombre,email,telefono,celular,direccion,perfil,cliente,ciudad,sucursal,sala,supervision)
{
    //alert(1);
    $('#addUser').hide("slow");
    $('#buscarUser').hide("slow");
    
    //$('#perfilPadrePanel').hide("slow");
    $('#editUserPanel').show("slow");
    document.getElementById("user_id").value=id;
    document.getElementById("user_name").value=nombre.replace(/\+/g," ");
    document.getElementById("user_email").value=email;
    document.getElementById("user_tele").value=telefono.replace(/\+/g," ");
    document.getElementById("user_celular").value=celular.replace(/\+/g," ");
    document.getElementById("user_direccion").value=direccion.replace(/\+/g," ");
    
    var x1 = document.getElementById("perfil_id");
    //alert(x.length);
    var i1;
    for (i1 = 0; i1 < x1.length; i1++) 
    {
        if(x1.options[i1].value==perfil)
            x1.selectedIndex=i1;
    }

    /*var x2 = document.getElementById("client_id");
    //alert(x.length);
    var i2;
    for (i2 = 0; i2 < x2.length; i2++) 
    {
        if(x2.options[i2].value==cliente)
            x2.selectedIndex=i2;
    }

    var x3 = document.getElementById("ciudad_id");
    //alert(x.length);
    var i3;
    for (i3 = 0; i3 < x3.length; i3++) 
    {
        if(x3.options[i3].value==ciudad)
            x3.selectedIndex=i3;
    }

    var x4 = document.getElementById("sucursal_id");
    //alert(x.length);
    var i4;
    for (i4 = 0; i4 < x4.length; i4++) 
    {
        if(x4.options[i4].value==sucursal)
            x4.selectedIndex=i4;
    }

    var x5 = document.getElementById("sala_id");
    //alert(x.length);
    var i5;
    for (i5 = 0; i5 < x5.length; i5++) 
    {
        if(x5.options[i5].value==sala)
            x5.selectedIndex=i1;
    }*/

    var x6 = document.getElementById("supervision_id");
    //alert(x.length);
    var i6;
    for (i6 = 0; i6 < x6.length; i6++) 
    {
        if(x6.options[i6].value==supervision)
            x6.selectedIndex=i6;
    }

}

function habilitarEditMenu(id,sec, tipo, nombre_menu, url_path)
{
    //alert(id);
    $('#addMenu').hide("slow");
    //$('#perfilPadrePanel').hide("slow");
    $('#editMenuPanel').show("slow");
    document.getElementById("menu_sec").value=sec;
    document.getElementById("old_menu_sec").value=sec;
    document.getElementById("menu_nombre").value=nombre_menu.replace(/\+/g," ");
    document.getElementById("menu_url").value=url_path.replace(/\+/g," ");
    document.getElementById("id_menu").value=id;
    var x = document.getElementById("menu_tipo");
    var i;
    for (i = 0; i < x.length; i++) 
    {
        if(x.options[i].value==tipo)
            x.selectedIndex=i;
    }

}

function delCiudad(id,desc)
{
    var xmlhttp = new XMLHttpRequest();
    $('#progress').show();
    if(confirm('Estas seguro de eliminar el ciudad : '+desc.replace(/\+/g," ")))
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

        xmlhttp.open("GET", "datacontroller.php?dojob=3&metodo=1&id_ciudad="+id, true);
        xmlhttp.send();
    }
    $('#progress').hide();
}
function delCliente(id,desc)
{
    var xmlhttp = new XMLHttpRequest();
    $('#progress').show();
    if(confirm('Estas seguro de eliminar el cliente : '+desc.replace(/\+/g," ")))
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                location.reload();
            }
        };

        xmlhttp.open("GET", "datacontroller.php?dojob=4&metodo=1&id_cliente="+id, true);
        xmlhttp.send();
    }
    $('#progress').hide();
}


function delMenu(id,desc,mensaje)
{
    var xmlhttp = new XMLHttpRequest();
    $('#progress').show();
    if(confirm('Estas seguro de '+mensaje+' el menu : '+desc.replace(/\+/g," ")))
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                location.reload();
            }
        };

        xmlhttp.open("GET", "datacontroller.php?dojob=5&metodo=1&id_menu="+id, true);
        xmlhttp.send();
    }
    $('#progress').hide();
}

function getPermisos()
{
    var id= document.getElementById("menu_id").value;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    $('#progress').show();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            document.getElementById("tbl_entidad").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "datacontroller.php?dojob=6&metodo=0&id_menu="+id, true);
    xmlhttp.send();
    $('#progress').hide();
}

function delPermisos(menu_id,perfil)
{
    var xmlhttp = new XMLHttpRequest();
        $('#progress').show();
        
        var err=0;
        if(menu_id==99)
        {
            err=1;
            document.getElementById("error_menu_id").innerHTML = "Por favor elige un menu!";
        }
        else
            document.getElementById("error_menu_id").innerHTML = "";

        if(perfil==99)
        {
            err=1;
            document.getElementById("error_perfil").innerHTML = "Por favor elige perfil!";
        }
        else
            document.getElementById("error_perfil").innerHTML = "";

        
        if(err==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                //alert('1');
                if (this.readyState == 4 && this.status == 200) 
                {
                    //alert(this.responseText);
                    location.reload();
                    //document.getElementById("tbl_entidad").innerHTML =this.responseText;
                }
                //alert('3');
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=6&metodo=2&menu_id="+menu_id+"&perfil_id="+perfil, true);
            //alert(destino);
            xmlhttp.send();
        }
        $('#progress').hide();
}

function getCiudad()
{
    document.getElementById("tbl_entidad_gestion").innerHTML="";
    var id_client= document.getElementById("client_id").value;
    //alert(id_client);
    var xmlhttp = new XMLHttpRequest();
    $('#progress').show();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //alert(this.responseText);
            document.getElementById("ciudad_id").innerHTML = this.responseText;  
            document.getElementById("sucursal_id").innerHTML="<option value=99>TODOS</option>";
            document.getElementById("sala_id").innerHTML="<option value=99>Elige CIUDAD</option>";
        }
    };

    xmlhttp.open("GET", "datacontroller.php?dojob=3&metodo=2&id_client="+id_client, true);
    xmlhttp.send();
    $('#progress').hide();
}

function getSucursales()
{
    document.getElementById("tbl_entidad_solicitud").innerHTML="";
    var ciudad_id= document.getElementById("ciudad_id").value;
    //alert(ciudad_id);
    var xmlhttp = new XMLHttpRequest();
    $('#progress').show();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //alert(this.responseText);
            document.getElementById("sucursal_id").innerHTML = this.responseText;
            document.getElementById("sala_id").innerHTML="<option value=99>Elige CIUDAD</option>";
        }
    };

    xmlhttp.open("GET", "datacontroller.php?dojob=7&metodo=3&ciudad_id="+ciudad_id, true);
    xmlhttp.send();
    $('#progress').hide();
}

function delSucursal(id,desc)
{
    //alert(id);
    //alert(desc.replace("+"," "));
    $('#progress').show();
    if(confirm('Estas seguro de eliminar el sucursal : '+desc.replace("+"," ")))
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

        xmlhttp.open("GET", "datacontroller.php?dojob=7&metodo=1&id_sucursal="+id, true);
        xmlhttp.send();
    }
    $('#progress').hide();
}


function getSalas()
{
    document.getElementById("tbl_entidad_solicitud").innerHTML="";
    var sucursal_id= document.getElementById("sucursal_id").value;
    //alert(ciudad_id);
    var xmlhttp = new XMLHttpRequest();
    $('#progress').show();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //alert(this.responseText);
            document.getElementById("sala_id").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "datacontroller.php?dojob=8&metodo=3&sucursal_id="+sucursal_id, true);
    xmlhttp.send();
    $('#progress').hide();
}

function getSucursalesParaAsignarTecnico()
{
    var ciudad_id= document.getElementById("ciudad_id").value;
    var sucursal_id= document.getElementById("sucursal_id").value;
    var sala_id= document.getElementById("sala_id").value;
    //alert(ciudad_id);
    var xmlhttp = new XMLHttpRequest();
    $('#progress').show();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //alert(this.responseText);
            document.getElementById("tecnico_id").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "datacontroller.php?dojob=9&metodo=1&ciudad_id="+ciudad_id+"&sucursal_id="+sucursal_id+"&sala_id="+sala_id, true);
    xmlhttp.send();
    $('#progress').hide();
}

function getSalasParaAsignarTecnico()
{
    var ciudad_id= document.getElementById("ciudad_id").value;
    var sucursal_id= document.getElementById("sucursal_id").value;
    var sala_id= document.getElementById("sala_id").value;
    //alert(ciudad_id);
    var xmlhttp = new XMLHttpRequest();
    $('#progress').show();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //alert(this.responseText);
            document.getElementById("tecnico_id").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "datacontroller.php?dojob=9&metodo=1&ciudad_id="+ciudad_id+"&sucursal_id="+sucursal_id+"&sala_id="+sala_id, true);
    xmlhttp.send();
    $('#progress').hide();
}


function getUsersParaAsignarTecnico()
{
    var ciudad_id= document.getElementById("ciudad_id").value;
    var sucursal_id= document.getElementById("sucursal_id").value;
    var sala_id= document.getElementById("sala_id").value;
    //alert(ciudad_id);
    //alert(sucursal_id);
    //alert(sala_id);
    var xmlhttp = new XMLHttpRequest();
    $('#progress').show();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //alert(this.responseText);
            document.getElementById("tecnico_id").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "datacontroller.php?dojob=9&metodo=1&ciudad_id="+ciudad_id+"&sucursal_id="+sucursal_id+"&sala_id="+sala_id, true);
    xmlhttp.send();
    $('#progress').hide();
}

function delSala(id,desc)
{
    //alert(id);
    //alert(desc.replace("+"," "));
    $('#progress').show();
    if(confirm('Estas seguro de eliminar el sala : '+desc.replace("+"," ")))
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

        xmlhttp.open("GET", "datacontroller.php?dojob=8&metodo=1&id_sala="+id, true);
        xmlhttp.send();
    }
    $('#progress').hide();
}

function disableUser(id,desc)
{
    //alert(id);
    //alert(desc.replace("+"," "));
    $('#progress').show();
    if(confirm('Estas seguro de deshabilitar/habilitar el usuario : '+desc.replace("+"," ")))
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

        xmlhttp.open("GET", "datacontroller.php?dojob=9&metodo=5&user_id="+id, true);
        xmlhttp.send();
    }
    $('#progress').hide();
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


function countTextSize()
{
    var text = document.getElementById("obser").value;
    //var ctr=parseInt(text.length)+1;
    var ctr=text.length+1;
    document.getElementById("text_size").innerHTML="Caracteres ingresado:"+ctr;
}


function handleEquipoList()
{
    if(document.getElementById("service_id").value==1)
        $("#tbl_entidad_solicitud").hide();
    else
        $("#tbl_entidad_solicitud").show();
}