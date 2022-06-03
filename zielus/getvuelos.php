<?php
	defined('__JEXEC') or ('Access denied');
	//session_start();
	session_start();
    include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time; 
	$DEBUG_STATUS = $PRINT_LOG;
	if(isset($_GET["tipovuelo"]))
	{
		//echo $_GET["tipovuelo"].'<br>';
		if($_GET["tipovuelo"]==1)
			$str="NACIONALES";
		else
			$str="INTERNACIONALES";
	}
	//echo $str.'<br>';
  	require 'dbcontroller.php';
?>

<div class="container">
	<?php
		$controller = new controller();
		$vueloDtl = $controller->getDetallesVuelos($databasecon,$_GET["tipovuelo"],$DEBUG_STATUS);
	?>
    
    <div class="row">
        <div class="col-sm-12">
                <h6>SE ENCUNETRO <?php echo count($vueloDtl);?> VULEOS <?php echo $str;?> CERCA <?php echo $_GET["fechasearch"];?></h6>
                <div class="row" style="border-top:1px solid #222;border-bottom:1px solid #222;background:#222;color:antiquewhite">
                	<div class="col-sm-1">
                		<h4>NRO.</h4>
                	</div>
                    <div class="col-sm-3">
                		<h4>CODIGO VUELO</h4>
                	</div>
                	<div class="col-sm-2">
                		<h4>ORIGEN</h4>
                	</div>
                	<div class="col-sm-2">
                		<h4>DESTINO</h4>
                	</div>
                	<div class="col-sm-2">
                		<h4>FECHA SALIDA</h4>
                	</div>
                	<div class="col-sm-2">
                		
                	</div>
                </div>

                <?php
                for($x=0;$x<count($vueloDtl);$x++)
                {
                ?>
                <div class="row" style="border-bottom:1px solid #222;border-left:1px solid #222;border-right:1px solid #222;padding:5px 0;">
                	<div class="col-sm-1">
                		<?php echo $vueloDtl[$x][0]; ?>
                	</div>
                    <div class="col-sm-3">
                		<?php echo $vueloDtl[$x][1]; ?>
                	</div>
                	<div class="col-sm-2">
                		<?php echo $vueloDtl[$x][2]; ?>
                	</div>
                	<div class="col-sm-2">
                		<?php echo $vueloDtl[$x][3]; ?>
                	</div>
                	<div class="col-sm-2">
                		<?php echo $vueloDtl[$x][4]; ?>
                	</div>
                	<div class="col-sm-2">
                		<a href="#" onclick=getFranjas(<?php echo $vueloDtl[$x][0]; ?>) style="color:#00b0f0;">Ver Franjas</a>
                        <!-- <button type="button" id="btnFranjas" class="btn btn-success btn_center">VER FRANJAS <span class="glyphicon glyphicon-chevron-right"></span></button> -->
                	</div>
                </div>
                <?php
                }
                ?>
            </fieldset>  
        </div>
    </div>
	
</div>