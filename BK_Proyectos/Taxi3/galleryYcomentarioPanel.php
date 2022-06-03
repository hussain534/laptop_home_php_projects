<div class="row">
    <div class="col-sm-12" id="grad_white">
        <div class="row">
            <div class="col-sm-6 text-center">
                <?php 
                    $gallery = $controller->getGalleryByUserId($databasecon,$viajeId,$_SESSION["userid"],$DEBUG_STATUS);
                    include_once('gallery.php');
                ?>
            </div>
            <div class="col-sm-6">
                <?php 
                    $comments = $controller->getCommentsByUserId($databasecon,$viajeId,$_SESSION["userid"],$DEBUG_STATUS);
                    include_once('comentarios.php');
                ?>
            </div>
        </div>
    </div>
</div>