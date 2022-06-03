<?php

    defined('_JEXEC') or die('Restricted access');
    $doc=JFactory::getDocument();
    $doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
    include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;
    
    $pageTitle='CONT';
    //include_once('default_template.php');
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
                values ('".$_SERVER['REMOTE_ADDR']."','".$user_visit."','".$pageTitle."',now())";
    mysqli_query($dbcon,$sqlVisit);
include_once('default_guestMainFilterPanel2.php');

$doc->addStyleSheet('https://fonts.googleapis.com/css?family=Courgette');


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


<div class="container"> 
  <div class="row">
    <div class="col-sm-12">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7960809312613!2d-78.48480259007394!3d-0.19130350233257037!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91d59a64553aad7f%3A0x96925c4067198d34!2sMerakiMinds+Cia+Ltds!5e0!3m2!1ses!2sin!4v1455158626490" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
  </div>
</div>

<div class="row" style="margin:0 !important;">
    <div class="col-sm-12 mydiv8 font-01">
      <div class="subdiv" style="padding:20px !important;">
        <h2 style="text-align:center;">Contact Us</h2>
      </div>  
    </div>
  </div>

<form method="post" action="index.php?view=shop&amp;layout=submitContact">
  <input type="hidden" name="submitted" value="true" />
  <div class="container-fluid text-center font-01">
    <div class="row">
      <div class="col-sm-6">
          <h3>MerakiMinds Cia Ltds</h3>
          <h4>Rumania E5-76 y Polonia,<br>Quito 170135,Ecuador,<br>+593 2-250-0970,<br>www.merakiminds.com</h4>
      </div>
      <div class="col-sm-6">
        <?php 
          if(isset($_SESSION["contact_sent"]))
          {
           echo $_SESSION["contact_sent"]; 
           unset($_SESSION["contact_sent"]);
          }
        ?>
        <div class="inner-addon left-addon" style="margin-bottom:5px">
          <span class="glyphicon glyphicon-user"></span>
          <input type="text" class="form-control" id="contact_user" name="contact_user" placeholder="Enter your name here" required autofocus>
        </div>
        <div class="inner-addon left-addon" style="margin-bottom:5px">
          <span class="glyphicon glyphicon-envelope"></span>
          <input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="Enter your e-mail here" required>
        </div>
        <div class="inner-addon left-addon" style="margin-bottom:5px">
          <span class="glyphicon glyphicon-pencil"></span>
          <textarea class="form-control" id="msg" name="contact_msg" placeholder="Enter your message here" rows="2" required></textarea>
        </div>
        <button type="submit" class="btn btn-info"  style="margin:5px" onclick="return validateEmail();">Submit</button>
      </div>
    </div>
    <br>    
  </div>
</form>
<script>
  function validateEmail() 
    {
        //alert("HI");
        var x = document.getElementById("contact_email").value;
        var atpos = x.indexOf("@");
        var dotpos = x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
            alert("Please enter valid e-mail address");
            return false;
        }
        else
            return true;
}
</script>