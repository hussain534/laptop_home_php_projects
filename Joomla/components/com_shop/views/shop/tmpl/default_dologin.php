<?php

	defined('_JEXEC') or die('Restricted access');
	$doc=JFactory::getDocument();
	$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
	include_once('default_catalogs.php'); 
    $dbcon = $databsecon;
    $products_per_page=$items_per_page;
    $DEBUG_STATUS = $PRINT_LOG;

    $err_code=0;

    $session_time=$session_expirry_time;
	if(isset($_SESSION['LAST_ACTIVITY']))
    {
		if(($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
		{
			$url="index.php?view=shop&layout=userlogout&tipo=2";
			header("Location:$url"); 
		}
        else
              $_SESSION['LAST_ACTIVITY'] = time();
	}
	else
		$_SESSION['LAST_ACTIVITY'] = time();

        
    if(isset($_POST['submitted']))
    {

        if(isset($_POST['activity']))
        {
            if(isset($_POST['userId']))
                $userId= $_POST['userId'];
            $userName = $_POST['userName'];
            $pwd = $_POST['pwd'];
            $cnfPwd = $_POST['cnfPwd'];
            $emailId = $_POST['emailId'];
            $mobile = $_POST['mobile'];
            $userType = $_POST['userType'];

            if(strcmp($pwd,$cnfPwd)==0)
            {
                #echo "Passwords match";  
                $sql = "INSERT INTO rn_usuario VALUES('$userId','$userName',$userType,0,'$emailId','$mobile',now(),now(),'$userId','$userId','0')";
                if(mysqli_query($dbcon,$sql))
                {
                    $sql = "INSERT INTO rn_login(RN_USERID,RN_PWD, RN_FAILED_ATTEMPTS, RN_FIRST_LOGIN,RN_USER_BLOCKED) 
                    VALUES('$userId','$pwd',0,'Y','N')";
                    if(mysqli_query($dbcon,$sql))
                    {
                        $messsage = "Congratulations! Your details registered successfully";
                        //mysqli_close($dbcon);  
                        $err_code=0;     
                    }
                    else
                    {
                        $err_code=4;
                        //mysqli_close($dbcon);
                        $messsage= "Error registering your details. Try again later.";
                    }                
                }
                else
                {
                    $err_code=4;
                    //mysqli_close($dbcon);
                    $messsage= "Error registering your details. Try again later.";
                }  

                if($err_code==4)
                {
                    if(strlen($userId)>0)
                    {
                        $sql = "SELECT ru_userid, ru_username,ru_credits, ru_roleid,ru_mobile FROM rn_usuario, rn_login 
                                WHERE ru_userid='".$userId."' and ru_userid=rn_userid";
                        $result = mysqli_query($dbcon,$sql);
                        if(mysqli_num_rows($result) > 0)  
                        {
                            //$err_code=0;
                            if($row = mysqli_fetch_assoc($result)) 
                            {
                                //mysqli_close($dbcon);
                                $err_code=4;
                                $messsage= "User Already exists.Use other user id.";
                            }
                        }
                    }
                }   
            }
            else
            {
                $err_code=4;
                $messsage= "Passwords mismatch. Please fill correct details.";   
            }  
        }

        if($err_code==0)
        {
            $userId= $_POST['userId'];
            $pwd = $_POST['pwd'];
            if($DEBUG_STATUS)
            {
                echo "Inside submitted check<br>";
                echo "$userId | $pwd<br>";
            }
            if(!isset($_SESSION["userid"]))
            {
            	if($DEBUG_STATUS)
            	{
            		echo 'creating session<br>';	
            	}
                
                if(strlen($userId)>0)
                {
                	$sql = "SELECT ru_userid, ru_username,ru_email_id,ru_credits, ru_roleid,ru_mobile FROM rn_usuario, rn_login
                            WHERE ru_userid='".$userId."' and rn_pwd='".$pwd."' and ru_userid=rn_userid";
                    if($DEBUG_STATUS)
                    {
                        echo 'SQL:'.$sql.'<br>';    
                    }    
                    $result = mysqli_query($dbcon,$sql);
                    if(mysqli_num_rows($result) > 0)  
                    {
                        $err_code=0;
                        if($row = mysqli_fetch_assoc($result)) 
                        {
                            if($DEBUG_STATUS)
                            {
                                echo "User Name: ".$row["ru_username"]."<br>";
                                echo "User Role: ".$row["ru_roleid"]."<br>";
                            }

                            $sql = "UPDATE rn_login SET rn_last_login=now(), rn_user_in_use='Y' where rn_userid='".$userId."' and rn_pwd='".$pwd."'";
                            if(mysqli_query($dbcon,$sql))
                            {
                                //$messsage = "Welcome ".$row["ru_username"]."!! Enjoy the world of products.";
                                
                                $_SESSION['userid']=$userId;
                                $_SESSION['userName']=$row["ru_username"];
                                $_SESSION['userRole']=$row["ru_roleid"];
                                $_SESSION['userEmail']=$row["ru_email_id"];
                                $_SESSION['userContact']=$row["ru_mobile"];

                                $sql = "SELECT rn_client_id FROM rn_clients where rn_user_id='".$userId."'";
                                $result = mysqli_query($dbcon,$sql);
                                if(mysqli_num_rows($result) > 0)  
                                {
                                    if($row = mysqli_fetch_assoc($result)) 
                                    {
                                        $err_code=0;
                                        $_SESSION['clientid']=$row["rn_client_id"];    
                                    }
                                    
                                }
                                
                                #$_SESSION['loggedin_time'] = time();
                                #mysqli_close($dbcon);    
                                $err_code=0;
                            }
                            else
                            {
                                $err_code=1;
                                mysqli_close($dbcon);
                                $messsage= "Error in login. Try again later.";
                            }
                        }      
                    }
                    else
                    {
                        $err_code=1;
                        mysqli_close($dbcon);
                        $messsage= "Invalid credentials or you are accessing this page directly. Try with correct login details.";
                    } 
                    if($DEBUG_STATUS)
                    {
                    	echo "ERR_CODE::$err_code<br>";                   	
                    }
                    
                }
                else
                {
                	if($DEBUG_STATUS)
                	{
                		echo 'inside else <br>';	
                	}
                    
                    $err_code=1;
                    $messsage= "Invalid User";   
                }      
            }
        }
    }

    if($err_code==1)
    {
        $url="index.php?view=shop&layout=userlogout&tipo=3";
    }
    else if(isset($_SESSION['userRole']) and $_SESSION['userRole']==3)
    {
        $url = "index.php?view=shop&layout=userprofile";
    }
    else if(isset($_SESSION['userRole']) and $_SESSION['userRole']==2)
    {
        $url = "index.php?view=shop&layout=userhome";
    }
    else if(isset($_SESSION['userRole']) and $_SESSION['userRole']==99)
    {
        $url = "index.php?view=shop&layout=adminorderhistory";
    }  
    else if($err_code==4)
    {
        $url="index.php?view=shop&layout=userlogout&tipo=4&msg='".$messsage."'";
    }
    if($DEBUG_STATUS)   
        echo $url;
    $_SESSION["session_msg"]=$messsage;
    header("Location:$url"); 
?>
