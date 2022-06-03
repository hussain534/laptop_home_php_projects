<br>
<div class="row">
    <div class="col-sm-12 text-center">        
        <h2 style="color:crimson;margin:5px">GALLERY</h2>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12 text-left">
        
        <?php
        echo '<h5>'.count($gallery).' fotos encontrados</h5>';

        if(isset($gallery) && count($gallery)>0)
        {
        ?>
        <div id="myCarousel" class="carousel slide" data-interval="5000" data-pause="hover" data-ride="carousel">
        <!-- Indicators -->
            <!-- <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li> 
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li> 
            </ol> -->

        <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php 
                for($x=0;$x<count($gallery);$x++)
                {
                    $caption=$gallery[$x][2];
                    $desc=$gallery[$x][3];
                    $uploadedBy=$gallery[$x][5];
                    $uploadedOn=$gallery[$x][6];
                    if($x==0)
                    {
                ?>
                <div class="item active">
                <?php
                    }
                    else
                    {
                ?>
                <div class="item">
                <?php
                    }
                ?>
                    <img src=<?php echo $gallery[$x][4];?> alt=<?php echo $caption;?>>
                    <div class="carousel-caption">
                        <h3 style="margin:2px"><?php echo $caption;?></h3>
                        <p><?php echo $desc;?></p>
                    </div> 
                </div>                                           
                <?php
                }
                ?>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <br>
            <?php
            
            if(isset($gallery) && count($gallery)>0)
            {
                for($y=0;$y<count($gallery);$y++)
                {
            ?>
            <img src=<?php echo $gallery[$y][4];?> width="92" height="70" onclick=displayGalleryImg(<?php echo $y;?>)>

            <?php
                }
            }                 
            ?>
        <br>
        <br>
    
        <?php
        }                     
        ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12"  style="padding:10px">
        <div class="row">
            <div class="col-sm-12">
                <h4><span class="label label-primary" id="btnActualizarGaleria">COMPARTIR FOTOS DE VIAJE</span></h4>
            </div>
            <div class="col-sm-12"  id="panelGaleria">
                <div class="row">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">                                                
                        <form method="post" action="addImageToGallery.php" enctype="multipart/form-data">
                            <input type="hidden" name="submitted" value="true" />
                            <input type="hidden" name="viajeIDGallery" value=<?php echo $viajeId;?>>
                            <center><img src="images/unknown_user.png" id="uploadImg" class="galleryUploadImage"/></center>
                            <center><input type="file" name="fileToUpload" id="fileToUpload" required>   
                            <!-- <label for="imgId">Upload </label> -->
                            <p>Editar su imagenes online : <b><a href="https://pixlr.com/editor" style="color:blue">PIXLR ONLINE</a> </b></p></center>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="img_caption" value="" placeholder="Ingresar titulo de imagen" required>
                            </div>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="img_desc" value="" placeholder="Ingresar descripcion de imagen" required>
                            </div>
                            <div class="col-sm-12">
                            <p style="color:green">NOTA:Se acceptan que los fotos que se suben aqui, son propiedades de plataforma y 
                            podemos usarlo para mostrar en cualquier pagina de este sitio </p>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">SUBMIT<span class="glyphicon glyphicon-chevron-right"></span></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>