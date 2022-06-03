<?php
    error_reporting(E_ALL);
    ini_set('display_errors','1');

    set_time_limit(0);
    ini_set('memory_limit', '-1');

    include_once('util.php');
    include_once('header.php');
    include_once('config.php');
    $databasecon = $databasecon;
    $consultas = "select * from person";
?>


<div class="container" style="min-height:700px"> 
    <div class="row pageTitle">
        <div class="col-sm-12">
            MENU
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center">
            <?php
                if(isset($_SESSION["res_code"]))
                {
            ?>
                    <div class="alert alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $_SESSION["res_code"];?>
                    </div>
            <?php
                    unset($_SESSION["res_code"]);
                }
            ?>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <?php
        $mensaje ="";
        $lista_querys = explode(";",$consultas);
        $cantQuery = count($lista_querys);
        $contQuery = 0;
        $cantRegXQuery =0;
        $tiemp_ini = microtime(true);
        while ($contQuery<$cantQuery)
        {
            $cantRegXQuery =0;
            if (isset($lista_querys[$contQuery]) && $lista_querys[$contQuery]!="" && $lista_querys[$contQuery] !=" ")
            {
                $result = mysqli_query($databasecon,$lista_querys[$contQuery]);
                $cabecera=0;
                while ($row = mysqli_fetch_assoc($result)) 
                {
                    ?>
                    <div class="row data-grid">
                    <?php
                    $contaCampos = 1;
                    $cantRegXQuery++;
                    $cantCampos = count($row);
                    $contaCampos = 1;
                    $Keyvalues = array_values($row);
                    $Keycampos = array_keys($row);
                    while($contaCampos <=$cantCampos)
                    {
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2">
                                <?php echo $Keycampos[$contaCampos-1];?>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value='<?php if(!empty($Keyvalues[$contaCampos-1])) echo $Keyvalues[$contaCampos-1];?>' readonly="true">
                            </div>
                        </div>
                        <?php

                        $contaCampos= $contaCampos+1;
                    }
                    ?>
                    </div>
                    <?php
                }
                $tiemp_fin = microtime(true);
                $tiempo = $tiemp_fin - $tiemp_ini;
            } 
        $contQuery++;
        }
    ?>
</div>


<?php
function startsWith ($string, $startString) 
{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
}
?>