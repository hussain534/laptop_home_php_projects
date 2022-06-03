<?php
include_once('util.php');
if(session_status() == PHP_SESSION_NONE)
    session_start();
include_once('portal-menu.php');

include_once('config.php');    
$DEBUG_STATUS = $PRINT_LOG;
require 'dbcontroller.php';
$controller = new controller();
$users = $controller->getUsers($databasecon,$DEBUG_STATUS); 
$perfiles = $controller->getRoles($databasecon,$DEBUG_STATUS);
$sucursales = $controller->getBranches($databasecon,$DEBUG_STATUS);

?>
<div class="row mm-container mm-container-back-insession">
    <div class="col-sm-2">
        <?php
            include_once("sidebar_menu.php");
        ?>
    </div> 
    <div class="col-sm-10 row_no_margin">
        <div class="row text-center">
            <h1>ADMINISTRACIÓN DE EMPLEADOS</h1>
        </div>
        <?php
            include_once('messagePanel.php');
        ?>
        <div class="row">
            <div class="col-sm-12">
                <form action="controller.php?controller=4&task=0" method="post">
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo 0;?>" class="form-control">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <span class="input-group-addon">NOMBRE</span>
                                <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Ingresar nombre">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">EMAIL</span>
                                <input type="text" id="user_email" name="user_email" class="form-control" placeholder="Ingresar email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">TELEFONO</span>
                                <input type="text" id="user_phone" name="user_phone" class="form-control" placeholder="Ingresar telefono">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">PERFIL</span>
                                <select class="form-control" id="user_perfil" name="user_perfil">
                                    <?php
                                        for($x=0;$x<count($perfiles);$x++)
                                        {
                                    ?>
                                    <option value="<?php echo $perfiles[$x][0];?>"><?php echo $perfiles[$x][1];?></option>
                                    <?php
                                        }
                                    ?>
                                  </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">SUCURSAL</span>
                                <select class="form-control" id="user_branch" name="user_branch">
                                    <?php
                                        for($x=0;$x<count($sucursales);$x++)
                                        {
                                    ?>
                                    <option value="<?php echo $sucursales[$x][0];?>"><?php echo $sucursales[$x][1];?></option>
                                    <?php
                                        }
                                    ?>
                                  </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary" id="btnOpenManageBusinessForm">ACTUALIZAR</button>
                            </div>
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary" id="btnOpenManageBusinessForm">BUSCAR</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <?php
                        if(count($users)>0)
                            echo '<h4>'.count($users).' REGISTROS ENCONTRADOS</h4>';
                        else
                            echo '<h4>0 REGISTROS ENCONTRADOS</h4>'
                    ?>
                    <div class="table-responsive">          
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NOMBRE</th>
                                    <th>SUCURSAL</th>
                                    <th>TELEFONO</th>
                                    <th>MOBILE</th>
                                    <th>EMAIL</th>
                                    <th>PERFIL</th>
                                    <th>ESTADO</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(count($users)>0)
                                    {
                                        for($x=0;$x<count($users);$x++)
                                        {
                                    ?>
                                        <tr>
                                            <td><?php echo $users[$x][0];?></td>
                                            <td><?php echo $users[$x][1];?></td>
                                            <td><?php echo $users[$x][3];?></td>
                                            <td><?php echo $users[$x][4];?></td>
                                            <td><?php echo $users[$x][5];?></td>
                                            <td><?php echo $users[$x][6];?></td>
                                            <td><?php echo $users[$x][8];?></td>
                                            <td><?php echo $users[$x][9];?></td>
                                            <td><?php if($users[$x][9]==0) echo 'DESHABILITADO'; else echo 'HABILITADO'?></td>
                                            <td>
                                                <?php
                                                echo '<a href="#" onclick=habilitarEditUser("'.$users[$x][0].'","'.urlencode($users[$x][1]).'","'.$users[$x][6].'",'.urlencode($users[$x][4]).','.$users[$x][7].',"'.urlencode($users[$x][2]).'")><span class="glyphicon glyphicon-pencil icon_action"></span></a>';
                                                if($users[$x][9]==0)
                                                    echo '<a href="#" onclick=delUser("'.$users[$x][0].'","'.urlencode($users[$x][1]).'","'.urlencode($users[$x][2]).'",0)><span class="glyphicon glyphicon-arrow-up icon_action"></span></a>';
                                                else
                                                    echo '<a href="#" onclick=delUser("'.$users[$x][0].'","'.urlencode($users[$x][1]).'","'.urlencode($users[$x][2]).'",1)><span class="glyphicon glyphicon-arrow-down icon_action"></span></a>';
                                                ?>
                                                <!-- <button type="button" class="btn btn-primary" id="editCliente"><i class="glyphicon glyphicon-pencil icon_action"></i></button>
                                                <button type="button" class="btn btn-primary" id="deleteCliente"><i class="glyphicon glyphicon-remove icon_action"></i></button> -->
                                            </td>
                                        </tr>
                                <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once('footer.php');
?>
