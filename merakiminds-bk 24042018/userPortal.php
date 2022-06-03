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
    <style>
    .input-group-addon 
    {
        padding: 0px 12px !important;
        height: 25px !important;
        font-size: 12px;
        background-color: #1db320;
        color: beige;
        width: 200px !important;
        text-align: left;
    }
    .input-group
    {
        margin: 2px;
        width: 100%;
    }
    </style>
</head>
<body>
<?php
    include_once('header.php');
    $msg='';
    
?>

<!-- <div class="cycle-slideshow" 
    data-cycle-slides=".slide"        
    data-cycle-fx="flipHorz" 
    data-cycle-timeout="5000">
    <div class="slide" data-cycle-fx="flipHorz">
        <img src="images/join_us.jpg" style="width:100%; height:600px;"> 
        <div class="caption" style="top:30%;">
            <div class="sliderContent">
                <span style="font-size:30px;letter-spacing:.5em;">¿QUIERES TRABAJAR CON NOSOTROS?</span>
            </div>
        </div>       
    </div>    
</div>
<br>
<br>
<br> -->
<div class="container cont" id="container06">
    <div class="row" > 
        <div class="col-sm-5">
            <br>
            <br>
            <br>
            <br>
            <img src="images/work_with_us_areas.png" style="width:100%;">
        </div>
        <div class="col-sm-7 text-center">
            LOGIN OK
        </div>
    </div>
</div>
<br>
<br>
<br>


<?php
    include_once('footer.php');
?>


</body>
</html>
