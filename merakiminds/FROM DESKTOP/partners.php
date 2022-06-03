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
        <img src="images/partners.jpg" style="width:100%; height:600px;"> 
        <div class="caption" style="top:30%;">
            <!-- <div class="sliderContent">
                <img src="images/slider/responsive.png">
            </div> -->
            <div class="sliderContent">
                <span style="font-size:30px;letter-spacing:.5em;">NUESTROS PARTNERS</span>
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
            <h1 style="line-height:100px;text-align:center">PARTNERS</h1>
        </div>
    </div>
</div>
<div class="container" style="width:80%;margin:auto;">      
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10">
            <div class="services">
                <img src="images/manexware.png">
            </div>
            <br>
            <div class="services">
                <h3>MANEXWARE S.A</h3>
            </div>
            <br><br>
            <p class="text-services">Manexware proporciona soluciones orientadas a la empresa y siempre se esfuerza por la excelencia y un trabajo orientado a resultados.
            <br><br>
            En Manexware, hemos obtenido al mejor equipo para entender tus necesidades en personalización e integrar la mejor solución para tu sistema. Ofrecemos una personalización en Odoo ERP única, relevante y orientada a objetos que guía a la industria e incremente el mercado.
            No necesitas preocuparte mas en servicios de desarrollo personalizados ya que en Manexware, te ofrecemos una personalización en Odoo ERP única, relevante y orientada a objetivos que guía a la industria e incremente el mercado.
            <br><br>

            <h4><b>Desarrollo Web</b></h4>
            Proveemos mantenimiento de ERP para actualizaciones asi como tambien llenar los requerimientos para un buen funcionamiento de su negocio.
            <br><br>
            <h4><b>Aplicación móvil</b></h4>
            Ofrecemos servicios para desarrollo de aplicaciones en Android y iPhone que satisfagan los requerimientos de su negocio.
            <br><br>
            <h4><b>Desarrollo de software</b></h4>
            Creamos plataformas con gran diseño, funcionalidad y agilidad. Contamos con experiencia en desarrollo y gestión de proyectos donde nuestos clientes se han transformado en partners y socios estratégicos.
            <br><br>
            <h4><b>Integracion de aplicaciones</b></h4>
            Posee experiencia en las integraciones de aplicaiones de negocio usando productos de IBM(Message Brokers, Integration Bus, Data Powers, Portal Server, LDAP, etc)

            </p>
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
