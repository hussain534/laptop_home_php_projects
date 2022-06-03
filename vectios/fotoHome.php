<?php
  defined('__JEXEC') or ('Access denied');
  include_once('config.php'); 
  //require 'dbcontroller.php';
  require_once('dbcontroller.php');
  $controller = new controller();
?>

<div class="container fotos" id="myfotos">  
    <div class="row" id="fotoPanel">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                    	<div class="col-sm-1">
                    	</div>
                    	<div class="col-sm-6 text-left">
					        <?php
					        $gallery = $controller->getGalleryForHomePage($databasecon,false);
					        if(isset($gallery) && count($gallery)>0)
					        {
					        ?>
					        <div id="myCarousel" class="carousel bounce" data-interval="5000" data-pause="hover" data-ride="carousel">
					        <!-- Wrapper for slides -->
					            <div class="carousel-inner" role="listbox" style="height:450px">
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
					                    <img src=<?php echo $gallery[$x][4];?> alt=<?php echo $caption;?>  style="height:450px">
					                    <!-- <div class="carousel-caption">
					                        <h3 style="margin:2px"><?php echo $caption;?></h3>
					                        <p><?php echo $desc;?></p>
					                    </div>  -->
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
					        <?php
					        }                     
					        ?>
					    </div>
					    <div class="col-sm-4">
					    	<br>
					    	<br>
					    	<p class="text-center commentPanelTitle fotoPanelTitle">Momentos para recordar...</p>
                    	</div>
                    	<div class="col-sm-1">
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>