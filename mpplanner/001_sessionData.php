<div class="row sessionUserData">
    <div class="col-sm-12 text-left">
            <?php
                if(isset($_SESSION["user_name"]))    
                {
                    echo '<span style="color:ivory">'.strtoupper($_SESSION["user_name"]).'</span><span style="color:ivory"> ('.strtoupper($_SESSION["user_profile_name"]).')</span>.<br>';
                }
            ?>
    </div>
</div>