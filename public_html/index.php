<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MERAKIMINDS</title>
    <!-- <link href='https://fonts.googleapis.com/css?family=Lobster|Cabin|Noto+Serif|Shadows+Into+Light|Pacifico|Alegreya' rel='stylesheet' type='text/css'> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/google-api-jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">    
    <script type="text/javascript" src="js/jquery-2.1.3.min.js" ></script>
    <script type="text/javascript" src="js/cycle2.js" ></script>


  	<jdoc:include type="head"/>
    
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
    data-cycle-timeout="3000">
    <span class="cycle-next">&#9002;</span> 
    <span class="cycle-prev">&#9001;</span>
    
    
    <div class="slide" data-cycle-fx="flipHorz">
        <img src="images/meeting.jpg" style="width:100%; height:500px;"> 
        <div class="caption" style="top:70%;">
            <!-- <div class="sliderContent">
                <img src="images/slider/responsive.png">
            </div> -->
            <div class="sliderContent">
                <span style="font-size:30px;letter-spacing:.5em;">SERVICIOS DE CONSULTORIAS</span><br><br>
                <span style="font-size:14px;letter-spacing:.5em;">PONTE EN COMPETICION</span>
                <!-- <h2>HTML5 , CSS3, PHP , AJAX , JOOMLA, WORDPRESS</h2> -->
                <!-- <h3 style="color:#76913c;">Read More</h3> -->
            </div>
            <!-- <h1>Marriage</h1>
            <h2>Know More</h2> -->
        </div>       
    </div>
    <div class="slide" data-cycle-fx="flipHorz">
        <img src="images/softwareDeveloment.jpg" style="width:100%; height:500px;"> 
        <div class="caption" style="top:70%;">
            <!-- <div class="sliderContent">
                <img src="images/slider/responsive.png">
            </div> -->
            <div class="sliderContent">
                <span style="font-size:30px;letter-spacing:.5em;">DESARROLLO DE APLICACIONES</span><br><br>
                <span style="font-size:14px;letter-spacing:.5em;">UTILIZA LA TECNOLOGIA DEL ULTIMO GENERACION</span>
                <!-- <h2>HTML5 , CSS3, PHP , AJAX , JOOMLA, WORDPRESS</h2> -->
                <!-- <h3 style="color:#76913c;">Read More</h3> -->
            </div>
            <!-- <h1>Marriage</h1>
            <h2>Know More</h2> -->
        </div>       
    </div>
    <div class="slide" data-cycle-fx="flipHorz">
        <img src="images/infrastructure.jpg" style="width:100%; height:500px;"> 
        <div class="caption" style="top:70%;">
            <!-- <div class="sliderContent">
                <img src="images/slider/responsive.png">
            </div> -->
            <div class="sliderContent">
                <span style="font-size:30px;letter-spacing:.5em;">INFRAESTRUCTURA</span><br><br>
                <span style="font-size:14px;letter-spacing:.5em;">INYECTAR PODER PARA ESTAR SIEMPRE EN SERVICIO</span>
                <!-- <h2>HTML5 , CSS3, PHP , AJAX , JOOMLA, WORDPRESS</h2> -->
                <!-- <h3 style="color:#76913c;">Read More</h3> -->
            </div>
            <!-- <h1>Marriage</h1>
            <h2>Know More</h2> -->
        </div>       
    </div>
    <!-- <div class="slide" data-cycle-fx="flipHorz">
        <img src="images/11.jpg" style="width:100%; height:500px;">        
    </div>
    <div class="slide" data-cycle-fx="flipHorz">
        <img src="images/Prog-languages.png" style="width:100%; height:500px;">        
    </div> -->
</div>
<div class="container" style="width:100%;margin:0px 0px 6px 0px;">      
    <div class="row">
        <div class="col-sm-12" style="background:#1b5083;opacity:1;height:100px;color:white">
            <h1 style="line-height:100px;text-align:center">SERVICIOS</h1>
        </div>
    </div>
</div>
<div class="container" style="width:100%;margin:0px 0px 6px 0px;">      
    <div class="row" style="padding-top:50px;background:cadetblue;">
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/13.jpg" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">CONSULTORIA</span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/maintenance.jpg" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">DESARROLLO / MANTENIMIENTO</span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/servers.jpg" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">INFRAESTRUCTURA</span>
            </div>
        </div>
    </div>
</div>
<div class="container" style="width:100%;margin:0px 0px 6px 0px;">      
    <div class="row">
        <div class="col-sm-12" style="background:#1b5083;opacity:1;height:100px;color:white">
            <h1 style="line-height:100px;text-align:center">TECNOLOGIAS</h1>
        </div>
    </div>
</div>
<div class="container" style="width:100%;margin:0px 0px 6px 0px;">       
    <div class="row" style="padding-top:50px;background:darkseagreen;">
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/bpm.jpg" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">BPM</span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/esb.jpg" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">ESB</span>
            </div>
        </div>        
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/Web_Design.png" class="flipImg" style="background:#fff"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">WEB APLICACIONES (<span style="font-size:12px">PHP, HTML5, JS, CSS, etc</span>)</span>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top:0px;background:darkseagreen;">
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/java.png" class="flipImg" style="background:#2e4230"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">JAVA</span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/microsoft.png" class="flipImg" style="background:#2e4230"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">MICROSOFT / .NET</span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/socialMedia.jpg" class="flipImg" ></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">SOCIAL MEDIA</span>
            </div>
        </div>
    </div>
</div>
<div class="container" style="width:100%;margin:0px 0px 6px 0px;">      
    <div class="row">
        <div class="col-sm-12" style="background:#1b5083;opacity:1;height:100px;color:white">
            <h1 style="line-height:100px;text-align:center">VERTICALES</h1>
        </div>
    </div>
</div>
<div class="container" style="width:100%;margin:0px 0px -15px 0px;"> 
    <div class="row" style="padding-top:50px;background:aquamarine;">
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/banking.jpg" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">BANKING</span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/telecommunications.jpg" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">TELECOMUNICACIONES</span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/insurance.jpg" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:22px">SEGUROS</span>
            </div>
        </div>
    </div>
</div>


<div class="container" style="width:100%;margin:0px 0px 6px 0px;">      
    <div class="row">
        <div class="col-sm-12" style="background:#1b5083;opacity:1;height:100px;color:white">
            <h1 style="line-height:100px;text-align:center">NUESTRO PROYECTOS / NUESTRO CLIENTES</h1>
        </div>
    </div>
</div>
<div class="container" style="width:100%;margin:0px 0px -15px 0px;"> 
    <div class="row" style="padding-top:50px;background:aquamarine;">
        <div class="col-sm-3">
            <div class="flip">                
                <a href="http://www.sistececuador.com"><img src="images/projects/sistececuador.png" class="flipImg"></a>
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
