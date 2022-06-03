<?php
    defined('__JEXEC') or ('Access denied');
    session_start();

    //PARAMETROS COMUNES PARA PAGINAS EN SESSION
    include_once('config.php'); 
    $DEBUG_STATUS = $PRINT_LOG;
    $session_time = $session_expirry_time;
    
    //VALIDAR SESSION
    if(!isset($_SESSION["user_name"]) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
    {
        $url='cerrarSesion.php';
        header("Location:$url");
    }

    $_SESSION['LAST_ACTIVITY'] = time();

    //CARGAR CLASE DE BDD
    require 'dbcontroller.php';
    $controller = new controller();

    function filterData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }
    $fileName = "puntajes" . date('Ymd') . ".xls";
    
    // headers for download
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Content-Type: application/vnd.ms-excel");
    
    $flag = false;

    if(isset($_POST["str-busqueda"]))
        $strBusqueda=$_POST["str-busqueda"];
    else
        $strBusqueda=null;
    
    $userList = $controller->exportarUserPuntos($databasecon,$strBusqueda,$DEBUG_STATUS);


    foreach($userList as $row) 
    {
        if(!$flag) 
        {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag = true;
        }
        // filter data
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";         
    }
?>