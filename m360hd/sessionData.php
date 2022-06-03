<?php
?>

<br>
<div class="row">
    <div class="col-sm-6 text-left sessionUserData">
            <?php
                if(isset($_SESSION["user_name"]))    
                {
                    echo '<span style="color:#00b0f0;font-weight:bold">BIENVENIDO</span><span style="color:#00b0f0"> :: '.strtoupper($_SESSION["user_name"]).'</span>.<br>';
                }
            ?>
    </div>
    <div class="col-sm-6 text-right sessionUserData">
            <form method="post" action="controller.php?controller=4&task=0">
                <input type="hidden" name="busquedaBtnValue" id="busquedaBtnValue" value="1">
                <div class="row">
                    <div class="col-sm-11 inputData text-right">
                        <input type="text" class="form-control form-control-rounded searchItem" id="searchParam" name="searchParam" placeholder="Ingresa palabras separados con ; para buscar. Ejemplo: cpu;stress" />
                    </div>
                    <div class="col-sm-1 inputData text-left">
                        <button type="submit" class="btn btn-success;" style="background: #3caea3;"><span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </div>
            </form>
    </div>
</div>