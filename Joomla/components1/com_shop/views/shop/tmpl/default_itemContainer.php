<?php

    defined('_JEXEC') or die('Restricted access');
    $doc=JFactory::getDocument();
    $doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
    include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;

    if(isset($_SESSION["userid"]))
    {
    	$session_time=$session_expirry_time;
    	if(isset($_SESSION['LAST_ACTIVITY']))
	    {
			if(($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
			{
				$url="index.php?view=shop&layout=userLogout&tipo=2";
				header("Location:$url"); 
			}
      else
                $_SESSION['LAST_ACTIVITY'] = time();
		}
		else
			$_SESSION['LAST_ACTIVITY'] = time();
	}

    if(isset($_GET["itemId"]))
        $itemId=$_GET["itemId"];
    else
        $itemId=0;

    $pageTitle='ITEM';
    //include_once('default_template.php');

    if (!empty($_SERVER["HTTP_CLIENT_IP"]))
    {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    else
    {
        $ip = $_SERVER["REMOTE_ADDR"];
    }

    $user_visit= isset($_SESSION['userid'])?$_SESSION['userid']:'Guest';
    $sqlVisit = "insert into rn_visits(ip,user_id,page_id,visited_on)
                values ('".$_SERVER['REMOTE_ADDR']."','".$user_visit."','".$pageTitle.':'.$itemId."',now())";
    mysqli_query($dbcon,$sqlVisit);

    if($DEBUG_STATUS)
    {
        echo 'Item Id::'.$itemId.'<br>';    
    } 

    if(isset($_POST['submitted']) and isset($_POST['user_comment']))
    {
        if($DEBUG_STATUS)
        {
            echo "Inside submitted comment<br>";
        }
        $sqlInsert = "insert into rn_comments(rn_user_id,rn_item_id,rn_comment_full,rn_created_on)
                      values('".$_SESSION["userid"]."',".$itemId.",'".$_POST['user_comment']."',now())";

        //echo $sqlInsert;
        if(mysqli_query($dbcon,$sqlInsert))
        { 
          #$_SESSION['userName']=$userName; 
          //$messsage='Commnets updated successfully'; 
          ?>

          <div class="col-sm-12">
                <?php 
                    echo "<div class='alert alert-success shopAlert'>";
                ?>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                    echo 'Comments updated successfully';
                    echo "</div>";
          ?>
          </div>
          <?php

        }
        else
        {
          ?>
              <div class="col-sm-12">
                <?php 
                    echo "<div class='alert alert-danger shopAlert'>";
                ?>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                    echo 'Error while updating comments. Please try later.';
                    echo "</div>";

              ?>
            </div>
            <?php
        }
    }

    //echo 'RATING::'.$_POST['user_rating'].'<br>';
    if(isset($_POST['submitted-rating']) and isset($_POST['user_rating']))
    {
        if($DEBUG_STATUS)
        {
            echo "Inside submitted rating<br>";
        }
        $sqlInsert = "insert into rn_ratings(rn_user_id,rn_item_id,rn_rating,rn_created_on)
                      values('".$_SESSION["userid"]."',".$itemId.",'".$_POST['user_rating']."',now())";

        //echo $sqlInsert;
        if(mysqli_query($dbcon,$sqlInsert))
        { 
          #$_SESSION['userName']=$userName; 
          //$messsage='Commnets updated successfully'; 
          ?>

          <div class="col-sm-12">
                <?php 
                    echo "<div class='alert alert-success shopAlert'>";
                ?>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                    echo 'Ratings updated successfully';
                    echo "</div>";
          ?>
          </div>
          <?php

        }
        else
        {
          ?>
              <div class="col-sm-12">
                <?php 
                    echo "<div class='alert alert-danger shopAlert'>";
                ?>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                    echo 'Error while updating ratings. Please try later.';
                    echo "</div>";

              ?>
            </div>
            <?php
        }
    }



    include_once('default_guestMainFilterPanel2.php');

?>

<?php
      if (isset($_SESSION['userRole']) and $_SESSION['userRole']==2)
      {
      ?>  
        <div class="container">  
            <div class="row">
                <div class="col-sm-12">
                  <div class="header">      
                  <div class="alert loginRegister">
                      <ul>
                          <li><a href='index.php?view=shop&amp;layout=userHome' class="userMenu-link"><span class='glyphicon glyphicon-home'></span> HOME</a></li>
                          <li><a href='index.php?view=shop&amp;layout=userProfile' class="userMenu-link"><span class='glyphicon glyphicon-user'></span> MY PROFILE</a></li>
                          <li><a href='index.php?view=shop&layout=manageCart' class="userMenu-link"><span class='glyphicon glyphicon-shopping-cart'></span> CHECKOUT</a></li>
                          <li><a href='index.php?view=shop&layout=orderHistory' class="userMenu-link"><span class='glyphicon glyphicon-list-alt'></span> ORDERS</a></li>
                      </ul>
                  </div>      
              </div>
                </div>
            </div>
        </div>     
        <?php
        } 
        else if (isset($_SESSION['userRole']) and $_SESSION['userRole']==3)
        {
        ?>    
        
       <div class="container">  
            <div class="row">
                <div class="col-sm-12">
                    <div class="header">        
                        <div class="alert loginRegister">
                      <ul>
                          <!-- <li><a href="index.php?view=shop&layout=userHome" class="userMenu-link"><span class='glyphicon glyphicon-home'></span> Home</a></li> -->
                          <li><a href="index.php?view=shop&layout=userProfile" class="userMenu-link"><span class='glyphicon glyphicon-user'></span> My Profile</a></li>
                          <li><a href="index.php?view=shop&layout=clientProfile" class="userMenu-link"><span class='glyphicon glyphicon-duplicate'></span> Client Profile</a></li>
                          <li><a href="index.php?view=shop&layout=manageItems&pagecount=0" class="userMenu-link"><span class='glyphicon glyphicon-th-list'></span> Client Items</a></li>
                          <li><a href="index.php?view=shop&layout=manageOffersForm" class="userMenu-link"><span class='glyphicon glyphicon-tag'></span> Offer</a></li>
                      </ul>
                  </div>      
              </div>
                </div>
            </div>
        </div>     
        <?php
        }       
    ?>

<!-- <input type="text" id="test" size="100">
<input type="text" id="test2" size="100"> -->


<div class="container"> 
  <div class="row">
    <br>
    <?php 
            $sql="select ri.rn_id,rc.rn_client_id,ri.rn_item_name,rc.rn_client_name,
            (select round((sum(rn_rating)/count(rn_item_id)),2) from rn_ratings where rn_item_id=".$itemId." group by rn_item_id) rn_rate,
            ri.rn_price,rc.rn_phone,
            rc.rn_mobile,rc.rn_tollFree,
            (select name from countries where id=rc.rn_country) rn_country,
            (select name from states where id=rc.rn_state) rn_state,
            (select name from cities where id=rc.rn_city) rn_city,
            (select description from rn_category where id=ri.rn_item_category) rn_item_category,
            (select description from rn_subcategory where id=ri.rn_subcategory) rn_item_subcategory,
            ri.rn_tags,rc.rn_address,rc.rn_latitude,rc.rn_longitude,ri.rn_item_desc,rn_offer,
            rn_offer_start_dt,rn_offer_end_dt,rn_website,rn_facebook from rn_items ri, rn_clients rc where 
            ri.rn_id=".$itemId." and ri.rn_client_id=rc.rn_client_id";

            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
                while($row = mysqli_fetch_assoc($result)) 
                {
                ?>
                  <div class="col-sm-3">
                      <div class="row">
                          <div class="col-sm-12 itemDtl mag" id="magid">
                            <!-- <a href=index.php?view=shop&layout=imageContainer&itemId=<?php echo $row["rn_id"];?>&clientCode=<?php echo $row["rn_client_id"];?> style="color:white;"> -->
                              <img class="img-responsive img-rounded " style="padding:10px" id="img0" data-toggle="magnify" src=<?php echo JURI::root().'media/com_shop/';?>images/clients/<?php echo $row["rn_client_id"].'/'.$row["rn_client_id"].'-'.$row["rn_id"].'.jpg'; ?> />
                            <!-- </a> -->
                          </div>
                          <div class="col-sm-12 itemDtl zoom" onclick ="imgWindow(<?php echo $row['rn_id'];?>,<?php echo $row["rn_client_id"];?>)">
                              <img src="media/com_shop/images/zoom4.png" style="padding:0;margin:10px;position:relative;top:-55px;right:-25px;width:45px;float:right">
                              <!-- <img src="media/com_shop/images/zoom1.png" style="padding:0;margin:10px;position:relative;top:-55px;left:-25px;width:45px" onclick ="imgWindow(<?php echo $row['rn_id'];?>,<?php echo $row["rn_client_id"];?>)"> -->
                              <!-- <span class='glyphicon glyphicon-zoom-in' style="color:red;padding:0;margin:10px;position:relative;top:-30px;left:-18px;" onclick ="imgWindow(<?php echo $row['rn_id'];?>,<?php echo $row["rn_client_id"];?>)"></span> -->
                          </div>
                         
                          <div class="col-sm-12 itemDtl">
                          		<div class="row">
			                         <?php
			                         	$filePattern='media/com_shop/images/clients/'.$row["rn_client_id"].'/'.$row["rn_client_id"].'-'.$row["rn_id"].'*.jpg';
            			 							//echo $filePattern;
            			 							$imgid=0;
            										foreach (glob($filePattern) as $filename) 
            										{
            											$imgid=$imgid+1;
            											?>								
            											<div class="imageClipBar" style="border:1px solid #9d9d9d;padding:0 2px;margin:1px;">
            				                  <img class="img-responsive img-rounded imgClips" src= <?php echo $filename; ?> id=img<?php echo $imgid;?> onclick="changeImg(<?php echo $imgid;?>);"/>
            											</div>
            									<?php							    
            										}
            									?>
            								</div>
            						  </div>

                          <div class="col-sm-12 itemDtl">
                            <p class="container-item-name" style="color:black;"><?php echo $row["rn_item_name"];?></p>
                          </div>
                          <div class="col-sm-12 itemDtl">
                            <p class="container-item-price" style="color:black;">$ <?php echo $row["rn_price"];?></p>
                          </div>
                          <div class="col-sm-12">
            								<div class="rating-01">
            								  <p class="container-item-rating">
            								      <?php 
            								        $rating_value =$row["rn_rate"];
            								        $rating_star_def=0.5;
            								        $rating_inicial = 0;                            
            								        while($rating_value > ($rating_star_def*$rating_inicial))
            								        {
            								            if($rating_inicial%2==0)
            								                echo "<img src='".JURI::root()."media/com_shop/images/star_left_fill.png' />";
            								            else
            								                echo "<img src='".JURI::root()."media/com_shop/images/star_right_fill.png' />";
            								            $rating_inicial = $rating_inicial+1;
            								        }
            								        while($rating_inicial<10)
            								        {
            								            if($rating_inicial%2==0)
            								                echo "<img src='".JURI::root()."media/com_shop/images/star_left_empty.png' />";
            								            else
            								                echo "<img src='".JURI::root()."media/com_shop/images/star_right_empty.png' />";
            								            $rating_inicial = $rating_inicial+1;  
            								        } 
            								      ?>
            								  </p>
            								</div>
            								<?php
            								  if (isset($_SESSION['userRole']) and $_SESSION['userRole']==2)
            								  {
            								?> 
            								<div class="rating-01">
            									<input type="range" id="myRange" value="0" max="5" min="0" step="0.25"  oninput="changeRating()">
            								</div>
            								<div class="rating-01">                                  
            								  <form  method="post" action=<?php echo 'http://'.$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];?>>
            								      <input type="hidden" name="submitted-rating" value="true" />
            								      <span id="rate">0</span>
            								      <input type="hidden" name="user_rating" id="rate_selected"/>
            								      <button type="submit" class="btn btn-success rate-button">Go</button>
            								  </form>
            								</div>
            								<?php     
            								  }
            								?>                              
            							</div> 							
                      </div>
                  </div>
                  <div class="col-sm-9 itemDtl">
                      <div class="row">
                          <?php
                            if (isset($_SESSION['userRole']) and $_SESSION['userRole']==2)
                            {
                          ?> 
                          <div class="col-sm-12 itemDtl">
                              <a href=index.php?view=shop&layout=addToCart&itemId=<?php echo $itemId;?> class="submit_button"><button type="button" class="btn btn-success">Add to Cart</button></a>
                          </div>
                          <?php
                        }
                        ?>
                          <div class="col-sm-12 itemDtl">
                              <label for="rn_item_desc">Description</label>
                              <textarea class="form-control" rows="25" readonly="true"><?php echo $row["rn_item_desc"]; ?></textarea>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                          <div class="col-sm-4 itemDtl">
                              <label for="rn_client_name">Client</label>
                              <input type="text" class="form-control" name="rn_client_name" value="<?php echo $row["rn_client_name"]; ?>" readonly="true">
                          </div>                          
                          <div class="col-sm-4 itemDtl">
                              <label for="rn_item_category">Category</label>
                              <input type="text" class="form-control" name="rn_item_category" value="<?php echo $row["rn_item_category"]; ?>" readonly="true">
                          </div>
                          <div class="col-sm-4 itemDtl">
                              <label for="rn_item_subcategory">Sub Category</label>
                              <input type="text" class="form-control" name="rn_item_subcategory" value="<?php echo $row["rn_item_subcategory"]; ?>" readonly="true">
                          </div>
              </div>
              <div class="row">
                          <div class="col-sm-4 itemDtl">
                              <label for="rn_tags">Tags</label>
                              <input type="text" class="form-control" name="rn_tags" value="<?php echo $row["rn_tags"]; ?>" readonly="true">
                          </div>
                          <div class="col-sm-4 itemDtl">
                              <label for="rn_phone">Phone</label>
                            <input type="text" class="form-control" name="rn_phone" value="<?php echo $row["rn_phone"]; ?>" readonly="true">
                          </div>
                          <div class="col-sm-4 itemDtl">
                              <label for="rn_mobile">Celular</label>
                            <input type="text" class="form-control" name="rn_mobile" value="<?php echo $row["rn_mobile"]; ?>" readonly="true">
                          </div>
              </div>
              <div class="row">
                          <div class="col-sm-4 itemDtl">
                              <label for="rn-website">Website</label>
                            <input type="text" class="form-control" name="rn_website" value="<?php echo $row["rn_website"]; ?>" readonly="true">
                          </div>
                          <div class="col-sm-4 itemDtl">
                              <label for="rn_facebook">Facebook</label>
                            <input type="text" class="form-control" name="rn_facebook" value="<?php echo $row["rn_facebook"]; ?>" readonly="true">
                          </div>
                          <div class="col-sm-4 itemDtl">
                              <label for="rn_tollFree">TollFree</label>
                            <input type="text" class="form-control" name="rn_tollFree" value="<?php echo $row["rn_tollFree"]; ?>" readonly="true">
                          </div>
              </div>
              <div class="row">
                          <div class="col-sm-12 itemDtl">
                              <label for="rn_offer">Offer Details</label>
                              <textarea class="form-control" rows="6" readonly="true"><?php echo $row["rn_offer"]; ?></textarea>
                          </div>
              </div>
              <div class="row">
                          <div class="col-sm-6 itemDtl">
                              <label for="rn_offer_start_dt">Offer Valid from</label>
                              <input type="text" class="form-control" name="rn_offer_start_dt" value="<?php echo $row["rn_offer_start_dt"]; ?>" readonly="true">
                          </div>
                          <div class="col-sm-6 itemDtl">
                              <label for="rn_offer_end_dt">Offer Valid Upto</label>
                              <input type="text" class="form-control" name="rn_offer_end_dt" value="<?php echo $row["rn_offer_end_dt"]; ?>" readonly="true">
                          </div>
              </div>
              <div class="row">
                          <div class="col-sm-4 itemDtl">
                              <label for="rn_country">Country</label>
                              <!-- <input type="text" class="form-control" size=25 name="rn_country" value=<?php echo $rn_country; ?> required> -->
                              <input type="text" class="form-control" size=25 name="rn_country" id="country-Id" value="<?php echo $row["rn_country"]; ?>" readonly="true">                              
                          </div>
                          <div class="col-sm-4 itemDtl">
                              <label for="rn_state">State</label>
                              <input type="text" class="form-control" size=25 name="rn_state" id="state-Id" value="<?php echo $row["rn_state"]; ?>" readonly="true">
                          </div>
                          <div class="col-sm-4 itemDtl">
                              <label for="rn_city">City</label>
                              <input type="text" class="form-control" size=25 name="rn_city" id="city-Id" value="<?php echo $row["rn_city"]; ?>" readonly="true">
                          </div>
              </div>
              <div class="row">                      
                          <div class="col-sm-4 itemDtl">
                              <label for="rn_address">Address</label>
                              <input type="text" class="form-control" name="rn_address" value="<?php echo $row["rn_address"]; ?>" readonly="true">
                          </div>                                                              
                          <div class="col-sm-4 itemDtl">
                              <label for="rn_latitude">Latitude</label>
                              <input type="text" class="form-control" size=25 name="rn_latitude" id="rn_latitude" value="<?php echo $row["rn_latitude"]; ?>" readonly="true">
                          </div>
                           <div class="col-sm-4 itemDtl">
                              <label for="rn_longitude">Longitude</label>
                              <input type="text" class="form-control" size=25 name="rn_longitude" id="rn_longitude" value="<?php echo $row["rn_longitude"]; ?>" readonly="true">
                          </div>
              </div>
              <div class="row">                          
                          <div class="col-sm-12 itemDtl">
                                <!-- <label for="rn_longitude">MAP URL</label> -->
                              <div id="mapholder">                                            
                              </div>
                          </div>
              </div>

              <br>

              <?php
                if (isset($_SESSION['userRole']) and $_SESSION['userRole']==2)
                {
              ?> 
                    <form  method="post" action=<?php echo 'http://'.$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];?>>
                        <input type="hidden" name="submitted" value="true" />
                        <div class="row">                          
                              <div class="col-sm-12 itemDtl">                                                    
                                  <label for="user_comment"><?php echo $_SESSION['userName']; ?></label>
                                  <textarea class="form-control" rows="2" name="user_comment" placeholder="Write your comments!"></textarea>                            
                              </div>
                        </div>
                        <div class="row">                          
                              <div class="col-sm-5 itemDtl">
                              </div>
                              <div class="col-sm-2 itemDtl">
                                  <button type="submit" class="btn btn-success">SUBMIT COMMENTS</button>
                              </div>
                              <div class="col-sm-5 itemDtl">
                              </div>
                        </div>
                    </form>
              <?php
                }
              ?>
              <div class="row">
                  <div class="col-sm-12">
                      <p class="sectionHeader">COMMENTS</p>       
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-12">
                      <?php 
                              $sql="select ru.ru_username, rc.rn_comment_full,rc.rn_created_on from rn_items ri, rn_usuario ru,rn_comments rc where                 
                              ri.rn_id=".$itemId." and ri.rn_id=rc.rn_item_id and rc.rn_user_id=ru.ru_userid order by rc.rn_created_on desc limit 0,50";

                              $result = mysqli_query($dbcon,$sql);
                              if(mysqli_num_rows($result) > 0)  
                              {
                                  while($row = mysqli_fetch_assoc($result)) 
                                  {
                                      ?>
                                      <div class="col-sm-12 itemDtl2">
                                          <label for="rn_comment_full"><?php echo $row["ru_username"].'('.$row["rn_created_on"].')'; ?></label>
                                          <textarea class="form-control" rows="2" readonly="true"><?php echo $row["rn_comment_full"]; ?></textarea>
                                      </div>
                                  <?php
                                  }
                              }
                                  ?>
                  </div>
              </div>

<script>
    function imgWindow(imgId,clientId) 
    {
        var w = screen.width;
        if(w>=680)
           window.open("index.php?view=shop&layout=imageContainer&itemId="+imgId+"&clientCode="+clientId, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=0, left=0, width=1200, height=600");
        else if(w>=350 && w<680)
            window.open("index.php?view=shop&layout=imageContainer&itemId="+imgId+"&clientCode="+clientId, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=0, left=0, width=600, height=600");
        else if(w<350)
            window.open("index.php?view=shop&layout=imageContainer&itemId="+imgId+"&clientCode="+clientId, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=0, left=0, width=300, height=600");
        
    }
</script>
  
                <?php
                }
            }
        ?>
      
  </div>
  
</div>