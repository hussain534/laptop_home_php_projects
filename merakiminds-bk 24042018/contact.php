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
        <img src="images/contact-us.png" style="width:100%; height:600px;">        
    </div>    
</div>
<br>
<br>
<br>
<div class="container cont" id="container06">
    <div class="row" > 
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6 text-center">
            <form method="post" action="contact_submit.php">
                <input type="hidden" name="submitted" value="true" />                        
                
                <h3>ENVIAR SU MENSAJE</h3>
                <br>
                <?php
                    if(isset($messsage))
                        echo '<h4>'.$messsage.'</h4>';
                ?>
                <input type="text" class="form-control" id="contact_user" name="contact_user" placeholder="Escribe su nombre" required>
                <input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="Escribe su correo electronico" required>
                <textarea class="form-control" name="contact_msg" placeholder="Escribe su mensaje" rows="2" required></textarea>
                <button type="submit" class="btn btn-success"  style="margin:5px" onclick="return validateEmail();">ENVIAR</button>
            </form> 
        </div>
        <div class="col-sm-3">
        </div>
    </div>
</div>
<br>
<br>
<br>
<script>
  function validateEmail() 
    {
        //alert("HI");
        var x = document.getElementById("contact_email").value;
        var atpos = x.indexOf("@");
        var dotpos = x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
            alert("ERROR FORMATO EMAIL");
            return false;
        }
        else
            return true;
}
</script>



<?php
    include_once('footer.php');
?>
<!-- <div class="contact">
    <p class="contact_me">All rights reserved with MERAKI MINDS CIA LTDA &copy 2015.</p>
</div> -->

</body>
</html>
