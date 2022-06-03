<?php
include_once('util.php');
include_once('logoPanel.php');
include_once('menu.php');
?>
<div class="container" style="min-height: 400px;">
    <div class="row">
        <div class="col-sm-12 text-center">
<?php
    //session_start();
    if(isset($_POST['submitted']))
    {
        //echo 'TO:'.$_POST['contact_email'];
        //echo 'NOMBRE:'.$_POST['contact_user'];
        //echo 'MESSAGE:'.$_POST['contact_msg'];
        $to = 'kackau1@hotmail.com';
        $subject = 'NUEVO MENSAJE : '.strtoupper($_POST['asunto']);
        $txt = 'Ha recibido un nueve mensaje enviado por : '.strtoupper($_POST['contact_user'])."\n\n\n";
        $txt=$txt.'Email : '.$_POST['contact_email']."\n\n\n";
        $txt=$txt.'Mensaje : '.$_POST['contact_msg']."\n\n\n"; 
        $txt=$txt.'www.kackausweet.com '."\n\n\n";       
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
        $headers = 'From: KACKAUSWEET <portal@kackausweet.com>';

        $res=mail($to,$subject,$txt,$headers);
        if($res==true)
        {
            echo '<h4 style="color:red">SU MENSAJE FUE ENVIADO CORRECTAMENTE</h4>';
        }
        else
        {
            echo '<h4 style="color:red">ERROR ENVIAR SU MENSAJE.INTENTA NUEVAMENTE</h4>';

        }

        //$url='http://nexosafe.com/#container06';
        //header("Location:$url");
    }
?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center">
            <!-- <a href="http://www.kackausweet.hutesol.com"><button type="button" class="btn btn-default"  style="margin:5px">REGRESAR</button></a> -->            
            <a href="http://www.kackausweet.com"><button type="button" class="btn btn-default"  style="margin:5px">REGRESAR</button></a>
        </div>
    </div>
</div>
<?php
include_once('footer.php');
?>