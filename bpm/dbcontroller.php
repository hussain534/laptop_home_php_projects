<?php
	//session_start();
	class controller
	{	

		public function doLogout($dbcon,$DEBUG_STATUS)
		{
			//session_start();
			mysqli_autocommit($dbcon,FALSE);
			$err_code=1;
			$sql = "UPDATE b_users SET in_use=0 WHERE email='".$_SESSION['userEmail']."'";
			if($DEBUG_STATUS)
				echo '$sql-1::'.$sql.'<br>';
	        if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
	        {
	        	mysqli_commit($dbcon);
	        	$err_code=0;
	        	if($DEBUG_STATUS)
					echo 'LOGOUT SUCCESSFUL<br>';
			
	        }
	        session_destroy();
	        return $err_code;
		}

		public function doLogin($dbcon,$userEmail,$userPwd,$DEBUG_STATUS)
		{
			//session_start();

			//mysqli_autocommit($dbcon,TRUE);
			$err_code=1;
			
			$sql="select id,email,password,name,id_profile,id_client,last_login_dt from b_users where email='$userEmail' and password='$userPwd' and enabled=1";

			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result)) 
				{
					//echo 'LOGIN SUCCESSFUL<br>';
					$_SESSION['userId']=$row["id"];
					$_SESSION['userEmail']=$row["email"];
					$_SESSION['userName']=$row["name"];
					$_SESSION['userPerfilId']=$row["id_profile"];
					$_SESSION['userClientId']=$row["id_client"];
					$_SESSION['LAST_ACTIVITY']=time();
					$sqlUpd = "UPDATE b_users SET last_login_dt=now(),in_use=1 WHERE EMAIL='$userEmail' and password='$userPwd' and enabled=1";
					if($DEBUG_STATUS)
						echo '$sqlUpd:'.$sqlUpd.'<br>';
			        if(mysqli_query($dbcon,$sqlUpd) && mysqli_affected_rows($dbcon)>0)
			        {
			        	$err_code=0;	        	
			        }
				}
			}

			
	        return $err_code;
		}	

		public function createApplication($dbcon,$processName,$processDesc,$DEBUG_STATUS)
		{
			//session_start();
			mysqli_autocommit($dbcon,FALSE);
			$err_code=1;
			$sql = "insert into b_applications(name,description,client_id,created_by,created_on) 
					values('".$processName."','".$processDesc."',".$_SESSION["userClientId"].",".$_SESSION["userId"].",now())";
			if($DEBUG_STATUS)
				echo '$sql-1::'.$sql.'<br>';
	        if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
	        {
	        	mysqli_commit($dbcon);
	        	$err_code=0;
			
	        }
	        return $err_code;
		}	

		
		public function getApplicationsByClient($dbcon,$DEBUG_STATUS)
		{
			$sql="select id,name,description, created_on from b_applications where client_id=".$_SESSION["userClientId"]." order by name";
			$appls=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$appls[$count] = array($row["id"],$row["name"],$row["description"],$row["created_on"]);
					$count++;
				}
			}
			return $appls;
		}

		public function createFlow($dbcon,$flowName,$flowDesc,$applId,$DEBUG_STATUS)
		{
			//session_start();
			mysqli_autocommit($dbcon,FALSE);
			$err_code=1;
			$sql = "insert into b_flows(name,description,application_id,created_by,created_on) 
					values('".$flowName."','".$flowDesc."',".$applId.",".$_SESSION["userId"].",now())";
			if($DEBUG_STATUS)
				echo '$sql-1::'.$sql.'<br>';
	        if(mysqli_query($dbcon,$sql) && mysqli_affected_rows($dbcon)>0)
	        {
	        	mysqli_commit($dbcon);
	        	$err_code=0;
			
	        }
	        return $err_code;
		}

		public function getFlowsByApplication($dbcon,$applId,$DEBUG_STATUS)
		{
			$sql="select id,name,description, created_on from b_flows where application_id=".$applId." order by name";
			$flows=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$flows[$count] = array($row["id"],$row["name"],$row["description"],$row["created_on"]);
					$count++;
				}
			}
			return $flows;
		}

		public function getFlowDtlsByFlowId($dbcon,$flowId,$DEBUG_STATUS)
		{
			$sql="select id,name,description, created_on from b_flows where id=".$flowId;
			$flows=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$flows[$count] = array($row["id"],$row["name"],$row["description"],$row["created_on"]);
					$count++;
				}
			}
			return $flows;
		}

		public function getNodeTypes($dbcon,$DEBUG_STATUS)
		{
			$sql="select id,name from b_node_type order by name";
			$nodes=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$nodes[$count] = array($row["id"],$row["name"]);
					$count++;
				}
			}
			return $nodes;
		}

		public function getConnectorTypes($dbcon,$DEBUG_STATUS)
		{
			$sql="select id,name from b_connector_type order by name";
			$connectors=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$connectors[$count] = array($row["id"],$row["name"]);
					$count++;
				}
			}
			return $connectors;
		}

		public function getAllNodesByFlowId($dbcon,$flowid,$DEBUG_STATUS)
		{
			$sql="select id,name from b_nodes where flow_id=".$flowid." order by name";
			$nodes=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$nodes[$count] = array($row["id"],$row["name"]);
					$count++;
				}
			}
			return $nodes;
		}

		public function addnode($dbcon,$nodeId,$nodeName,$nodeDesc,$nodeType,$flowId,$DEBUG_STATUS)
		{
			//session_start();
			mysqli_autocommit($dbcon,FALSE);
			$err_code=1;
			$sql = "insert into b_nodes(id_text,name,description,node_type,flow_id) 
					values('".$nodeId."','".$nodeName."','".$nodeDesc."',".$nodeType.",".$flowId.")";
			//if($DEBUG_STATUS)
				echo '$sql-1::'.$sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$err_code=0;				
	        }
	        return $err_code;
		}

		public function getNodeDtlsByFlowId($dbcon,$flowId,$DEBUG_STATUS)
		{
			$sql="select n.id,n.name start_name,nt.name node_type
				from b_nodes n,b_node_type nt
				where n.flow_id=".$flowId." and n.node_type=nt.id order by n.id";
			$nodes=array();
			$count=0;
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				while($row = mysqli_fetch_assoc($result)) 
				{
					$end_node_name='-';
					$conn_type='-';
					$label_text='-';
					$sql2="select b.id,b.name,ct.name conn_type,c.label_text from b_connectors c,b_nodes b,b_connector_type ct where c.start_node=".$row["id"]."
							and c.end_node=b.id and c.connector_type=ct.id";
					$result2 = mysqli_query($dbcon,$sql2);
		            if(mysqli_num_rows($result2) > 0)  
		            {
						while($row2 = mysqli_fetch_assoc($result2)) 
						{
							$end_node_name=$row2["name"];
							$conn_type=$row2["conn_type"];
							if(isset($row2["label_text"]) && !empty($row2["label_text"]))
								$label_text=$row2["label_text"];
							$nodes[$count] = array($row["id"],$row["start_name"],$row["node_type"],$end_node_name,$conn_type,$label_text);
							$count++;
						}
					}
					else
					{
						$nodes[$count] = array($row["id"],$row["start_name"],$row["node_type"],$end_node_name,$conn_type,$label_text);
						$count++;
					}				
					
					
				}
			}
			return $nodes;
		}

		public function addConnector($dbcon,$from_node,$to_node,$conn_label,$connType,$flowId,$DEBUG_STATUS)
		{
			//session_start();
			mysqli_autocommit($dbcon,FALSE);
			$err_code=1;
			$sql = "insert into b_connectors(start_node,end_node,connector_type,label_text) 
					values(".$from_node.",".$to_node.",".$connType.",'".$conn_label."')";
			//if($DEBUG_STATUS)
				echo '$sql-1::'.$sql.'<br>';
	        if(mysqli_query($dbcon,$sql))
	        {
	        	mysqli_commit($dbcon);
	        	$err_code=0;				
	        }
	        return $err_code;
		}




		public function drawFlow($dbcon,$flowId,$DEBUG_STATUS)
		{
			$data=array();
			$prevNodes=array();
			$nextNodes=array();
			$countPrev=0;
			$countNext=0;
			$breakValue=0;
			$nodesFound=array();
			$start_flow=0;

			$sql="select n.id,n.name start_name,nt.id node_type
				from b_nodes n,b_node_type nt
				where n.flow_id=".$flowId." and n.node_type=nt.id and n.node_type=1 order by n.id";				
			
			$result = mysqli_query($dbcon,$sql);
            if(mysqli_num_rows($result) > 0)  
            {
				if($row = mysqli_fetch_assoc($result)) 
				{
					$prevNodes[$countPrev] = $row["id"].';'.$row["start_name"].';'.$row["node_type"];
					$start_flow=1;
				}
			}

			if($start_flow==1)
			{
				$nextNodes[0]=$row["id"].'|';

				$str1 = explode('|', $nextNodes[0]);

				if($DEBUG_STATUS)
					print "<pre>";
				

				for($x=0;$x<count($str1)-1;$x++)
				{
					if($DEBUG_STATUS)
						echo '////////////////////// START //////////////////////////'.'<br>';
					if($str1[0]==0)
					{
						if(count($nodesFound)==0)
							break;
						else
							continue;
					}
					if($DEBUG_STATUS)
						print_r($str1);
					
					if($DEBUG_STATUS)
						echo 'x::'.$x.'<br>';
					$sql1="select n.id,n.name start_name,nt.id node_type from b_nodes n,b_node_type nt
						where n.flow_id=".$flowId." and n.node_type=nt.id and n.id=".$str1[$x]." order by n.id";				
					
					$result1 = mysqli_query($dbcon,$sql1);
		            if(mysqli_num_rows($result1) > 0)  
		            {
						if($row1 = mysqli_fetch_assoc($result1)) 
						{
							$prevNodes[$countPrev] = $row1["id"].';'.$row1["start_name"].';'.$row1["node_type"];
							//$prevNodes[$countPrev] = $row1["id"];
							$sqlNext="select end_node,(select name from b_connector_type ct where bc.connector_type=ct.id) connector_type from b_connectors bc 
										where bc.start_node=".$row1["id"];
							
							$strNextNodes='';
							$resultNext = mysqli_query($dbcon,$sqlNext);
				            if(mysqli_num_rows($resultNext) > 0)  
				            {
								while($rowNext = mysqli_fetch_assoc($resultNext)) 
								{
									$strNextNodes=$strNextNodes.$rowNext["end_node"].';'.$rowNext["connector_type"].'|';
									$check=0;
									if(!in_array($rowNext["end_node"].';'.$rowNext["connector_type"], $nodesFound))
										array_push($nodesFound, $rowNext["end_node"].';'.$rowNext["connector_type"]);
								}
							}
							else
							{
								$strNextNodes=$strNextNodes.'0;|';
								//$breakValue=1;						
							}
							$nextNodes[$countPrev]=$strNextNodes;						
						}
					}
					if($x==(count($str1)-2))
					{
						if($DEBUG_STATUS)
						{
							echo '==================================<br>';
							echo 'count($nextNodes):'.count($nextNodes).'<br>';
							echo '***nextNodes<br>';
							echo '******countNext::'.$countNext.'<br>';
							print_r($nextNodes);
							echo '<br>';
						}
						
						$t = explode('|', $nextNodes[$countNext]);
						/*echo '******t<br>';
						print_r($t);
						echo '<br>';*/
						$str1 = explode(';', $t[0]);
						if($DEBUG_STATUS)
						{
							echo '*********str1<br>';
							print_r($str1);
							echo '<br>';	
						}
						

						if($t[0]==0 && count($nodesFound)>0)
						{
							$t = explode('|', $nodesFound[0]);
							$str1 = explode(';', $t[0]);
							if($DEBUG_STATUS)
							{
								echo '******t<br>';
								print_r($t);
								echo '<br>';						
								echo '*********str1<br>';
								print_r($str1);
								echo '<br>';
							}
						}

						if($str1[0]!=0)
							$countNext++;
						else
						{
							if($DEBUG_STATUS)
								echo '//////////////////////// END ///////////////////<br>';
						}
						if($DEBUG_STATUS)
							echo '$countNext:'.$countNext.'<br>';
						$x=-1;
						if($DEBUG_STATUS)
							echo '$x:'.$x.'<br>';

						if($DEBUG_STATUS)
							echo 'count($str1):'.count($str1).'<br>';

						$index = array_search($t[0], $nodesFound);
						if ( $index !== false ) 
						{
							//set( $nodesFound[$index] );
							array_splice($nodesFound, $index, 1);
						}	
						if($DEBUG_STATUS)
						{
							echo '***nodesFound<br>';
							print_r($nodesFound);
							echo '<br>';
							echo '==================================<br><br><br>';	
						}					

					}
					else
					{
						if($DEBUG_STATUS)
							echo '===========ELSE<br>';
					}
					$countPrev++;
					/*echo '***prevNodes<br>';
					print_r($prevNodes);
					echo '***<br>nextNodes<br>';
					print_r($nextNodes);
					echo '***<br>';*/
				}
			//echo '=================<br>';
			//echo 'prevNodes<br>';
			//print_r($prevNodes);
			//echo '<br>nextNodes<br>';
			//print_r($nextNodes);
			//echo '<br>';
			}
			$data[0]=$prevNodes;
			$data[1]=$nextNodes;
			return $data;
		}
	}	
?>
