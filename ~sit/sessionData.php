<?php
?>

<br>
<div class="row">
    <div class="col-sm-12 text-right sessionUserData">
            <?php
                if(isset($_SESSION["user_name"]))    
                {
                    echo '<span style="color:#00b0f0;font-weight:bold">BIENVENIDO</span><span style="color:#00b0f0"> :: '.strtoupper($_SESSION["user_name"]).'</span>.<a href="controller.php?controller=0&task=2" style="background: cornflowerblue;
    padding: 4px 2px 3px;border-radius:4px;margin-left:20px">
          <span class="glyphicon glyphicon-cog"></span>
        </a><br>';
                }
            ?>
    </div>
</div>