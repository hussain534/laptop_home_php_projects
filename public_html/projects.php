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
                <span style="font-size:25px;letter-spacing:.5em;float:left">NUESTRO CLIENTES</span><span style="font-size:25px;letter-spacing:.5em;float:right">NUESTRO TRABAJOS</span><br><br>
                <!-- <span style="font-size:14px;letter-spacing:.5em;">Jóvenes profesionales | Equipo dedicado</span> -->
                <!-- <h2>HTML5 , CSS3, PHP , AJAX , JOOMLA, WORDPRESS</h2> -->
                <!-- <h3 style="color:#76913c;">Read More</h3> -->
            </div>
            <!-- <h1>Marriage</h1>
            <h2>Know More</h2> -->
        </div>       
    </div>    
</div>


<div class="container" style="width:100%;margin:0px 0px -15px 0px;"> 
    <div class="row" style="padding-top:50px;">
        <div class="col-sm-3">
            <div class="flip">                
                <a href="http://www.sistececuador.com"><img src="images/projects/sistececuador.png" class="flipImg" style="border:2px solid #5096ca"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">SISTEC (NIPRO)</span>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="flip">                
                <a href="http://www.nexosafe.com"><img src="images/projects/nexosafe.png" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">NEXOSAFE</span>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="flip">                
                <a href="http://www.bushidoecuador.com"><img src="images/projects/bushidoecuador.png" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">BUSHIDOAPP (NIPRO)</span>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="flip">                
                <a href="#"><img src="images/projects/vectios.png" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">VECTIOS</span>
            </div>
        </div>
    </div>
</div>
<br>
<div class="footer" style="background-image: url('images/back_short.jpg');">
    <div class="footerSection">
        <p class="footerHeading">Sitemap</p>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="aboutus.php">Nosotros</a></li>
            <li><a href="/services">Servicios</a></li>
            <li><a href="/contact-us">Cont&aacute;ctanos</a></li>
        </ul>
    </div>
    <div class="footerSection">
        <p class="footerHeading">Servicios</p>
        <ul>
            <li><a href="#">Consultoria</a></li>
            <li><a href="#">Desarrollo de aplication</a></li>
            <li><a href="#">Mantenimiento de aplicaciones</a></li>
            <li><a href="#">Integracion de aplicaciones</a></li>
            <li><a href="#">Gestion de infraestructura</a></li>
        </ul>
    </div>
    <div class="footerSection">
        <p class="footerHeading" style="padding: 8px;">Redes Sociales</p>
        <a href="https://www.facebook.com/merakimindsecuador"><img src="images/facebook.png" alt="MerakiMinds Facebook icon" /></a>
        <a href="https://twitter.com/merakimindsecu"><img src="images/twitter.png" alt="MerakiMinds Twitter icon" /></a>
        <a href="https://plus.google.com/u/0/102296232721366504626"><img src="images/googleplus.png" alt="MerakiMinds GooglePlus icon" /></a>
        <a href="https://ec.linkedin.com/in/merakiminds"><img src="images/linkedIn.png" alt="MerakiMinds LinkedIn icon" /></a>
    </div>
    <div class="footerSection">
        <p class="footerHeading">Cont&aacute;ctanos</p>
        <ul>
            <li><a href="#">Correo : info@merakiminds.com</a></li>
            <!-- <li><a href="#">Skype : info_merakiminds</a></li>
            <li><a href="#">Celular : (593) 987207723</a></li>
            <li><a href="#">Fijo : (593) 2 2500970</a></li> -->
        </ul>
    </div>
    <br /> <br /> <br /> <br />
    <div class="footerLinkSection">
        <ul>
            <li><a href="#">Sitemap</a></li>
            <li><a href="#">T&eacute;rminos de Uso</a></li>
            <li><a href="#">Pol&iacute;tica de Cookies</a></li>
        </ul>
    </div>
    <div class="footerCopyrightSection">MERAKI MINDS CIA LTDA &copy; 2015. Todos los derechos reservados.</div>
</div>
<!-- <div class="contact">
    <p class="contact_me">All rights reserved with MERAKI MINDS CIA LTDA &copy 2015.</p>
</div> -->

</body>
</html>
