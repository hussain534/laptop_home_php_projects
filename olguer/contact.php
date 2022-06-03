<?php
  defined('__JEXEC') or ('Access denied');
  session_start();
  include_once('util.php');
  include_once('config.php');  
  $DEBUG_STATUS = $PRINT_LOG;

  require 'dbcontroller.php';
  $controller = new controller();
  
  include_once('menuPanel.php');

  
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
<?php
    //session_start();
    if(isset($_POST['submitted']))
    {
        //PROD
        $to = 'fernandoa@nipromed.com';
        $subject = 'NUEVO MENSAJE ENVIADO POR '.strtoupper($_POST['contact_user']);
        $txt = '<h3>Ha recibido un nueve mensaje'."!</h3><br><br>";
        $txt=$txt.'<h4>Correo Electronico del Cliente:</h4>'.$_POST['contact_email']."<br><br>";
        $txt=$txt.'<h4>Mensaje:</h4>'.$_POST['contact_msg']."<br><br>";        
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
        $headers .= 'From: PORTAL SISTEC ECUADOR <portal@sistececuador.com>';

        //PRUEBAS
        /*$to = 'hussain.mm.2006@gmail.com';
        $subject = 'NUEVO MENSAJE ENVIADO POR '.strtoupper($_POST['contact_user']);
        $txt = '<h3>Ha recibido un nueve mensaje'."!</h3><br><br>";
        $txt=$txt.'<h4>Correo Electronico del Cliente:</h4>'.$_POST['contact_email']."<br><br>";
        $txt=$txt.'<h4>Mensaje:</h4>'.$_POST['contact_msg']."<br><br>";        
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
        $headers .= 'From: PORTAL SISTEC ECUADOR <info@hutesol.com>';*/

        $res=mail($to,$subject,$txt,$headers);
        if($res==true)
        {
            echo '<h4 style="color:#f5f5f5">SU MENSAJE FUE ENVIADO CORRECTAMENTE</h4>';
        }
        else
        {
            echo '<h4 style="color:#f5f5f5">ERROR ENVIAR SU MENSAJE.INTENTA NUEVAMENTE</h4>';

        }

        //$url='http://nexosafe.com/#container06';
        //header("Location:$url");
    }
?>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-12 text-center">

            <!-- PROD-->
            <button type="button" class="btn btn-big"><a href="http://sistececuador.com">REGRESAR</a><span class="glyphicon glyphicon-chevron-right"></span></button>

            <!-- PRUEBAS -->
            <!-- <button type="button" class="btn btn-big"><a href="http://sistec.hutesol.com">REGRESAR</a><span class="glyphicon glyphicon-chevron-right"></span></button>                  -->
        </div>
    </div>
</div>


