<?php
?>
<div class="row">
    <div class="col-sm-12 text-left sessionUserData">
            <?php
                if(isset($_SESSION["user_name"]))    
                {
                    echo '<span style="color:#ae1c1f;font-weight:bold">BIENVENIDO</span><span style="color:#ae1c1f"> :: '.strtoupper($_SESSION["user_name"]).'</span><span style="color:#ae1c1f"> ('.strtoupper($_SESSION["perfil_nombre"]).')</span><br>';
                    //echo '<span style="color:#ae1c1f;font-weight:bold">BIENVENIDO</span><span style="color:#ae1c1f"> :: '.strtoupper($_SESSION["user_name"]).'</span><span style="color:#ae1c1f"> ('.strtoupper($_SESSION["perfil_nombre"]).')</span> <a href="controladorProceso.php?proceso=0&task=999"> <span class="glyphicon glyphicon-trash"></span></a><br>';
                }
            ?>
    </div>
    <!-- <div class="col-sm-6 text-right sessionUserData">
            <form method="post" action="controladorProceso.php?proceso=4&task=0">
                <input type="hidden" name="busquedaBtnValue" id="busquedaBtnValue" value="1">
                <div class="row">
                    <div class="col-sm-11 inputData text-right">
                        <input type="text" class="form-control form-control-rounded searchItem" id="searchParam" name="searchParam" placeholder="Ingresar palabras separados con ; para buscar. Ejemplo: ruc;nombre; etc" />
                    </div>
                    <div class="col-sm-1 inputData text-left">
                        <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </div>
            </form>
    </div> -->
</div>