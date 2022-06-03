<?php
	defined('_JEXEC') or ('Access Deny');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MERAKI MINDS</title>
    <!-- <link href='https://fonts.googleapis.com/css?family=Lobster|Cabin|Noto+Serif|Shadows+Into+Light|Pacifico|Alegreya' rel='stylesheet' type='text/css'> -->
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
        <img src="images/professionals.jpg" style="width:100%; height:500px;"> 
        <div class="caption" style="top:40%;right:10%">
            <!-- <div class="sliderContent">
                <img src="images/slider/responsive.png">
            </div> -->
            <div class="sliderContent">
                <span style="font-size:30px;letter-spacing:.5em;">AQUI EN MERAKIMINDS</span><br><br>
                <span style="font-size:14px;letter-spacing:.5em;">Jóvenes profesionales | Equipo dedicado</span>
                <!-- <h2>HTML5 , CSS3, PHP , AJAX , JOOMLA, WORDPRESS</h2> -->
                <!-- <h3 style="color:#76913c;">Read More</h3> -->
            </div>
            <!-- <h1>Marriage</h1>
            <h2>Know More</h2> -->
        </div>       
    </div>    
</div>


<div class="containerMain">
    <br>
    <br>
    <br>
    <div class="summary">
        <h1 style="border-bottom:1px solid grey;padding-bottom:3px">Introduccion</h1>
        <br>      
        <div class="summary_tab">              
            
            <p>MERAKIMINDS es una empressa de desarrollo de software y consultoria con sede en QUITO, ECUADOR, 
            fundada con la misión de ser un líder proporcionando servicios de desarrollo de aplicaciones, consultoría, servicios de soporte y mantenimiento, Desarrollo de aplicaciones 
            Web, soluciones para empresas de todos los sectores.</p>
            <br>
            <p>MERAKIMINDS ofrece el desarrollo de aplicaciones, consultoría, servicios de soporte y mantenimiento, Desarrollo de aplicaciones 
            Web, soluciones para empresas de todos los sectores y de aplicación de personalización e integración. 
            Tenemos equipo de expertos con experiencia 
            en alto Tecnología, habilidad versátil y calificaciones más altas en sus verticales para ofrecerle las mejores 
            soluciones posibles de última generación. </p>
        </div>
        <div class="summary_tab">
            <p>Nuestro equipo es capaz de proporcionar soluciones de software para todos tipos de cliente y puede ayudar con 
            servicios de TI para su crecimiento. En resumen, nuestro 
            equipo es - creativa, dedicada, expertos en tecnologia, excelente en habilidades de comunicación, dedicado y amigable con cliente. </p>
            <br>
            <p>
            Nuestro Centro de 
            soluciones está construido con una combinación de expertos en tecnología y una buena infraestructura de TI. 
            Por encima de todo eso, siempre mantenemos 
            nuestros ojos en la innovación de la tecnología, las necesidades de negocio y soluciones para mantener a 
            nuestros clientes listo para mañana.</p>
        </div>
        <br><br><br>
        <div class="summary_tab3">
            <h3 style="border-bottom:1px solid grey;">Vision</h3>  
            <br>
            <p>Para ser nro.1 proveedor de soluciones de TI hasta finales de ano 2018</p>
        </div>
        <div class="summary_tab3">
            <h3 style="border-bottom:1px solid grey;">Mision</h3>
            <br>
            <p>Fortalecer nuestros clientes proporcionando soluciones y consultoria de alta calidad para mejorar su negocio</p>
        </div>
        <div class="summary_tab3">
            <h3 style="border-bottom:1px solid grey;">Valores</h3>
            <br>
            <p>Respetar el crecimiento, aprendizaje y satisfaccion de empleados y mantener la actitud para obtener el exito de nuestros clientes, 
            nuestro empresa y sociedad</p>
        </div>

        <!-- <div class="summary_tab">
            <div class="summaryContent"><img src="./images/web_hosting.png" alt="MerakiMinds web hosting" style="width: 180px; height: 150px;" /></div>
            <div class="summaryContent summaryContentwidth">
                <h2>ALOJAMIENTO WEB</h2>
                <br />
                <p>Proporcionamos alojamiento web en servidores web de terceros que proporciona planes economicos por mes . Tambi&eacute;n ofrecemos Soporte t&eacute;cnico para dominios web existentes.</p>
            </div>
        </div> -->
        
    </div>
</div>
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
