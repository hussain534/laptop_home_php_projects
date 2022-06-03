<?php
include_once('util.php');
session_start();
include_once('portal-menu.php');

?>
<div class="row mm-container mm-container-back-insession">
    <div class="col-sm-2">
        <?php
            include_once("sidebar_menu.php");
        ?>
    </div> 
    <div class="col-sm-10 row_no_margin">
        <div class="row text-center">
            <h1>GESTION DE CLAVE</h1>
        </div>
        <?php
            include_once('messagePanel.php');
        ?>
        <div class="row">
            <div class="col-sm-12">
                <form action="controller.php?controller=0&task=3" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">CLAVE ACTUAL</span>
                                <input type="password" id="clave_anterior" name="clave_anterior" class="form-control" placeholder="Ingresar su clave actual">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">NUEVO CLAVE</span>
                                <input type="password" id="clave_nuevo" name="clave_nuevo" class="form-control" placeholder="Ingresar su clave nuevo">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary" id="btnOpenManageBusinessForm">ACTUALIZAR</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once('footer.php');
?>
