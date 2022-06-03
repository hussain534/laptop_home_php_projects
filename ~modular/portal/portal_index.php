<?php

include_once('../common/config.php');
include_once('../util.php');
if(session_status() == PHP_SESSION_NONE)
    session_start();
include_once('portal-menu.php');

?>

<?php
if($_SESSION["user_role"]<=0)
{
?>


<div class="row mm-container mm-container-back-insession">
    <div class="col-sm-2">
        <?php
            include_once("sidebar_menu_super_admin.php");
        ?>
    </div>
</div>
<?php
}
else if($_SESSION["user_role"]>0)
{
?>


<div class="row mm-container mm-container-back-insession">
    <div class="col-sm-2">
        <?php
            include_once("sidebar_menu.php");
        ?>
    </div> 
    <div class="col-sm-10 row_no_margin">
        <div class="row text-center">
            <h1>DASHBOARD</h1>
        </div>
        <div class="row">
            <div class="col-sm-4 text-center charts">
                <h4>INVENTARIO</h4>
                <br>
                <br>
                <img src="images/charts1.png">
            </div>
            <div class="col-sm-4 text-center charts">
                <h4>VENTAS</h4>
                <br>
                <br>
                <img src="images/charts2.png">
            </div>
            <div class="col-sm-4 text-center charts">
                <h4>PRODUCTOS VENDIDOS</h4>
                <br>
                <br>
                <img src="images/charts3.png">
            </div>
        </div>
    </div>
</div>

<?php
}
?>


<?php
include_once('../footer.php');
?>
