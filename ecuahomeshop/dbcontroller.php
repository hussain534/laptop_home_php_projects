<?php
    //session_start();
    /*
        $_SESSION["user_id"]=$userId;
        $_SESSION["user_name"]=$userName;
        $_SESSION["user_perfil"]=$userPerfil;
        $_SESSION["client_name"]=$clientName;
        $_SESSION["user_email"]=$userEmail;
        $_SESSION["client_id"]=$clientId;
        $_SESSION["tipo_cliente"]=$tipo_cliente;
        $_SESSION['LAST_ACTIVITY'] = time();
    */
    class controller
    {
        //addEditBusiness,
        public function addEditBusiness($dbcon,$business_id,$business_name,$business_category,$business_hint,$business_address,$business_celular,$business_tele,$business_email,$business_latitud,$business_longitud,$business_desc,$clients_location,$DEBUG_STATUS)
        {
            $updStatus = 0;
            $business_desc = str_replace("'", "", $business_desc);
            if(isset($business_id) && $business_id>0)
            {
                $sql="update hs_clients set name='".$business_name."',category=".$business_category.",hint='".$business_hint."',
                    address='".$business_address."',celular='".$business_celular."',telefono='".$business_tele."',
                    email='".$business_email."',latitud='".$business_latitud."',longitud='".$business_longitud."',
                    detailes='".$business_desc."',modified_by=1,modified_on=now() where id=".$business_id;                
            }
            else
            {
                $sql="insert into hs_clients(name,category,hint,address,celular,telefono,email,latitud,longitud,detailes,habilitado,
                    rating,created_by,created_on) values('".$business_name."',".$business_category.",'".$business_hint."',
                    '".$business_address."','".$business_celular."','".$business_tele."','".$business_email."','".$business_latitud."',
                    '".$business_longitud."','".$business_desc."',1,0,1,now())";
            }
            echo $sql.'<br>';
            if(mysqli_query($dbcon,$sql))
            {
                if(isset($business_id) && $business_id>0)
                {
                }
                else
                    $business_id = mysqli_insert_id($dbcon);
                echo 'business_id::'.$business_id.'<br>';
                $sql="update hs_clients set logo='".$clients_location .$business_id."-logo.jpg' where id=".$business_id;
                if(mysqli_query($dbcon,$sql))
                {
                    $updStatus = $business_id;                    
                }
            }
            return $updStatus;
        }

        public function getBusinessData($dbcon,$business_id,$DEBUG_STATUS)
        {
            $data=array();
            $sql="select name,category,hint,address,celular,telefono,email,latitud,longitud,detailes,habilitado,rating,logo from hs_clients where id=".$business_id;
            $result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
                if($row = mysqli_fetch_assoc($result)) 
                {
                    $data[0] = $row["name"];
                    $data[1] = $row["category"];
                    $data[2] = $row["hint"];
                    $data[3] = $row["address"];
                    $data[4] = $row["celular"];
                    $data[5] = $row["telefono"];
                    $data[6] = $row["email"];
                    $data[7] = $row["latitud"];
                    $data[8] = $row["longitud"];
                    $data[9] = $row["detailes"];
                    $data[10] = $row["habilitado"];
                    $data[11] = $row["rating"];
                    $data[12] = $row["logo"];

                }
            }
            else
            {
                $data[0] = "";
                $data[1] = "";
                $data[2] = "";
                $data[3] = "";
                $data[4] = "";
                $data[5] = "";
                $data[6] = "";
                $data[7] = "";
                $data[8] = "";
                $data[9] = "";
                $data[10] = "";
                $data[11] = "";
                $data[12] = "";
            }
            return $data;
        }

        public function getAllBusinessData($dbcon,$business_id,$apply_pagination,$current_page,$products_per_page,$DEBUG_STATUS)
        {
            $data=array();
            if($apply_pagination==1)    
            {
                if(isset($business_id) && !empty($business_id))
                    $sql="select id,name,category,hint,address,celular,telefono,email,latitud,longitud,detailes,habilitado,rating,logo 
                    from hs_clients where name like'".strtoupper($business_id)."%' limit ".$current_page*$products_per_page.",".$products_per_page;
                else
                    $sql="select id,name,category,hint,address,celular,telefono,email,latitud,longitud,detailes,habilitado,rating,logo 
                    from hs_clients limit ".$current_page*$products_per_page.",".$products_per_page;
            }
            else
            {
                if(isset($business_id) && !empty($business_id))
                    $sql="select id,name,category,hint,address,celular,telefono,email,latitud,longitud,detailes,habilitado,rating,logo 
                    from hs_clients where name like'".strtoupper($business_id)."%'";
                else
                    $sql="select id,name,category,hint,address,celular,telefono,email,latitud,longitud,detailes,habilitado,rating,logo 
                    from hs_clients ";
            }
            //echo 'SQL:'.$sql.'<br>';
            $result = mysqli_query($dbcon,$sql);
            $count=0;
            if(mysqli_num_rows($result) > 0)  
            {
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $data[$count] = array($row["name"],$row["category"],$row["hint"],$row["address"],$row["celular"],
                        $row["telefono"],$row["email"],$row["latitud"],$row["longitud"],$row["detailes"],$row["habilitado"],
                        $row["rating"],$row["logo"],$row["id"]);
                    $count++;

                }
            }            
            return $data;
        }

        public function getCategory($dbcon,$DEBUG_STATUS)
        {
            $data=array();
            $sql="select pc.id,pc.name from hs_product_category pc where pc.habilitado=1 order by pc.name";
            $result = mysqli_query($dbcon,$sql);
            $count=0;
            if(mysqli_num_rows($result) > 0)  
            {
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $data[$count] = array($row["id"],$row["name"]);
                    $count++;

                }
            }            
            return $data;
        }
        public function getSubCategory($dbcon,$id,$DEBUG_STATUS)
        {
            $data=array();
            $sql="select ps.id,ps.name from hs_product_sub_category ps where 
            ps.parent_category=".$id." and ps.habilitado=1 order by ps.name";
            //echo 'SQL:'.$sql.'<br>';
            $result = mysqli_query($dbcon,$sql);
            $count=0;
            if(mysqli_num_rows($result) > 0)  
            {
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $data[$count] = array($row["id"],$row["name"]);
                    $count++;

                }
            }            
            return $data;
        }

        public function getCategorySubcategory($dbcon,$DEBUG_STATUS)
        {
            $data=array();
            $sql="select pc.id category_id,ps.id sub_category_id,pc.name category,ps.name sub_category from hs_product_category pc,hs_product_sub_category ps 
                where pc.id=ps.parent_category and pc.habilitado=1 and ps.habilitado=1
                order by pc.name,ps.name";

            $result = mysqli_query($dbcon,$sql);
            $count=0;
            if(mysqli_num_rows($result) > 0)  
            {
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $data[$count] = array($row["category_id"],$row["sub_category_id"],$row["category"],$row["sub_category"]);
                    $count++;

                }
            }            
            return $data;
        }
    }
?>