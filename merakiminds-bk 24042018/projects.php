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
        <img src="images/projects2.png" style="width:100%; height:500px;"> 
        <div class="caption" style="top:70%">
            <!-- <div class="sliderContent">
                <img src="images/slider/responsive.png">
            </div> -->
            <div class="sliderContent">
                <span style="font-size:25px;letter-spacing:.5em;float:left">NUESTRO CLIENTES</span><br><hr><span style="font-size:25px;letter-spacing:.5em;float:right">NUESTRO TRABAJOS</span><br><br>
                <!-- <span style="font-size:14px;letter-spacing:.5em;">Jóvenes profesionales | Equipo dedicado</span> -->
                <!-- <h2>HTML5 , CSS3, PHP , AJAX , JOOMLA, WORDPRESS</h2> -->
                <!-- <h3 style="color:#76913c;">Read More</h3> -->
            </div>
            <!-- <h1>Marriage</h1>
            <h2>Know More</h2> -->
        </div>       
    </div>    
</div>


<div class="container" style="width:80%;margin:auto;"> 
    <div class="row" style="padding-top:50px;">
        <div class="col-sm-6">
            <div class="flip">                
                <a href="http://www.sistececuador.com"><img src="images/projects/sistececuador.png" class="flipImg2" style="border:2px solid #5096ca"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">SISTEC (NIPRO)</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="flip">                
                <a href="http://www.nexosafe.com"><img src="images/projects/nexosafe.png" class="flipImg2"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">NEXOSAFE</span>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top:50px;">
        <div class="col-sm-6">
            <div class="flip">                
                <a href="http://www.bushidoecuador.com"><img src="images/projects/bushidoecuador.png" class="flipImg2"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">BUSHIDOAPP (NIPRO)</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="flip">                
                <a href="#"><img src="images/projects/vectios.png" class="flipImg2"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">VECTIOS</span>
            </div>
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
