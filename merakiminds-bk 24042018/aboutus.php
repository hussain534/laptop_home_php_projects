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
                <span style="font-size:14px;letter-spacing:.5em;">J??venes profesionales | Equipo dedicado</span>
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
            fundada con la misi??n de ser un l??der proporcionando servicios de desarrollo de aplicaciones, consultor??a, servicios de soporte y mantenimiento, Desarrollo de aplicaciones 
            Web, soluciones para empresas de todos los sectores.</p>
            <br>
            <p>MERAKIMINDS ofrece el desarrollo de aplicaciones, consultor??a, servicios de soporte y mantenimiento, Desarrollo de aplicaciones 
            Web, soluciones para empresas de todos los sectores y de aplicaci??n de personalizaci??n e integraci??n. 
            Tenemos equipo de expertos con experiencia 
            en alto Tecnolog??a, habilidad vers??til y calificaciones m??s altas en sus verticales para ofrecerle las mejores 
            soluciones posibles de ??ltima generaci??n. </p>
        </div>
        <div class="summary_tab">
            <p>Nuestro equipo es capaz de proporcionar soluciones de software para todos tipos de cliente y puede ayudar con 
            servicios de TI para su crecimiento. En resumen, nuestro 
            equipo es - creativa, dedicada, expertos en tecnologia, excelente en habilidades de comunicaci??n, dedicado y amigable con cliente. </p>
            <br>
            <p>
            Nuestro Centro de 
            soluciones est?? construido con una combinaci??n de expertos en tecnolog??a y una buena infraestructura de TI. 
            Por encima de todo eso, siempre mantenemos 
            nuestros ojos en la innovaci??n de la tecnolog??a, las necesidades de negocio y soluciones para mantener a 
            nuestros clientes listo para ma??ana.</p>
        </div>
        <br><br><br>
        <div class="summary_tab3">
            <h1 style="border-bottom:1px solid grey;padding-bottom:3px"">Vision</h1>  
            <br>
            <p>Para ser nro.1 proveedor de soluciones de TI en Quito hasta finales de ano 2020.</p>
        </div>
        <div class="summary_tab3">
            <h1 style="border-bottom:1px solid grey;padding-bottom:3px"">Mision</h1>
            <br>
            <p>Fortalecer nuestros clientes proporcionando soluciones y consultoria de alta calidad para mejorar su negocio.</p>
        </div>
        <div class="summary_tab3">
            <h1 style="border-bottom:1px solid grey;padding-bottom:3px"">Valores</h1>
            <br>
            <p>Respetar el crecimiento, aprendizaje y satisfaccion de empleados y mantener la actitud para obtener el exito de nuestros clientes, 
            nuestro empresa y sociedad.</p>
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
