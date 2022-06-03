<?php  
if(isset($message)) 
{
?>
<div class="row">
    <div class="col-sm-12">
        <div class='alert alert-success shopAlert'>
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php  echo $message; ?>
         </div>
    </div>
</div>
<?php
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
    		<div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <?php 
                        if(isset($usrDtl[6]) && file_exists($usrDtl[6]))
                        {
                        ?>
                            <center><img src=<?php echo $usrDtl[6];?> class="profileImage" style="width:300px;height:300px;box-shadow: 6px 6px 6px grey;"/></center>
                            <center><div class="pic_desc text-center">
                                <?php echo $usrDtl[1]; ?>
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                    <?php
                                         $usrRating = $controller->getCoductorRating($databasecon,$userId,$DEBUG_STATUS);
                                        if(isset($usrRating) && count($usrRating)>0)
                                        {
                                    ?>      <!-- <b>Calificacion Conductor :(<?php echo $usrRating;?>)</b> -->
                                            <div class="rating-01">
                                                <p class="container-item-rating">
                                                    <?php 
                                                    $rating_value =$usrRating;
                                                    $rating_star_def=0.5;
                                                    $rating_inicial = 0;                            
                                                    while($rating_value > ($rating_star_def*$rating_inicial))
                                                    {
                                                        if($rating_inicial%2==0)
                                                            echo "<img src='images/star_left_fill.png' />";
                                                        else
                                                            echo "<img src='images/star_right_fill.png' />";
                                                        $rating_inicial = $rating_inicial+1;
                                                    }
                                                    while($rating_inicial<10)
                                                    {
                                                        if($rating_inicial%2==0)
                                                            echo "<img src='images/star_left_empty.png' />";
                                                        else
                                                            echo "<img src='images/star_right_empty.png' />";
                                                        $rating_inicial = $rating_inicial+1;  
                                                    } 
                                                    ?>
                                                </p>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <?php                                                                
                                            $getCoductorRatingByUser = $controller->getCoductorRatingByUser($databasecon,$userId,$viajeId,$_SESSION["userid"],$DEBUG_STATUS);
                                            if(isset($getCoductorRatingByUser) && count($getCoductorRatingByUser)>0)
                                            {                                                                
                                                echo 'Tu Calificaste :('.$getCoductorRatingByUser.')';
                                            ?>
                                                <div class="rating-01">
                                                    <p class="container-item-rating">
                                                        <?php 
                                                        $rating_value =$getCoductorRatingByUser;
                                                        $rating_star_def=0.5;
                                                        $rating_inicial = 0;                            
                                                        while($rating_value > ($rating_star_def*$rating_inicial))
                                                        {
                                                            if($rating_inicial%2==0)
                                                                echo "<img src='images/star_left_fill.png' />";
                                                            else
                                                                echo "<img src='images/star_right_fill.png' />";
                                                            $rating_inicial = $rating_inicial+1;
                                                        }
                                                        while($rating_inicial<10)
                                                        {
                                                            if($rating_inicial%2==0)
                                                                echo "<img src='images/star_left_empty.png' />";
                                                            else
                                                                echo "<img src='images/star_right_empty.png' />";
                                                            $rating_inicial = $rating_inicial+1;  
                                                        } 
                                                        ?>
                                                    </p>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                            </div></center>
                        <?php
                        }
                        else
                        {
                            ?>
                            <center><img src=images/unknown_user.png class="profileImage"/></center>
                            <?php
                        }   
                        ?> 
                    </div>
                </div>
                

                <div class="row">
                    <div class="col-sm-12 text-center">
                         <div class="col-sm-12">
                            <div class="rating-01">
                                <input type="range" id="myRange" value="0" max="5" min="0" step="0.25"  oninput="changeRating()">
                            </div>
                            <div class="rating-01">
                                <form  method="post" action="">
                                    <input type="hidden" name="submitted-rating" value="true" />
                                    <input type="hidden" id="conductorID" value=<?php echo $userId;?>>
                                    <input type="hidden" id="viajeID" value=<?php echo $viajeId;?>>
                                    <span id="rate" class="badge">0</span>
                                    <input type="hidden" name="user_rating" id="rate_selected"/>
                                </form>
                            </div>
                            <br>
                            <br>
                             <div class="rating-01">
                                <button type="button" id="btnSumbitConductorCalificacion" class="btn btn-sm btn-success rate-button">CALIFICAR CONDUCTOR</button>
                            </div>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
    		</div>
    		<div class="col-sm-6">
    			<?php
                    $vehDtl = $controller->getVehicleDetailsById($databasecon,$userId,$vehId,$DEBUG_STATUS);
                    for($x=0;$x<count($vehDtl);$x++)
                    {
                        if(isset($vehDtl[$x][7]) && file_exists($vehDtl[$x][7]))
                        {
                        ?>
                            <center><img src=<?php echo $vehDtl[$x][7];?> class="docImage" style="width:300px;height:300px;box-shadow: 6px 6px 6px grey;" /></center>
                            <center><div class="pic_veh_desc text-center">
                                <?php echo strtoupper($vehDtl[$x][1]).' - '.strtoupper($vehDtl[$x][2]).'('.strtoupper($vehDtl[$x][3]).')'; ?>
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                    <?php
                                         $vehRating = $controller->automovilRating($databasecon,$vehId,$DEBUG_STATUS);
                                        if(isset($vehRating) && count($vehRating)>0)
                                        {
                                    ?>      <!-- <b>Calificacion Conductor :(<?php echo $vehRating;?>)</b> -->
                                            <div class="rating-01">
                                                <p class="container-item-rating">
                                                    <?php 
                                                    $rating_value =$vehRating;
                                                    $rating_star_def=0.5;
                                                    $rating_inicial = 0;                            
                                                    while($rating_value > ($rating_star_def*$rating_inicial))
                                                    {
                                                        if($rating_inicial%2==0)
                                                            echo "<img src='images/star_left_fill.png' />";
                                                        else
                                                            echo "<img src='images/star_right_fill.png' />";
                                                        $rating_inicial = $rating_inicial+1;
                                                    }
                                                    while($rating_inicial<10)
                                                    {
                                                        if($rating_inicial%2==0)
                                                            echo "<img src='images/star_left_empty.png' />";
                                                        else
                                                            echo "<img src='images/star_right_empty.png' />";
                                                        $rating_inicial = $rating_inicial+1;  
                                                    } 
                                                    ?>
                                                </p>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <?php                                                                
                                            $getVehicleRatingByUser = $controller->getVehicleRatingByUser($databasecon,$vehId,$viajeId,$_SESSION["userid"],$DEBUG_STATUS);
                                            if(isset($getVehicleRatingByUser) && count($getVehicleRatingByUser)>0)
                                            {                                                                
                                                echo 'Tu Calificaste :('.$getVehicleRatingByUser.')';
                                            ?>
                                                <div class="rating-01">
                                                    <p class="container-item-rating">
                                                        <?php 
                                                        $rating_value =$getVehicleRatingByUser;
                                                        $rating_star_def=0.5;
                                                        $rating_inicial = 0;                            
                                                        while($rating_value > ($rating_star_def*$rating_inicial))
                                                        {
                                                            if($rating_inicial%2==0)
                                                                echo "<img src='images/star_left_fill.png' />";
                                                            else
                                                                echo "<img src='images/star_right_fill.png' />";
                                                            $rating_inicial = $rating_inicial+1;
                                                        }
                                                        while($rating_inicial<10)
                                                        {
                                                            if($rating_inicial%2==0)
                                                                echo "<img src='images/star_left_empty.png' />";
                                                            else
                                                                echo "<img src='images/star_right_empty.png' />";
                                                            $rating_inicial = $rating_inicial+1;  
                                                        } 
                                                        ?>
                                                    </p>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                            </div></center>
                        <?php
                        }
                        else
                        {
                        ?>
                            <center><img src=images/imageNotAvailable.png class="docImage"/></center>
                            <p style="text-align:center"><?php echo $vehDtl[$x][1];?></p>
                        <?php
                        }
                    }
                ?>
                <div class="row">
                    <div class="col-sm-12 text-center">
                         <div class="col-sm-12">
                            <div class="rating-01">
                                <input type="range" id="myRangeVeh" value="0" max="5" min="0" step="0.25"  oninput="changeRatingVehicle()">
                            </div>
                            <div class="rating-01">
                                <form  method="post" action="">
                                    <input type="hidden" name="submitted-rating" value="true" />
                                    <input type="hidden" id="vehicleID" value=<?php echo $vehId;?>>
                                    <input type="hidden" id="viajeID" value=<?php echo $viajeId;?>>
                                    <span id="rate_veh" class="badge">0</span>
                                    <input type="hidden" name="user_rating" id="rate_veh_selected"/>
                                </form>
                            </div>
                            <br>
                            <br>
                             <div class="rating-01">
                                <button type="button" id="btnSumbitVehicleCalificacion" class="btn btn-sm btn-success rate-button">CALIFICAR AUTOMOVIL</button>
                            </div>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
		</div>
    </div>
</div>