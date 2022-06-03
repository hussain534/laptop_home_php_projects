<?php
?>

<br>
<div class="row">
    <div class="col-sm-12 text-right sessionUserData">
            <?php
                if(isset($_SESSION["user_name"]))    
                {
                    echo '<span style="color:#00b0f0;font-weight:bold">BIENVENIDO</span><span style="color:#00b0f0"> :: '.strtoupper($_SESSION["user_name"]).'</span>.<br>';
                }
            ?>
    </div>
</div>