<?php
    defined('_JEXEC') or ('Access Deny');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MERAKI MINDS</title>
    <!-- <link href='https://fonts.googleapis.com/css?family=Lobster|Cabin|Noto+Serif|Shadows+Into+Light|Pacifico|Alegreya' rel='stylesheet' type='text/css'> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/google-api-jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">    
    <script type="text/javascript" src="js/jquery-2.1.3.min.js" ></script>
    <script type="text/javascript" src="js/cycle2.js" ></script>

    
    <script>
        $(document).ready(function(){
            $("#wrappermobile").hide();
            $("#show").click(function(){
                
                $("#wrappermobile").toggle(1000);

            });
        });
    </script>
    <style>
    .input-group-addon 
    {
        padding: 0px 12px !important;
        height: 25px !important;
        font-size: 12px;
        background-color: #1db320;
        color: beige;
        width: 200px !important;
        text-align: left;
    }
    .input-group
    {
        margin: 2px;
        width: 100%;
    }
    </style>
</head>
<body>
<?php
    include_once('header.php');
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;
    require 'dbcontroller.php';
    $controller = new controller();
    $msg='';
    if(isset($_POST['submitted']))
    {
        /*$updateStatus = $controller->registerPerfilData($databasecon,$_POST['user_name'],$_POST['user_email'],$_POST['user_contact'],$_POST['user_perfil'],$_POST['skills'],$DEBUG_STATUS);*/
        $updateStatus = $controller->registerPerfilDataSmallPanel($databasecon,$_POST['user_name'],$_POST['user_email'],$_POST['user_contact'],$_POST['user_perfil'],$_POST['skills'],$DEBUG_STATUS);
        //$updateStatus = 123;
        if($updateStatus>0)
        {
            $accountConfirmationData = $controller->getUserAccountConfirmationStr($databasecon,$_POST['user_email'],$DEBUG_STATUS);
            $to = $_POST['user_email'];
            $subject = 'REGISTRO DE PERFIL '.strtoupper($_POST['user_perfil']);
            $txt = 'Estimado/a'.$_POST['user_name']."!\n\n\n";
            $txt=$txt.'Su perfil registrado correctamente en portal de MERAKIMINDS.'."!\n\n\n";
            $txt=$txt.'Puedes ingresar en portal usando siguiente credenciales:'."!\n\n\n";
            $txt=$txt.'Email/Usuario: '.$_POST['user_email']."\n\n\n";
            $txt=$txt.'Clave: '.$updateStatus."\n\n\n";
            $txt=$txt.'Haz click para confirmar su email: http://localhost/merakiminds/action.php?action=1&id='.$accountConfirmationData[0][0].'&token='.$accountConfirmationData[0][1]."\n\n\n";
            $txt=$txt.'NOTA: Por favor mantener su perfil actualizado para recibir informacion de proyectos segun su conocimiento'."\n\n\n";        
            $txt=$txt.'Gracias para mostrar interes en trabajar con MERAKIMINDS.'."!\n\n\n";
            echo $txt;
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
            $headers = 'From: PORTAL MERAKIMINDS <info@merakiminds.com>';

            $res=mail($to,$subject,$txt,$headers);
            if($res==true)
            {
                $msg=$msg.'<h5 style="color:green">SU PERFIL REGISTRADO EN NUESTRO PORTAL CORRECTAMENTE.<br>SU CREDENCIALES FUE ENVIADO SU EMAIL REGISTRADO</h5>';
            }
            else
            {
                $msg=$msg.'<h5 style="color:blue">SU PERFIL REGISTRADO EN NUESTRO PORTAL CORRECTAMENTE.<br>PUEDES INTENTAR CON SIGUIENTE CREDENCIALES PARA INGRESAR EN NUESTRO PORTAL.</h5>';
                $msg=$msg.'<h6 style="color:blue">Email/Usuario: '.$_POST['user_email'].'</h6>';
                $msg=$msg.'<h6 style="color:blue">Clave: '.$updateStatus.'</h6>';
            }
        }
        else if($updateStatus==-1)
        {
            $msg=$msg.'<h5 style="color:red">EMAIL ENCUENTRA REGISTRADO EN SYSTEMA DE MERAKIMINDS.</h5>';
        }
        else
        {
            $msg=$msg.'<h5 style="color:red">ERROR REGISTRAR SU PERFIL EN NUESTRO PORTAL. INTENTA NUEVAMENTE</h5>';

        }
        $_POST['submitted']=null;
    }
    $perfiles = $controller->getPerfils($databasecon,$DEBUG_STATUS);
    //$primaryskills = $controller->getPrimarySkills($databasecon,$DEBUG_STATUS);
?>

<!-- <div class="cycle-slideshow" 
    data-cycle-slides=".slide"        
    data-cycle-fx="flipHorz" 
    data-cycle-timeout="5000">
    <div class="slide" data-cycle-fx="flipHorz">
        <img src="images/join_us.jpg" style="width:100%; height:600px;"> 
        <div class="caption" style="top:30%;">
            <div class="sliderContent">
                <span style="font-size:30px;letter-spacing:.5em;">¿QUIERES TRABAJAR CON NOSOTROS?</span>
            </div>
        </div>       
    </div>    
</div>
<br>
<br>
<br> -->
<div class="container cont" id="container06">
    <div class="row" > 
        <div class="col-sm-5">
            <br>
            <br>
            <br>
            <br>
            <img src="images/work_with_us_areas.png" style="width:100%;">
        </div>
        <div class="col-sm-7 text-center">
            <form method="post">
                <input type="hidden" name="submitted" value="true" />                        
                
                <h3>REGISTRAR AHORA</h3>
                <br>
                <?php
                    if(isset($msg))
                        echo $msg;
                ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon">NOMBRE</span>
                            <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Ingresar nombre">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon">EMAIL</span>
                            <input type="text" id="user_email" name="user_email" class="form-control" placeholder="Ingresar email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon">NRO. CONTACTO</span>
                            <input type="text" id="user_contact" name="user_contact" class="form-control" placeholder="Ingresar su nro contacto">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon">PERFIL</span>
                            <select class="form-control" id="user_perfil" name="user_perfil">
                                <?php
                                    for($x=0;$x<count($perfiles);$x++)
                                    {
                                ?>
                                <option value="<?php echo $perfiles[$x][0];?>"><?php echo $perfiles[$x][1];?></option>
                                <?php
                                    }
                                ?>
                              </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group" style="height:36px;">
                            <!-- <span class="input-group-addon">SKILLS (marcar solo y cuando si tiene conocimiento a nivel 6 o mas entre 1 a 10)</span> -->
                            <span class="input-group-addon">CONOCIMIENTO DE TECHNOLOGÍA (5000 caracteres)</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group" style="height:36px;">
                            <!-- <span class="input-group-addon">SKILLS (marcar solo y cuando si tiene conocimiento a nivel 6 o mas entre 1 a 10)</span> -->
                            <textarea class="form-control" name="skills" id="skills" value="" rows="8" placeholder="Ingresa su conocimiento de tecnologias (Separado con ;. Por ejemplo Java; .Net; IBM Message Broker; Oracle; etc)" maxlength=1500 required></textarea> 
                        </div>
                    </div>
                </div>
                <!-- <input type="hidden" id="skills" name="skills" value="0" size="500">
                <div class="row">
                    <div class="col-sm-12">
                            <?php
                                for($p=0;$p<count($primaryskills);$p++)
                                {
                                    
                                    echo '<p class="text-left primary_skill">'.$primaryskills[$p][1].'</p>';
                                    $secondaryskills = $controller->getSecondarySkills($databasecon,$primaryskills[$p][0],$DEBUG_STATUS);
                                    if(count($secondaryskills)>0)
                                    {
                                        for($s=0;$s<count($secondaryskills);$s++)
                                        {
                                            echo '<div class="checkbox text-left"><label><input type="checkbox" onchange=addToSkillList("'.$secondaryskills[$s][0].'")>'.$secondaryskills[$s][1].'</label></div>';
                                        }
                                    }
                                    else
                                    {
                                        echo '<div class="checkbox text-left" style="font-size:12px;font-style:italic">NO HAY SKILLS EN ESTE CATEGORIA</div>';
                                    }
                                    echo '<br>';
                                }
                            ?>
                    </div>
                </div>
                <br> -->


                <button type="submit" class="btn btn-success"  style="margin:5px" onclick="return validateEmail();">ENVIAR</button>
            </form> 
        </div>
    </div>
</div>
<br>
<br>
<br>
<script>
  function validateEmail() 
    {
        //alert("HI");
        var x = document.getElementById("user_email").value;
        var atpos = x.indexOf("@");
        var dotpos = x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
            alert("ERROR FORMATO EMAIL");
            return false;
        }
        else
            return true;
    }

    function addToSkillList(id)
    {
        var myList = document.getElementById("skills").value.split(",");
        var newList="";
        var ctr=0;
        //alert(myList);
        
        //alert(myList.length);
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
            document.getElementById("skills").value=newList+","+id;
        else
            document.getElementById("skills").value=newList;
    }
</script>



<?php
    include_once('footer.php');
?>
<!-- <div class="contact">
    <p class="contact_me">All rights reserved with MERAKI MINDS CIA LTDA &copy 2015.</p>
</div> -->

</body>
</html>
