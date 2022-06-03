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
        <img src="images/professionals.jpg" style="width:100%; height:600px;"> 
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
        <h1 style="border-bottom:1px solid grey;padding-bottom:3px">Introducción</h1>
        <br>      
        <div class="summary_tab">              
            
            <p>MERAKIMINDS es una empressa de desarrollo de software y consultoria con sede en QUITO, ECUADOR, 
            fundada con la misión de ser un líder proporcionando servicios de desarrollo de aplicaciones, consultoría, servicios de soporte y mantenimiento, Desarrollo de aplicaciones 
            Web, soluciones para empresas de todos los sectores.</p>
            <br>
            <p>MERAKIMINDS ofrece el desarrollo de aplicaciones, consultoría, servicios de soporte y mantenimiento, Desarrollo de aplicaciones 
            Web, soluciones para empresas de todos los sectores y de aplicación de personalización e integración. 
            Tenemos expertos con experiencia 
            en alta tecnología, habilidad para adaptarse a cualquier ambiente de trabajo y certificaciones en su tecnología para ofrecerle las mejores 
            soluciones. </p>
        </div>
        <div class="summary_tab">
            <p>Nuestro equipo es capaz de proporcionar soluciones de software para todo tipo de clientes y puede ayudar con 
            servicios de TI para su crecimiento. En resumen, nuestro 
            equipo es - creativo, dedicado, experto en tecnologia, excelente en habilidades de comunicación y amigable con el cliente. </p>
            <br>
            <p>
            Nuestro Centro de 
            soluciones está construido con una combinación de expertos en tecnología y una buena infraestructura de TI. 
            Por encima de todo eso, siempre mantenemos 
            nuestros ojos en la innovación de la tecnología, las necesidades de cualquier negocio y soluciones para mantener a 
            nuestros clientes listos para el futuro.</p>
        </div>
        <br><br><br>
        <div class="summary_tab3">
            <h1 style="border-bottom:1px solid grey;padding-bottom:3px"">Visión</h1>  
            <br>
            <p>Ser el mejor proveedor de soluciones de TI en Ecuador.</p>
        </div>
        <div class="summary_tab3">
            <h1 style="border-bottom:1px solid grey;padding-bottom:3px"">Misión</h1>
            <br>
            <p>Fortalecer a nuestros clientes proporcionando soluciones y consultoría de alta calidad para mejorar sus negocios.</p>
        </div>
        <div class="summary_tab3">
            <h1 style="border-bottom:1px solid grey;padding-bottom:3px"">Valores</h1>
            <br>
            <p>Respeto al crecimiento individual de cada colaborador, servicios orientados a satisfacer las necesidades de nuestros clientes, compromiso con el aprendizaje continuo y búsqueda de soluciones innovadoras.</p>
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


<?php
    include_once('footer.php');
?>

<!-- <div class="contact">
    <p class="contact_me">All rights reserved with MERAKI MINDS CIA LTDA &copy 2015.</p>
</div> -->

</body>
</html>
