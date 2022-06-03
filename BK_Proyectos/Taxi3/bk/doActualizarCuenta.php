<?php
	defined('__JEXEC') or ('Access denied');
	session_start();
    include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
    $target_dir=$pics_location;
	
	require 'dbcontroller.php';

	$DEBUG_STATUS = $PRINT_LOG;
  	if(isset($_SESSION['LAST_ACTIVITY']))
    {
    	/*if(isset($_SESSION['userid']))
    		echo 'TRUE<br>';
    	else
    		echo 'FALSE<br>';
    	echo $_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'].'<br>';*/
		if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
		{
			//echo 'inside<br>';
			$url="userlogin.php";
			/*if(isset($_GET["idviaje"]))
				$_SESSION["last_url"]=$_SERVER['REQUEST_URI'];*/
			//echo $_SESSION["last_url"];
			header("Location:$url"); 
		}
        else
              $_SESSION['LAST_ACTIVITY'] = time();
	}
	else
		$_SESSION['LAST_ACTIVITY'] = time();


  
?>
<br>

	<?php
		$controller = new controller();
        //echo 'hello';
		$id = $controller->actualizarCuenta($databasecon,$_GET["idcuenta"],$_GET["nrocuenta"],$_GET["bancoId"],$_GET["tipoCuenta"],$_SESSION["userid"],$DEBUG_STATUS);
	    //echo $id;
    ?>
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
            <div class='alert alert-success shopAlert'>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                    if($id==0)
                        echo 'Detalles de cuenta actualizado correctamente.';
                    else
                        echo 'Error en actualizar detalles de cuenta. Por favor intentar mas tarde';
                ?>
             </div>
        </div>
        <div class="col-sm-3">
        </div>
    </div>