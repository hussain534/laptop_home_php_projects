<?php
    //defined('__JEXEC') or ('Access denied');
    
//    session_start();
    include_once('util.php');
    include_once('header.php');

    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
//    require 'dbcontroller.php';
    $controller = new controller();


    $msg='';
    if(isset($_SESSION["err_code"]))
    {
        if($_SESSION["err_code"]==0)
        {
            $msg= "Error en registrar tarea. Intenta mas tarde";
        }
        else if($_SESSION["err_code"]==1)
        {
            $msg= "Su tarea registrado correctamente.";
        }
        else if($_SESSION["err_code"]==2)
        {
            $msg= "Su tarea eliminado correctamente.";
        }
        else if($_SESSION["err_code"]==3)
        {
            $msg= "Su tarea modificado correctamente.";
        }
        unset($_SESSION["err_code"]);
    }
    if(isset($_SESSION["tasks"]))
    {
        $tasks= $_SESSION["tasks"];
        unset($_SESSION["tasks"]);
    }
    else
        $tasks = $controller->getAssignedTasksByStatus($databasecon,99,$DEBUG_STATUS);
    
?>
<div class="container">
    <?php
    include_once('sessionData.php');
    ?>
    <div class="row pageTitle">
        <div class="col-sm-12">
            TRABAJOS ASIGNADO HOY            
        </div>
    </div>
    
    <?php
        
        if(isset($tasks))
            echo '<h4>Encontrado '.count($tasks).' tareas asignados</h4>'
    ?>
    
    <?php
        if(isset($tasks))
        {
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr style="background:burlywood">
                            <td>ID</td>
                            <td>TIPO</td>
                            <td>DETTALE NOTIFICACION</td>
                            <td>DETALLE ASIGNACION</td>
                            <td>PRIORIDAD</td>
                            <td>SERVICIO / APLICACION</td>
                            <td>DETALLES TAREA</td>
                            <td>DOCUMENTO DE TAREA</td>
                            <td>EMAIL ENVIDO</td>
                            <td>LLAMADA REALIZADO</td>
                            <td>GESTION REALIZADO</td>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                for($x=0;$x<count($tasks);$x++)
                {
            ?>
                        <tr>
                            <td><?php echo $tasks[$x][0];?></td>
                            <td><?php echo $tasks[$x][1];?></td>                            
                            <td><?php echo $tasks[$x][2].'<br>'.$tasks[$x][3].'<br>'.$tasks[$x][4].'<br>'.$tasks[$x][5];?></td>
                            <td><?php echo $tasks[$x][6].'<br>'.$tasks[$x][7];?></td>
                            <td><?php echo $tasks[$x][8];?></td>
                            <td><?php echo $tasks[$x][9].'<br>'.$tasks[$x][12];?></td>
                            <td><?php echo $tasks[$x][15].'<br>'.$tasks[$x][16].'<br>'.$tasks[$x][17].'<br>'.'<b>'.$tasks[$x][10].'</b><br>'.$tasks[$x][11];?></td>
                            <td>
                                <?php 
                                    if(isset($tasks[$x][18]) && !empty($tasks[$x][18]) && strcmp('uploads/',$tasks[$x][18])!=0) 
                                    {
                                ?>
                                    <a href=<?php echo $tasks[$x][18];?> target="0"><span class="glyphicon glyphicon-list-alt glyphicon-list-alt-doc-exist"></span></a> 
                                <?php
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if(!isset($tasks[$x][13]) || empty($tasks[$x][13])) 
                                    {
                                ?>
                                    <a href=controller.php?controller=3&task=1&medio=1&id=<?php echo $tasks[$x][0];?>><span class="glyphicon glyphicon-send"></span></a> 
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                    <span class="glyphicon glyphicon-send glyphicon-send-done"></span>
                                <?php        
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if(!isset($tasks[$x][14]) || empty($tasks[$x][14])) 
                                    {
                                ?>
                                    <a href=controller.php?controller=3&task=1&medio=2&id=<?php echo $tasks[$x][0];?>><span class="glyphicon glyphicon-phone-alt"></span></a> 
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                    <span class="glyphicon glyphicon-phone-alt glyphicon-phone-alt-done"></span>
                                <?php        
                                    }
                                ?>
                            </td>
                            <td class="text-center"><a href="registrarGestion.php?tid=<?php echo $tasks[$x][0];?>"><span class="glyphicon glyphicon-th-list" style="color:purple !important; font-size: xx-large;"></span><span class="badge"><?php echo $tasks[$x][20];?></span></a>
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