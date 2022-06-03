<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    
    require 'dbcontroller.php';

    $DEBUG_STATUS = $PRINT_LOG;
    if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
    {
        //echo 'inside<br>';
        $url="userlogin.php";
        $_SESSION["last_url"]='misreservas.php';
        //echo $_SESSION["last_url"];
        header("Location:$url"); 
    }
   
    
    
    $_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }

    $controller = new controller();
    if(isset($_POST["submitted"]))
    {
        //echo '<br><br>';
        //echo $_POST["id_viaje_selected"].'<br>';
        //echo $_POST["conductor"].'<br>';
        //echo $_POST["total_asientos"].'<br>';
        if(isset($_POST["conductor"]))
            $conductor=$_POST["conductor"];
        else
            $conductor=$_POST["conductorForzada"];

        $err_code=$controller->asignarConductorParaViaje($databasecon,$_POST["id_viaje_selected"],$conductor,$_POST["total_asientos"],$DEBUG_STATUS);
        if($err_code>0)
            $_SESSION["session_msg"]="VIAJE ASIGNADO A CONDUCTOR CORRECTAMENTE";
        else
            $_SESSION["session_msg"]="ERROR EN ASIGNAR VIAJE A CONDUCTOR. POR FAVOR INTENTA NUEVAMENTE";
    }
  
    $url="asignarConductor.php";
    header("Location:$url"); 

?>
<br>

