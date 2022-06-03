<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MERAKIMINDS</title>
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
    data-cycle-fx="fadeout" 
    data-cycle-timeout="3000">
    <span class="cycle-next">&#9002;</span> 
    <span class="cycle-prev">&#9001;</span>
    
    
    <div class="slide" data-cycle-fx="fadeout">
        <img src="images/meeting.jpg""> 
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
    <div class="slide" data-cycle-fx="fadeout">
        <img src="images/softwareDeveloment.jpg""> 
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
    <div class="slide" data-cycle-fx="fadeout">
        <img src="images/infrastructure.jpg""> 
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
<div class="container" style="width:100%;margin:auto;">      
    <div class="row">
        <div class="col-sm-12 myLabel">
            <h1>SERVICIOS</h1>
        </div>
    </div>
</div>
<div class="container" style="width:100%;margin:auto;">      
    <div class="row">
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/13.jpg" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:18px">CONSULTORIA</span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/maintenance.jpg" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:18px">DESARROLLO / MANTENIMIENTO</span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/servers.jpg" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:18px">INFRAESTRUCTURA</span>
            </div>
        </div>
    </div>
</div>
<div class="container" style="width:100%;margin:auto;">      
    <div class="row">
        <div class="col-sm-12 myLabel">
            <h1>TECNOLOGIAS</h1>
        </div>
    </div>
</div>
<div class="container" style="width:100%;margin:auto;">       
    <div class="row">
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/bpm.jpg" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:18px">BPM</span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/esb.jpg" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:18px">ESB</span>
            </div>
        </div>        
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/Web_Design.png" class="flipImg" style="background:#fff"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:18px">WEB APLICACIONES (<span style="font-size:12px">PHP, HTML5, JS, CSS, etc</span>)</span>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top:0px;">
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/java.png" class="flipImg" style="background:#2e4230"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:18px">JAVA</span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/microsoft.png" class="flipImg" style="background:#2e4230"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:18px">MICROSOFT / .NET</span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/socialMedia.jpg" class="flipImg" ></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:18px">SOCIAL MEDIA</span>
            </div>
        </div>
    </div>
</div>
<div class="container" style="width:100%;margin:auto;">      
    <div class="row">
        <div class="col-sm-12 myLabel">
            <h1>VERTICALES</h1>
        </div>
    </div>
</div>
<div class="container" style="width:100%;margin:auto;"> 
    <div class="row">
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/banking.jpg" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:18px">BANKING</span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/telecommunications.jpg" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:18px">TELECOMUNICACIONES</span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="flip">                
                <a href="#"><img src="images/insurance.jpg" class="flipImg"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:18px">SEGUROS</span>
            </div>
        </div>
    </div>
</div>


<div class="container" style="width:100%;margin:auto;">      
    <div class="row">
        <div class="col-sm-12 myLabel">
            <h1>NUESTRO PROYECTOS / NUESTRO CLIENTES</h1>
        </div>
    </div>
</div>
<div class="container" style="width:100%;margin:auto;"> 
    <div class="row">
        <div class="col-sm-6">
            <div class="flip">                
                <a href="http://www.sistececuador.com"><img src="images/projects/sistececuador.png" class="flipImg2"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:18px">SISTEC (NIPRO)</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="flip">                
                <a href="http://www.nexosafe.com"><img src="images/projects/nexosafe.png" class="flipImg2"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:18px">NEXOSAFE</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="flip">                
                <a href="http://www.bushidoecuador.com"><img src="images/projects/bushidoecuador.png" class="flipImg2"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:18px">BUSHIDOAPP (NIPRO)</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="flip">                
                <a href="#"><img src="images/projects/vectios.png" class="flipImg2"></a>
            </div>
            <div class="flip flipTitle">
                <span style="font-size:18px">VECTIOS</span>
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
