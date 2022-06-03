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
                <span style="font-size:30px;letter-spacing:.5em;">SERVICES EN MERAKIMINDS</span><br><br>
                <span style="font-size:14px;letter-spacing:.5em;">Consultoria de TI| Desarrollo y mantenimiento de aplication | Gestion de infraestructura</span>
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
                <h3>CONSULTORIA</h3>
            </div>
            <br><br>
            <p class="text-services">Los negocios de hoy presenta un cuadro complejo . Mientras que las organizaciones luchan entre los requisitos 
            individuales de 'dirigir la empresa' y 'Desarrollar el negocio' , MERAKIMINDS entiende los imperativos . 
            <br><br>
                Hay una necesidad real de :
                    diseño de soluciones innovadoras que son rápidas y eficaces y 
                    habilitar el cambio a través de una aplicación rápida y eficiente.
            <br><br>
            La respuesta a estos requisitos radica en tres cruciales para fomentar : Conocimiento, diseño y colaboración. 
            MERAKIMINDS ayuda a las organizaciones a acelerar la toma de decisiones superior a través de un enfoque de colaboración 
            basado en el taller . Nuestros métodos estimulan la polinización cruzada de ideas creativas de diferentes disciplinas 
            utilizando diferentes paradigmas .</p>
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
            <p class="text-services">MERAKIMINDS tiene las herramientas necesarias , recursos , procesos e infraestructura para la realización de proyectos 
            de cualquier dimensión. El ciclo de vida se adapta a los requerimientos del cliente y la ejecución del proyecto sería 
            totalmente transparente. Ágil, , Cascada , iterativo y V modelo de ciclo de vida se utiliza ampliamente para ejecutar estos 
            proyectos. 
            <br><br>
            El equipo involucrado en las actividades de soporte y mantenimiento de aplicación llevará a cabo diversas tareas y 
            los recursos tendrá que establecer técnica mixta para realizar diversas tareas . Seguimiento de problemas , 
            gestión de problemas , los cierres de las incidentes se manejan a través de herramientas internas o del cliente suministrados , 
            convirtiendo el sistema muy robusto y transparente. 
            <br><br>
            Los datos de métricas de tarea de ejecución, 
            eficiencia y defectos calcula el desempeño de las actividades de apoyo de manera efectiva.
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
                <h3>GESTION DE INFRAESTRUCTURA</h3>
            </div>
            <br>
            <br>
            <p class="text-services">MERAKIMINDS ofrece soluciones a medida para que pueda administrar eficazmente su infraestructura de TI con la 
            excelencia operativa y la capacidad de resolver al instante interrupciones . 
            Servicios robusta , escalable , flexible y rentable para administrar la infraestructura de TI para las aplicaciones de 
            misión crítica es la necesidad de la hora para todos los negocios en la industria. 
            <br><br>
            MERAKIMINDS es partner con empresas líderes en tecnología para desarrollar una ventaja competitiva de las ofertas de 
            infraestructura.</p> 
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
