<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();
    class controller
    {

        public function manageSpecialCaracter($word) 
        {
            $word = str_replace("@","%40",$word);
            $word = str_replace("`","%60",$word);
            $word = str_replace("¢","%A2",$word);
            $word = str_replace("£","%A3",$word);
            $word = str_replace("¥","%A5",$word);
            $word = str_replace("|","%A6",$word);
            $word = str_replace("«","%AB",$word);
            $word = str_replace("¬","%AC",$word);
            $word = str_replace("¯","%AD",$word);
            $word = str_replace("º","%B0",$word);
            $word = str_replace("±","%B1",$word);
            $word = str_replace("ª","%B2",$word);
            $word = str_replace("µ","%B5",$word);
            $word = str_replace("»","%BB",$word);
            $word = str_replace("¼","%BC",$word);
            $word = str_replace("½","%BD",$word);
            $word = str_replace("¿","%BF",$word);
            $word = str_replace("À","%C0",$word);
            $word = str_replace("Á","%C1",$word);
            $word = str_replace("Â","%C2",$word);
            $word = str_replace("Ã","%C3",$word);
            $word = str_replace("Ä","%C4",$word);
            $word = str_replace("Å","%C5",$word);
            $word = str_replace("Æ","%C6",$word);
            $word = str_replace("Ç","%C7",$word);
            $word = str_replace("È","%C8",$word);
            $word = str_replace("É","%C9",$word);
            $word = str_replace("Ê","%CA",$word);
            $word = str_replace("Ë","%CB",$word);
            $word = str_replace("Ì","%CC",$word);
            $word = str_replace("Í","%CD",$word);
            $word = str_replace("Î","%CE",$word);
            $word = str_replace("Ï","%CF",$word);
            $word = str_replace("Ð","%D0",$word);
            $word = str_replace("Ñ","%D1",$word);
            $word = str_replace("Ò","%D2",$word);
            $word = str_replace("Ó","%D3",$word);
            $word = str_replace("Ô","%D4",$word);
            $word = str_replace("Õ","%D5",$word);
            $word = str_replace("Ö","%D6",$word);
            $word = str_replace("Ø","%D8",$word);
            $word = str_replace("Ù","%D9",$word);
            $word = str_replace("Ú","%DA",$word);
            $word = str_replace("Û","%DB",$word);
            $word = str_replace("Ü","%DC",$word);
            $word = str_replace("Ý","%DD",$word);
            $word = str_replace("Þ","%DE",$word);
            $word = str_replace("ß","%DF",$word);
            $word = str_replace("à","%E0",$word);
            $word = str_replace("á","%E1",$word);
            $word = str_replace("â","%E2",$word);
            $word = str_replace("ã","%E3",$word);
            $word = str_replace("ä","%E4",$word);
            $word = str_replace("å","%E5",$word);
            $word = str_replace("æ","%E6",$word);
            $word = str_replace("ç","%E7",$word);
            $word = str_replace("è","%E8",$word);
            $word = str_replace("é","%E9",$word);
            $word = str_replace("ê","%EA",$word);
            $word = str_replace("ë","%EB",$word);
            $word = str_replace("ì","%EC",$word);
            $word = str_replace("í","%ED",$word);
            $word = str_replace("î","%EE",$word);
            $word = str_replace("ï","%EF",$word);
            $word = str_replace("ð","%F0",$word);
            $word = str_replace("ñ","%F1",$word);
            $word = str_replace("ò","%F2",$word);
            $word = str_replace("ó","%F3",$word);
            $word = str_replace("ô","%F4",$word);
            $word = str_replace("õ","%F5",$word);
            $word = str_replace("ö","%F6",$word);
            $word = str_replace("÷","%F7",$word);
            $word = str_replace("ø","%F8",$word);
            $word = str_replace("ù","%F9",$word);
            $word = str_replace("ú","%FA",$word);
            $word = str_replace("û","%FB",$word);
            $word = str_replace("ü","%FC",$word);
            $word = str_replace("ý","%FD",$word);
            $word = str_replace("þ","%FE",$word);
            $word = str_replace("ÿ","%FF",$word);
            return urldecode($word);
        }

        /*public function registerPerfilData($dbcon,$user_name,$user_email,$user_contact,$user_perfil,$skills,$DEBUG_STATUS)
        {
            $password=0;
            $sql="select u.id userid, u.name user_name,u.email,u.password,u.profile,u.contact from mm_user u
                where u.email = '".$user_email."' and u.enabled=1 ";
            ////echo $sql.'<br>';
            //$updStatus=0;
            mysqli_autocommit($dbcon,FALSE);
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {                
                $password=mt_rand();
                $sql = "insert into mm_user(name,email,password,profile,contact,enabled,created_on,modified_on) 
                        values('".$user_name."','".$user_email."','".$password."',".$user_perfil.",'".$user_contact."',1,now(),now())";
                //echo $sql.'<br>';
                if(mysqli_query($dbcon,$sql))
                {
                    //mysqli_commit($dbcon); 
                    $id = mysqli_insert_id($dbcon);
                    $skillsData=explode(",",$skills);
                    for($z=0;$z<count($skillsData);$z++)                  
                    {
                        if($z==0 && $skillsData[$z]==0)
                            mysqli_commit($dbcon);
                        else
                        {
                            $sql="insert into mm_user_skills(user_id,skill_id,enabled,created_on,modified_on)
                                    values(".$id.",".$skillsData[$z].",1,now(),now())";
                            if(mysqli_query($dbcon,$sql))
                            {
                                mysqli_commit($dbcon);
                            }
                            else
                            {
                                $password=0;
                                mysqli_rollback($dbcon);
                            }
                        }
                    }                    
                }
                else
                {
                    $password=0;
                    mysqli_rollback($dbcon);
                }                    
            }
            return $password;            
        }*/

        public function registerPerfilDataSmallPanel($dbcon,$user_name,$user_email,$user_contact,$user_perfil,$skills,$DEBUG_STATUS)
        {
            $password=0;
            $sql="select u.id userid, u.name user_name,u.email,u.password,u.profile,u.contact from mm_user u
                where u.email = '".$user_email."' and u.enabled=1 ";
            ////echo $sql.'<br>';
            //$updStatus=0;
            mysqli_autocommit($dbcon,FALSE);
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) == 0)
            {                
                $password=mt_rand();
                $email_confirmation_token = mt_rand();
                $email_confirmation_date=date("Ymd").date("his");
                //echo '<token>'.$email_confirmation_token.'<br>';
                //echo '<date>'.$email_confirmation_date;
                $sql = "insert into mm_user(name,email,password,profile,contact,email_confirmation_token,enabled,created_on,modified_on) 
                        values('".$user_name."','".$user_email."','".$password."',".$user_perfil.",'".$user_contact."','".($email_confirmation_token+$email_confirmation_date)."',1,now(),now())";
                //echo $sql.'<br>';
                if(mysqli_query($dbcon,$sql))
                {
                    //mysqli_commit($dbcon); 
                    $id = mysqli_insert_id($dbcon);
                    $sql="insert into mm_user_skills(user_id,skill_id,enabled,skills_desc,created_on,modified_on)
                            values(".$id.",0,1,'".$skills."',now(),now())";
                    if(mysqli_query($dbcon,$sql))
                    {
                        mysqli_commit($dbcon);
                    }
                    else
                    {
                        $password=0;
                        mysqli_rollback($dbcon);
                    }          
                }
                else
                {
                    $password=0;
                    mysqli_rollback($dbcon);
                }                    
            }
            else
            {
                $password=-1;
            }
            return $password;            
        }

        public function getUserAccountConfirmationStr($dbcon,$userEmail,$DEBUG_STATUS)
        {
            $sql="select s.id,s.email_confirmation_token from mm_user s where enabled=1 and s.email='".$userEmail."'";
            $perfil=array();
            $count=0;
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $perfil[$count] = array($row["id"],$row["email_confirmation_token"]);
                    $count++;
                }
            }
            return $perfil;       
        }

        public function verifyUser($dbcon,$id,$token,$DEBUG_STATUS)
        {
            $updStatus = 0;
            $sql = "update mm_user set email_valid=1 where id=".$id." and email_confirmation_token='".$token."'";
            if(mysqli_query($dbcon,$sql))
            {
                $updStatus = 1;
                mysqli_commit($dbcon);  
            }
            return $updStatus; 
        }

        public function loginUser($dbcon,$user_email,$user_password,$DEBUG_STATUS)
        {
            $sql="select id,name,password,profile from mm_user u
                where u.email = '".$user_email."' and u.enabled=1 and email_valid=1";
            ////echo $sql.'<br>';
            $updStatus=4;
            mysqli_autocommit($dbcon,FALSE);
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {                
                if($row = mysqli_fetch_assoc($result)) 
                {
                    $userId = $row["id"];
                    $userName=$row["name"];
                    $userEmail=$user_email;
                    $userPwd=$row["password"];
                    $userRole=$row["profile"];
                    if(strcmp($userPwd, $user_password)==0)
                    {                    
                        $updStatus = 1;
                        $_SESSION["user_id"]=$userId;
                        $_SESSION["user_name"]=$userName;
                        $_SESSION["user_email"]=$userEmail;
                        $_SESSION["user_role"]=$userRole;
                        $_SESSION['LAST_ACTIVITY'] = time();                     
                    }
                    else
                    {
                        $updStatus=3;
                          mysqli_rollback($dbcon);
                    }
                }                
            }
            return $updStatus;            
        }

        public function recuperarClave($dbcon,$user_email,$DEBUG_STATUS)
        {
            $sql="select id,name nombre,password from ct_user u where u.email = '".$user_email."'";
            echo $sql;
            $updStatus=0;
            $id=0;
            $nombre='';
            $password='';
            //$usr=array();
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {                
                if($row = mysqli_fetch_assoc($result)) 
                {
                    $id=$row["id"];
                    $nombre=$row["nombre"];
                    $password=$row["password"];
                    $clave=mt_rand();
                    
                    $sql = "update ct_user set password='".$clave."',modified_dt=now() where email = '".$user_email."'";
                    if(mysqli_query($dbcon,$sql))
                    {
                        $updStatus = 1;
                    }

                    $to = $user_email;
                    $subject = 'SKRIMER- RECUPERACION CLAVE';
                    $txt = '¡HOLA, '.$nombre.'!'."<br><br>";
                    $txt=$txt.'Se ha solicitado recuperar la clave para su cuenta en SKRIMER'."<br><br>";
                    $txt=$txt.'Usa la dirección de correo electrónico '.$user_email.' con siguiente clave para iniciar sesión'."<br><br>";
                    $txt=$txt.'CLAVE:'.$clave."<br><br>";
                    $txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros en info@skrimer.com'."<br><br>";
                    $txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";
                    $txt=$txt.'El Equipo de SKRIMER'."<br><br>";
                    $txt=$txt.'Por favor ingresar a <br>www.skrimer.com'."<br><br>";

                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
                    /*$headers .= 'From:info@hutesol.com' . "\r\n";
                    $headers .= 'CC: olguercalvache@gmail.com';*/
                    $headers .= 'From:SKRIMER <portal@skrimer.com>' . "\r\n";
                    //$headers .= 'CC: fernandoa@nipromed.com';
                    //$headers .= 'BCC: fernandoa@nipromed.com';

                    $res=mail($to,$subject,$txt,$headers);
                    if($res==true)
                    {
                        $updStatus = 1;
                    }
                    else
                    {
                        $sql = "update ct_user set password='".$password."' where email = '".$user_email."'";
                        if(mysqli_query($dbcon,$sql))
                        {
                            $updStatus = 2;
                        }
                    }
                }
            }
            else
            {
                $updStatus = 3;
            }
            return $updStatus;
        }

        public function cambiarClave($dbcon,$clave_anterior,$clave_nuevo,$DEBUG_STATUS)
        {
            $sql="select id,name nombre,password from ct_user u where u.email = '".$_SESSION["user_email"]."' and password='".$clave_anterior."'";
            $updStatus=0;
            $id=0;
            $nombre='';
            $password='';
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)
            {                
                if($row = mysqli_fetch_assoc($result)) 
                {
                    $id=$row["id"];
                    $nombre=$row["nombre"];
                    $password=$row["password"];

                    $sql = "update ct_user set password='".$clave_nuevo."',modified_dt=now() where email = '".$_SESSION["user_email"]."'";
                    if(mysqli_query($dbcon,$sql))
                    {
                        $updStatus = 1;
                    }

                    $to = $_SESSION["user_email"];
                    $subject = 'SKRIMER - CAMBIO DE CLAVE';
                    $txt = '¡HOLA, '.$nombre.'!'."<br><br>";
                    $txt=$txt.'Se ha solicitado cambiar la clave para su cuenta en SKRIMER'."<br><br>";
                    $txt=$txt.'Usa la dirección de correo electrónico '.$_SESSION["user_email"].' con siguiente clave para iniciar sesión'."<br><br>";
                    $txt=$txt.'CLAVE:'.$clave_nuevo."<br><br>";
                    $txt=$txt.'Si tienes alguna pregunta o necesitas ayuda, puedes ponerte en contacto con nosotros info@skrimer.com'."<br><br>";
                    $txt=$txt.'¡Disfruta de esta herramienta creada para ti!'."<br><br>";
                    $txt=$txt.'El Equipo de SKRIMER'."<br><br>";
                    $txt=$txt.'Por favor ingresar a <br>www.skrimer.com'."<br><br>";

                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
                    /*$headers .= 'From:info@hutesol.com' . "\r\n";
                    $headers .= 'CC: olguercalvache@gmail.com';*/
                    $headers .= 'From:SISTEC NIPRO <portal@skrimer.com>' . "\r\n";
                    //$headers .= 'CC: fernandoa@nipromed.com';
                    //$headers .= 'BCC: fernandoa@nipromed.com';

                    $res=mail($to,$subject,$txt,$headers);
                    if($res==true)
                    {
                        $updStatus = 1;
                    }
                    else
                    {
                        $sql = "update ct_user set password='".$password."' where email = '".$_SESSION["user_email"]."'";
                        if(mysqli_query($dbcon,$sql))
                        {
                            $updStatus = 2;
                        }
                    }
                }
            }
            else
            {
                $updStatus = 3;
            }
            return $updStatus;
        }

        public function getPerfils($dbcon,$DEBUG_STATUS)
        {
            $sql="select p.id,p.perfil_name from mm_perfil p where enabled=1 and id>1";
            $perfil=array();
            $count=0;
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $perfil[$count] = array($row["id"],$row["perfil_name"]);
                    $count++;
                }
            }
            return $perfil;       
        }

        public function getPrimarySkills($dbcon,$DEBUG_STATUS)
        {
            $sql="select p.id,p.skill_name from mm_skill_primary p where enabled=1";
            $perfil=array();
            $count=0;
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $perfil[$count] = array($row["id"],$row["skill_name"]);
                    $count++;
                }
            }
            return $perfil;       
        }

        public function getSecondarySkills($dbcon,$primary_skill_id,$DEBUG_STATUS)
        {
            $sql="select s.id,s.skill_name from mm_skill_secondary s where enabled=1 and s.primary_skill_id=".$primary_skill_id;
            $perfil=array();
            $count=0;
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $perfil[$count] = array($row["id"],$row["skill_name"]);
                    $count++;
                }
            }
            return $perfil;       
        }

    }
?>