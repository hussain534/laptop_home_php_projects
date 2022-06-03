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
</head>
<body>
<?php
    include_once('header.php');
?>

<div class="cycle-slideshow" 
    data-cycle-slides=".slide"        
    data-cycle-fx="flipHorz" 
    data-cycle-timeout="5000">
    
    

    <div class="slide" data-cycle-fx="flipHorz">
        <img src="images/contact-us.png" style="width:100%; height:600px;">        
    </div>    
</div>
<br>
<br>
<br>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
<?php
    //session_start();
    if(isset($_POST['submitted']))
    {
        $to = 'hussain.mm.2006@gmail.com';
        $subject = 'NUEVO MENSAJE ENVIADO POR '.strtoupper($_POST['contact_user']);
        $txt = 'Ha recibido un nueve mensaje'."!\n\n\n";
        $txt=$txt.'Email Cliente: '.$_POST['contact_email']."\n\n\n";
        $txt=$txt.'Mensaje: '.$_POST['contact_msg']."\n\n\n";        
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
        $headers = 'From: PORTAL MERAKIMINDS <info@merakiminds.com>';

        $res=mail($to,$subject,$txt,$headers);
        if($res==true)
        {
            echo '<h4 style="color:green">SU MENSAJE FUE ENVIADO CORRECTAMENTE</h4>';
        }
        else
        {
            echo '<h4 style="color:red">ERROR ENVIAR SU MENSAJE.INTENTA NUEVAMENTE</h4>';

        }

        //$url='http://nexosafe.com/#container06';
        //header("Location:$url");
    }
?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <!-- <a href="http://localhost/merakiminds/contact.php"><button type="submit" class="btn btn-default"  style="margin:5px" onclick="return validateEmail();">REGRESAR</button></a>             -->
            <a href="https://merakiminds.com/contact.php"><button type="submit" class="btn btn-default"  style="margin:5px" onclick="return validateEmail();">REGRESAR</button></a>            
        </div>
    </div>
</div>



<?php
    include_once('footer.php');
?>
<!-- <div class="contact">
    <p class="contact_me">All rights reserved with MERAKI MINDS CIA LTDA &copy 2015.</p>
</div> -->

</body>
</html>
