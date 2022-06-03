<div class="row">
    <div class="col-sm-12 text-left sessionUserData">
            <?php
                if(isset($_SESSION["user_name"]))    
                {
                    echo '<span style="color:#ae1c1f;font-weight:bold">WELCOME</span><span style="color:#ae1c1f"> :: '.strtoupper($_SESSION["user_name"]).'</span><span style="color:#ae1c1f"> ('.strtoupper($_SESSION["user_profile_name"]).')</span>.<br>';
                }
            ?>
    </div>
</div>