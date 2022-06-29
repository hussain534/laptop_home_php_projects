<?php
    session_start();
    if(!isset($_SESSION['LAST_ACTIVITY']))
    {
        session_destroy();
        $url='index.php?err=98';
        header("Location:$url");
    }
    include_once('util.php');
    include_once('header.php');
    if(isset($_SESSION["message"]))
    {
        $msg=$_SESSION["message"];
        unset($_SESSION["message"]);
    }
    /*include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    require 'controladorDB.php';
    $controladorDB = new controladorDB();*/
    $dbTable='tipoevaluacion';
    if(isset($_GET["pid"]))
    {
        $data = $controladorDB->obtenerDataTipoEvaluacion($databasecon,$_GET["pid"],$dbTable,$DEBUG_STATUS);
        $id=$data[0][0];
        $nombre=$data[0][1];
        $peso=$data[0][2];
        $id_perfil_evaluador=$data[0][3];
        $id_perfil_evaluado=$data[0][4];
    }
    else
    {
        $data = $controladorDB->obtenerDataTipoEvaluacion($databasecon,0,$dbTable,$DEBUG_STATUS);
        $id=0;
        $nombre='';
        $peso=0;
        $id_perfil_evaluador=-1;
        $id_perfil_evaluado=-1;
    }
    //$data = $controladorDB->obtenerDataTipoEvaluacion($databasecon,0,$dbTable,$DEBUG_STATUS);
    //echo 'count::'.count($permisos);
?>
<style type="text/css">
    body
    {
        background-image: none !important;
    }
</style>
<div class="container">    
    <?php
    include_once('sessionData.php');
    ?>
    <div class="row pageTitle">
        <div class="col-sm-12">
            TIPO EVALUACION
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center">
            <?php
            if(isset($msg))
            {
            ?>
            <div class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $msg;?>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <form method="post" action="controladorProceso.php?proceso=8&task=0">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="id" name ="id" value=<?php echo $id;?> /> 
                        <input type="hidden" id="dbTable" name ="dbTable" value=<?php echo $dbTable;?> /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label>TIPO EVALUACION</label>
                        <input type="nombre" class="form-control navbar-btn" id="nombre" placeholder="NOMBRE" name="nombre" value="<?php echo $nombre;?>"required>
                    </div>
                    <!-- <div class="col-sm-1">
                        <label>PESO ( % )</label>
                        <input type="peso" class="form-control navbar-btn" id="peso" placeholder="NOMBRE" name="peso" value="<?php echo $peso;?>"required>
                    </div> -->
                    <div class="col-sm-2">
                        <label>PESO ( % )</label>
                        <select name="peso" class="form-control navbar-btn" id="peso" onChange="buscarComboData()" required>
                            <option value=0><?php echo '[0]:ESCOGER PESO';?></option>
                            <?php
                            for($i=10;$i<=100;$i=$i+10)
                            {
                                if($i==$peso)
                                {
                                    ?>
                                    <option value=<?php echo $i;?> selected="true"><?php echo $i;?></option>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <option value=<?php echo $i;?> ><?php echo $i;?></option>
                                    <?php
                                }                                
                            }
                            ?>                        
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label>EVALUADOR</label>
                        <select name="idEvalr" class="form-control navbar-btn" id="idEvalr" onChange="buscarComboData()" required readonly="true">
                            <option value=-1><?php echo '[-1]:TODO';?></option>
                            <!-- <option value=0><?php echo '[0]:MISMO';?></option> -->
                            <?php
                                $dbTable='c_perfil';
                                $evaluador = $controladorDB->obtenerData($databasecon,0,$dbTable,$DEBUG_STATUS);
                                for($i=0;$i<count($evaluador);$i++)
                                {
                                    if($id_perfil_evaluador==$evaluador[$i][0])
                                    {
                                        ?>
                                            <option value=<?php echo $evaluador[$i][0];?> selected="true"><?php echo '['.$evaluador[$i][0].']:'.$evaluador[$i][1];?></option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <option value=<?php echo $evaluador[$i][0];?>><?php echo '['.$evaluador[$i][0].']:'.$evaluador[$i][1];?></option>
                                        <?php
                                    }                                    
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label>EVALUADO</label>
                        <select name="idEvalo" class="form-control navbar-btn" id="idEvalo" onChange="buscarComboData()" required>
                            <option value=-1><?php echo '[-1]:TODO';?></option>
                            <!-- <option value=0><?php echo '[0]:MISMO';?></option> -->
                            <?php
                                $dbTable='c_perfil';
                                $evaluado = $controladorDB->obtenerData($databasecon,0,$dbTable,$DEBUG_STATUS);
                                for($i=0;$i<count($evaluado);$i++)
                                {
                                    if($id_perfil_evaluado==$evaluado[$i][0])
                                    {
                                        ?>
                                            <option value=<?php echo $evaluado[$i][0];?> selected="true"><?php echo '['.$evaluado[$i][0].']:'.$evaluado[$i][1];?></option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <option value=<?php echo $evaluado[$i][0];?>><?php echo '['.$evaluado[$i][0].']:'.$evaluado[$i][1];?></option>
                                        <?php
                                    }                                    
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="row text-center">
                    <button type="submit" class="btn btn-info" title="Click to enter our portal">ACTUALIZAR<span class="glyphicon glyphicon-chevron-right"></span></button>
                    <a href="tipoevaluacion.php"><button type="button" class="btn btn-info" >RESET<span class="glyphicon glyphicon-chevron-right"></span></button></a>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <br>
    <?php
        if(isset($data))
        {
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <td>ID</td>
                            <td>TIPO EVALUACION</td>
                            <td>PESO ( % )</td>
                            <td>EVALUADOR</td>
                            <td>EVALUADO</td>
                            <td>ACCION</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                $dbTable='tipoevaluacion';
                for($x=0;$x<count($data);$x++)
                {
            ?>
                        <tr class="table-body">
                            <td><?php echo $data[$x][0];?></td> 
                            <td><?php echo $data[$x][1];?></td>
                            <td><?php echo $data[$x][2];?></td>
                            <td><?php echo $data[$x][5];?></td>
                            <td><?php echo $data[$x][6];?></td>
                            <td>
                                <a href="tipoevaluacion.php?pid=<?php echo $data[$x][0];?>&peso=<?php echo $data[$x][2];?>"><span class="glyphicon glyphicon-pencil" style="font-size:x-large;color:grey;"></span></a>
                                <a href="controladorProceso.php?proceso=7&task=1&id=<?php echo $data[$x][0];?>&tid=<?php echo $dbTable;?>"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
                            </td>
                        </tr>
            <?php
                }
            ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
    ?>
    <br>
</div>