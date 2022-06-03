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
        <img src="images/services.png" style="width:100%; height:600px;"> 
        <div class="caption" style="top:30%;">
            <!-- <div class="sliderContent">
                <img src="images/slider/responsive.png">
            </div> -->
            <div class="sliderContent">
                <span style="font-size:30px;letter-spacing:.5em;">SERVICIOS DE MERAKIMINDS</span><br><br>
                <span style="font-size:14px;letter-spacing:.5em;">Consultoría de TI| Desarrollo y mantenimiento de aplicaciones | Gestión de infraestructura</span>
                <!-- <h2>HTML5 , CSS3, PHP , AJAX , JOOMLA, WORDPRESS</h2> -->
                <!-- <h3 style="color:#76913c;">Read More</h3> -->
            </div>
            <!-- <h1>Marriage</h1>
            <h2>Know More</h2> -->
        </div>       
    </div>    
</div>

<div class="container" style="width:80%;margin:auto;">      
    <div class="row">
        <div class="col-sm-12" style="opacity:1;height:100px;">
            <h1 style="line-height:100px;text-align:center">SERVICIOS</h1>
        </div>
    </div>
</div>
<div class="container" style="width:80%;margin:auto;">      
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10">
            <div class="services">
                <img src="images/Consultancy.png">
            </div>
            <div class="services">
                <h3>CONSULTORÍA</h3>
            </div>
            <br><br>
            <p class="text-services">Los negocios de hoy presentan un cuadro complejo, mientras que las organizaciones luchan entre los requisitos 
            individuales de 'dirigir la empresa' y 'Desarrollar el negocio' , MERAKIMINDS ayuda a sus necesidades de:
            <br><br>
                    Diseño de soluciones innovadoras que son rápidas y eficaces y a  
                    habilitar el cambio a través de una aplicación eficiente.
            <br><br>
            La respuesta a estos requisitos radica en tres parámetros cruciales : Conocimiento, diseño y colaboración. 
            MERAKIMINDS ayuda a las organizaciones a acelerar la toma de decisiones a través de asesoría personlizada según cada necesidad. 
        </p>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <br><br><br><br><br>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10">
            <div class="services">
                <img src="images/ApplDev.png">
            </div>
            <div class="services">
                <h3>DESARROLLO DE APLICACIONES</h3>
            </div>
            <br><br>
            <p class="text-services">MERAKIMINDS tiene recursos, herramientas, procesos e infraestructura para la implementación de proyectos 
            de cualquier dimensión. Utilizamos los modelos - Ágil, Cascada e Iterativo para la ejecución de los proyectos los cuales se adaptan a las necesidades de cada cliente. 
            <br><br>
            El seguimiento, gestión y cierre de los incidentes se manejan a través de herramientas internas. 
            <br><br>
            Los reportes periódicos demuestran el cumplimiento de las actividades realizadas para la implementación de los proyectos o atención de los incidentes.
            </p>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <br><br><br><br><br>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10">
            <div class="services">
                <img src="images/Maintenance.png">
            </div>
            <div class="services">
                <h3>GESTIÓN DE INFRAESTRUCTURA</h3>
            </div>
            <br>
            <br>
            <p class="text-services">MERAKIMINDS ofrece infraestructura a medida y herramientas para administración de los equipos y de las aplicaciones. 
            <br><br>
            MERAKIMINDS es partner con empresas líderes en tecnología para ofrecer costos competitivos en infraestructura.</p> 
            <br><br>
            
        </div>
        <div class="col-sm-1">
        </div>
    </div>
    <br><br><br><br><br>
</div>



<?php
    include_once('footer.php');
?>
<!-- <div class="contact">
    <p class="contact_me">All rights reserved with MERAKI MINDS CIA LTDA &copy 2015.</p>
</div> -->

</body>
</html>
