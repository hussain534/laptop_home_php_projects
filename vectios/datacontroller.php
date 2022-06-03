<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('config.php');    
    $DEBUG_STATUS = $PRINT_LOG;

    require 'dbcontroller.php';
    $controller = new controller();
    if(isset($_GET["dojob"]))
    {
        if($_GET["dojob"]==0 && $_GET["metodo"]==0)
        {    
            $viajes = $controller->getConductorsViajesAsigandos($databasecon,$_GET['id_conductor'],$_GET['dt_viaje'],$_GET['from_airport'],$DEBUG_STATUS); 
             
            if(isset($viajes) && count($viajes)>0)  
            {     
                for($x=0;$x<count($viajes);$x++)
                {
                    echo '<tr class="warning myrow">';
                    echo '<td>'.$viajes[$x][0].'</td>';
                    echo '<td>'.$viajes[$x][1].'</td>';
                    echo '<td>'.$viajes[$x][2].'</td>';
                    echo '<td>'.$viajes[$x][3].'</td>';
                    echo '<td>'.$viajes[$x][4].'</td>';
                    echo '</tr>';
                }  
            }
        }    
        else if($_GET["dojob"]==0 && $_GET["metodo"]==1)
        {    
            $err = $controller->aprobarContacto($databasecon,$_GET['idSolicitante'],$DEBUG_STATUS); 
             
            if($err==0)  
            {     
               echo '<b> <span style="color:green;font-weight:bold">CONTACTO APROBADO</span></b>';
            }
            else
            {
                echo '<b> <span style="color:red;font-weight:bold">ERROR APROBAR CONTACTO</span></b>';
            }
        }        
        else
        {
              
        }        
    }
    else
    {
        $_SESSION["message"]='ERROR EN DATA.';
    }
    
?>
                        