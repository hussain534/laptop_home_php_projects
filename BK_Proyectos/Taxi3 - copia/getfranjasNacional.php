<?php
	defined('__JEXEC') or ('Access denied');
	//session_start();
	session_start();
    include_once('util.php');
    include_once('config.php'); 
    $session_time=$session_expirry_time;
	$DEBUG_STATUS = $PRINT_LOG;
	if(isset($_GET["horavuelo"]))
	{
		$str=$_GET["horavuelo"];
	}
	//echo $str.'<br>';
  	require 'dbcontroller.php';
?>

<div class="container">
	<?php
		$controller = new controller();
		$viajeDtl = $controller->getDetallesViajesNacional($databasecon,$_GET["ciudad"],$_GET["ciudaddestino"],$_GET["horavuelo"],$_GET["sector"],$_GET["destino"],$_GET["nroasientes"],$_GET["mascotas"],$_GET["fumar"],$_GET["alcohol"],$DEBUG_STATUS);
	?>
    
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12">
            <h6>SE ENCUENTRO <?php if(count($viajeDtl)>0) echo 'SIGUIENTE'; else echo 0;?> VIAJE CERCA <?php echo '<b>'.$str.'</b>';?>
                <?php 
                    if(count($viajeDtl)>0)
                    {
                ?>                        
                    DESDE <?php if(count($viajeDtl)>0) echo '<b>'.$viajeDtl[0][3].'</b>'; else echo 0;?>
                    HASTA <?php if(count($viajeDtl)>0) echo '<b>'.$viajeDtl[0][4].'</b>'; else echo 0;?>
                    PARA <?php if(count($viajeDtl)>0) echo '<b>'.$viajeDtl[0][7].'</b>'; else echo 0;?>
                    PASAJERO(S)</h6>
                <?php                
                    }
                ?>
        </div>
        </div>
        <div class="col-sm-12">
            <!-- <div class="row">
                <?php
                for($x=0;$x<count($viajeDtl);$x++) 
                {
                ?>
                <div class="col-sm-12">                 
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="success_row">
                                    <th>ID</th>
                                    <th>PLACA</th>
                                    <th>AUTOMOVIL</th>
                                    <th>FECHA SALIDA</th>
                                    <th>LUGAR SALIDA</th>
                                    <th>LUGAR DESTINO</th>
                                    <th>COSTO/PASAJERO ( $ )</th>
                                    <th>RESERVAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $str='';
                                    $str2 = '';
                                    $str3 = '';
                                    $str4 = '';
                                    $strfinal='';
                                    
                                    if(count($viajeDtl)>0 && $viajeDtl[$x][11]==1)
                                    {
                                        $str2 = ' Esta viaje tiene parada de comer.';
                                    }
                                    if(count($viajeDtl)>0 && $viajeDtl[$x][12]==1)
                                    {
                                        $str3 = ' Esta viaje tiene diligencias.';
                                    }
                                    if(count($viajeDtl)>0 && $viajeDtl[$x][13]==1)
                                    {
                                        $str4 = ' Esta viaje lleva mercancias.';
                                    }
                                    $strfinal=$str2.' '.$str3.' '.$str4;
                                    
                                        echo '<tr class="warning"><td>'.$viajeDtl[$x][0].'</td><td>'.$viajeDtl[$x][2].'</td><td>'.$viajeDtl[$x][1].'</td><td>'.$viajeDtl[$x][5].'</td><td>'.$viajeDtl[$x][3].'</td><td>'.$viajeDtl[$x][4].'</td><td>'.$viajeDtl[$x][6].'</td><td><a href=reservar.php?tipoviaje=1&costoviaje='.$viajeDtl[$x][6].'&idviaje='.$viajeDtl[$x][0].'&cantpass='.$viajeDtl[$x][7].'><button type="button" class="btn-success btn-sm" id="empressa">RESERVAR <span class="glyphicon glyphicon-chevron-right"></span></button></a></td></tr>';   
                                        echo '<tr class="warning"><td colspan="8"><font style="color:red;"><b>NOTA:</b><font style="color:red;"><i>'.$strfinal.'</i></td></tr>';
                                ?>
                            </tbody>
                        </table>
                        </div>
                </div>
                <?php
                    }
                ?>
            </div> -->
            <?php
            for($x=0;$x<count($viajeDtl);$x++) 
            {
            ?>
            
            <br>
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <div class="input-group">
                      <span class="input-group-addon">ID</span>
                      <input id="msg" type="text" class="form-control" value='<?php echo $viajeDtl[$x][0];?>' readonly="true">
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
                      <span class="input-group-addon">PLACA</span>
                      <input id="msg" type="text" class="form-control" value='<?php echo $viajeDtl[$x][2];?>' readonly="true">
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
                      <span class="input-group-addon">AUTOMOVIL</span>
                      <input id="msg" type="text" class="form-control" value='<?php echo $viajeDtl[$x][1];?>' readonly="true">
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
                      <span class="input-group-addon">FECHA SALIDA</span>
                      <input id="msg" type="text" class="form-control" value='<?php echo $viajeDtl[$x][5];?>' readonly="true">
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
                      <span class="input-group-addon">LUGAR SALIDA</span>
                      <input id="msg" type="text" class="form-control" value='<?php echo $viajeDtl[$x][3];?>' readonly="true">
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
                      <span class="input-group-addon">LUGAR DESTINO</span>
                      <input id="msg" type="text" class="form-control" value='<?php echo $viajeDtl[$x][4];?>' readonly="true">
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
                      <span class="input-group-addon">COSTO / PASAJERO ( $ )</span>
                      <input id="msg" type="text" class="form-control" value='<?php echo $viajeDtl[$x][6];?>' readonly="true">
                    </div>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4 text-center">
                      <?php echo '<a href=reservar.php?tipoviaje=1&costoviaje='.$viajeDtl[$x][6].'&idviaje='.$viajeDtl[$x][0].'&cantpass='.$viajeDtl[$x][7].'><button type="button" class="btn-sm btn-info btn_center" id="empressa">RESERVAR <span class="glyphicon glyphicon-chevron-right"></span></button></a>';?>
                </div>
                <div class="col-sm-4">
                </div>
            </div>
            <br>
            <?php
            }
            ?>
            </fieldset>  
        </div>
    </div>
	
</div>