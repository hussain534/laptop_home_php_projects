<?php
	defined('__JEXEC') or ('Access denied');
	//session_start();
	session_start();
    include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
	$DEBUG_STATUS = $PRINT_LOG;
    $costo_uio_aero=$costo_quito_aeropuerto;
    $costo_aero_uio=$costo_aeropuerto_quito;
    $costo_viaje=0;
	if(isset($_GET["horavuelo"]))
	{
		$str=$_GET["horavuelo"];
	}
    if($_GET["nroasientes"]==4)
        $asientes=2;
    else if($_GET["nroasientes"]==5)
        $asientes=4;
    else
        $asientes=$_GET["nroasientes"];
	//echo $str.'<br>';

  	require 'dbcontroller.php';
?>

<div class="container">
	<?php
		$controller = new controller();
        if($_GET["sector"]==1)
        {
            $costo_viaje=$costo_aero_uio;
            $viajeDtl = $controller->getDetallesViajesDesdeAeropuerto($databasecon,$_GET["horavuelo"],$_GET["sector"],$asientes,$DEBUG_STATUS);
        }
        else            
        {
            $costo_viaje=$costo_uio_aero;
		    $viajeDtl = $controller->getDetallesViajesAAeropuerto($databasecon,$_GET["horavuelo"],$_GET["sector"],$asientes,$DEBUG_STATUS);
        }
	?>
    
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-2">                      
                </div>
                <div class="col-sm-8">
                    <h4>SE ENCUENTRO <?php if(count($viajeDtl)>0) echo 'SIGUIENTE'; else echo 0;?> VIAJE:</h4>
                </div>
                <div class="col-sm-2">                      
                </div>
            </div>
        </div>
        <?php if(count($viajeDtl)>0)
        {
        ?>

        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <div class="input-group">
                      <span class="input-group-addon">ID</span>
                      <input id="msg" type="text" class="form-control" value='<?php echo $viajeDtl[0][0];?>' readonly="true">
                    </div>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <div class="input-group">
                      <span class="input-group-addon">FECHA-HORA SALIDA</span>
                      <input id="msg" type="text" class="form-control" value='<?php echo $str;?>' readonly="true">
                    </div>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <div class="input-group">
                      <span class="input-group-addon">LUGAR DE SALIDA</span>
                      <input id="msg" type="text" class="form-control" value='<?php echo $viajeDtl[0][3];?>' readonly="true">
                    </div>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <div class="input-group">
                      <span class="input-group-addon">DESTINO</span>
                      <input id="msg" type="text" class="form-control" value='<?php echo $viajeDtl[0][4];?>' readonly="true">
                    </div>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <div class="input-group">
                      <span class="input-group-addon">NUMERO PLACA</span>
                      <input id="msg" type="text" class="form-control" value='<?php echo $viajeDtl[0][2];?>' readonly="true">
                    </div>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <div class="input-group">
                      <span class="input-group-addon">DETALLE AUTOMOVIL</span>
                      <input id="msg" type="text" class="form-control" value='<?php echo $viajeDtl[0][1];?>' readonly="true">
                    </div>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <div class="input-group">
                      <span class="input-group-addon">COSTO/PASAJERO</span>
                      <input id="msg" type="text" class="form-control" value='<?php echo $costo_viaje?>' readonly="true">
                    </div>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-3">
                    <b>ID</b>
                </div>
                <div class="col-sm-3">
                    <?php echo $viajeDtl[0][0];?>
                </div>
                <div class="col-sm-3">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-3">
                    <b>FECHA-HORA SALIDA</b>
                </div>
                <div class="col-sm-3">
                    <?php echo $str;?>
                </div>
                <div class="col-sm-3">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-3">
                    <b>DESDE</b>
                </div>
                <div class="col-sm-3">
                    <?php echo $viajeDtl[0][3];?>
                </div>
                <div class="col-sm-3">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-3">
                    <b>HASTA</b>
                </div>
                <div class="col-sm-3">
                    <?php echo $viajeDtl[0][4];?>
                </div>
                <div class="col-sm-3">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-3">
                    <b>PLACA</b>
                </div>
                <div class="col-sm-3">
                    <?php echo $viajeDtl[0][2];?>
                </div>
                <div class="col-sm-3">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-3">
                    <b>AUTOMOVIL</b>
                </div>
                <div class="col-sm-3">
                    <?php echo $viajeDtl[0][1];?>
                </div>
                <div class="col-sm-3">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-3">
                    <b>COSTO/PASAJERO</b>
                </div>
                <div class="col-sm-3">
                    <?php echo $costo_viaje?>
                </div>
                <div class="col-sm-3">
                </div>
            </div>
        </div> -->


        <div class="col-sm-12">
        <br>
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <?php
                        if($_GET["sector"]==1) //viaje desde aeropuerto
                        {
                            echo '<a href=doAcceptarViajeDesdeAeropuerto.php?tipoviaje=0&idviaje='.$viajeDtl[0][0].'&cantpass='.$asientes.'&c_viaje='.$_GET["c_viaje"].' style="color:#00b0f0;"><button type="button" class="btn btn-success btn-sm btn_center" id="btnReservarViajeDesdeAeropuerto">RESERVAR <span class="glyphicon glyphicon-chevron-right"></span></button></a>';                    
                        }
                        else //viaje hasta aeropuerto
                        {
                            echo '<a href=reservar.php?tipoviaje=0&idviaje='.$viajeDtl[0][0].'&cantpass='.$_GET["nroasientes"].' style="color:#00b0f0;"><button type="button" class="btn btn-success btn-sm btn_center" id="empressa">RESERVAR <span class="glyphicon glyphicon-chevron-right"></span></button></a>';
                        }
                    ?>                            
                </div>
                <div class="col-sm-4">
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>	
</div>