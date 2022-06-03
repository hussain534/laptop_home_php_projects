<?php
/*if(session_status() == PHP_SESSION_NONE)
    session_start();*/
    class model_session
    {
        public function login_user($dbcon,$user_email,$user_password,$DEBUG_STATUS)
        {
            $sql="select m.id userid, m.name user_name,m.email,m.password,m.role,m.id_branch,m.client_registration_id 
                    from mod_session_user m
                    where m.email = '".$user_email."' and m.enabled=1 ";
            $updStatus=1;
            mysqli_autocommit($dbcon,FALSE);
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {                
                if($row = mysqli_fetch_assoc($result)) 
                {
                    $userId = $row["userid"];
                    $userName=$row["user_name"];
                    $userEmail=$row["email"];
                    $userPwd=$row["password"];
                    $userRole=$row["role"];
                    $userClientId=$row["client_registration_id"];
                    $userBranchId=$row["id_branch"];
                }
                if(strcmp($userPwd, $user_password)==0)
                {
                    $sql = "insert into mod_session_login_audit(id_login_user,login_date) values(".$userId.",now())";
                    if(mysqli_query($dbcon,$sql))
                    {
                        mysqli_commit($dbcon);                    
                        $updStatus = 0;
                        $_SESSION["user_id"]=$userId;
                        $_SESSION["user_name"]=$userName;
                        $_SESSION["user_email"]=$userEmail;
                        $_SESSION["user_role"]=$userRole;
                        $_SESSION["user_client_id"]=$userClientId;
                        $_SESSION["user_branch_id"]=$userBranchId;                        
                        $_SESSION["user_basket_id"]=0;
                        $_SESSION['LAST_ACTIVITY'] = time();
                    }
                    else
                    {
                        mysqli_rollback($dbcon);
                    }    
                }
                else
                {
                    $updStatus=2;
                      mysqli_rollback($dbcon);
                }
            }
            return $updStatus;    
        }
    }
?>
                        
