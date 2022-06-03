<?php
	$controller = new controller();
	$nodes = $controller->getNodeDtlsByFlowId($databasecon,$_GET["flowId"],$DEBUG_STATUS);  
	if(isset($_GET["flowId"]) && $_GET["flowId"]==0)
	{
?>
<div class="row">
	<div class="col-sm-12 text-center">
		<h3>CREATE NEW FLOW</h3>
	</div>
</div>
<div class="row" id="flow_panel">	
	<div class="col-sm-1">		
	</div>
	<div class="col-sm-10">
		<form method="post" action="datacontroller.php?dojob=2&metodo=0">
		    <input type="hidden" name="submitted" value="true">
		    <input id="applId" type="hidden" class="form-control" name="applId" value="<?php echo $_GET['applId'];?>">
		    <div class="input-group">
		        <span class="input-group-addon input_title">FLOW NAME</span>
		        <input id="flow_name" type="text" class="form-control" name="flow_name" placeholder=" ENTER FLOW NAME">	        
		    </div>
		    <span class="error_msg" id="error_flow_name"></span>
		    <div class="input-group">
		        <span class="input-group-addon input_title">FLOW DESC</span>
		        <input id="flow_desc" type="text" class="form-control" name="flow_desc" placeholder=" ENTER FLOW DESC">	        
		    </div>
		    <span class="error_msg" id="error_flow_desc"></span>
		    
		    <div class="input-group">
		        <input type="submit" value="CREATE FLOW" class="btn btn-primary">
		    </div>
		</form>
	</div>
	<div class="col-sm-1">		
	</div>
</div>
<?php
	}
	else
	{
?>
<div class="row">
	<div class="col-sm-12 text-center">
		<?php 
			$flowDtl = $controller->getFlowDtlsByFlowId($databasecon,$_GET["flowId"],$DEBUG_STATUS);   
    		echo '<h3>'.strtoupper($flowDtl[0][1]).'</h3>';
		?>
		<?php  
		if(isset($message)) 
		{
		?>
		<div class="row data">
		    <br>
		    <div class="col-sm-2"></div>
		    <div class="col-sm-8 text-center">
		        <div class='alert alert-success shopAlert'>
		            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		            <?php echo $message;?>
		        </div>
		    </div>
		    <div class="col-sm-2"></div>
		</div>
		<?php
		    }
		?>
		
	</div>
</div>
<!-- <div class="row">
	<div class="col-sm-10"></div>
	<div class="col-sm-2 text-right">
		<div class="input-group">
	        <a href=page_viewflow.php?flowId=<?php echo $_GET["flowId"];?> target="#"><input type="button" class="btn btn-info" value="VIEW FLOW" /></a>
	    </div>
	</div>
</div>
<br>
<br> -->
<br>
<div class="row" id="node_panel">	
	<div class="col-sm-6" id="flowPanel">
		<?php 
			include_once('page_viewflow.php');
		?>
	</div>

	<div class="col-sm-6" id="myInput">
		<!-- Node Input Start -->
		<div class="row inputForm">			
			<div class="col-sm-12">
			    <input type="hidden" name="submitted" value="true">
			    <input id="id" type="hidden" class="form-control" name="id" value="<?php echo $_GET['flowId'];?>">
			    <div class="input-group">
			        <span class="input-group-addon input_title">NODE ID</span>
			        <input id="node_id" type="text" class="form-control" name="node_id" placeholder=" ENTER NODE ID">	        
			    </div>
			    <span class="error_msg" id="error_node_id"></span>
			    <div class="input-group">
			        <span class="input-group-addon input_title">NODE NAME</span>
			        <input id="node_name" type="text" class="form-control" name="node_name" placeholder=" ENTER NODE NAME">	        
			    </div>
			    <span class="error_msg" id="error_node_name"></span>
			    <div class="input-group">
			        <span class="input-group-addon input_title">NODE DESC</span>
			        <input id="node_desc" type="text" class="form-control" name="node_desc" placeholder=" ENTER NODE DESC">	        
			    </div>
			    <span class="error_msg" id="error_node_desc"></span>
			    <div class="input-group">
			        <span class="input-group-addon input_title">NODE TYPE</span>
				    <select name="node_type" class="form-control" id="node_type" required>
						<option value="0">SELECT NODE TYPE</option>
						<?php 
							$nodeTypes = $controller->getNodeTypes($databasecon,$DEBUG_STATUS);
							for($x=0;$x<count($nodeTypes);$x++)
							{
								echo "<option value='".$nodeTypes[$x][0]."'>".$nodeTypes[$x][1]."</option>";
							}
						?>
		            </select>            
		        </div>
		        <span class="error_msg" id="error_node_type"></span>
		        <div class="input-group">
			        <span class="input-group-addon input_title">FLOW ID</span>
			        <input id="flow_id" type="text" class="form-control" name="flow_id" value="<?php echo $_GET["flowId"];?>" readonly="true">
			    </div>
			    <div class="input-group">
			        <input type="button" id="addNode" value="ADD NODE" class="btn btn-primary">
			    </div>
			</div>
		</div>
		<!-- Node Input End -->

		<!-- Connector input start -->
		<?php
			if(count($nodes)>1)
			{
		?>		
		<div class="row inputForm">
			<div class="col-sm-12">
			    <input type="hidden" name="submitted" value="true">
			    <input id="id" type="hidden" class="form-control" name="id" value="<?php echo $_GET['flowId'];?>">
			    <div class="input-group">
			        <span class="input-group-addon input_title">FROM NODE</span>	        
			        <select name="from_node" class="form-control" id="from_node" required>
						<option value="0">SELECT FROM NODE </option>
						<?php 
							$from_nodes = $controller->getAllNodesByFlowId($databasecon,$_GET["flowId"],$DEBUG_STATUS);
							for($x=0;$x<count($from_nodes);$x++)
							{
								echo "<option value='".$from_nodes[$x][0]."'>".strtoupper($from_nodes[$x][1])."</option>";
							}
						?>
		            </select>
			    </div>
			    <span class="error_msg" id="error_from_node"></span>
			    <div class="input-group">
			        <span class="input-group-addon input_title">TO NODE</span>
			        <select name="to_node" class="form-control" id="to_node" required>
						<option value="0">SELECT TO NODE </option>
						<?php 
							$to_nodes = $controller->getAllNodesByFlowId($databasecon,$_GET["flowId"],$DEBUG_STATUS);
							for($x=0;$x<count($to_nodes);$x++)
							{
								echo "<option value='".$to_nodes[$x][0]."'>".strtoupper($to_nodes[$x][1])."</option>";
							}
						?>
		            </select>
			    </div>
			    <span class="error_msg" id="error_to_node"></span>
			    <div class="input-group">
			        <span class="input-group-addon input_title">NODE DESC</span>
			        <input id="conn_label" type="text" class="form-control" name="conn_label" placeholder=" ENTER CONNECTOR LABEL">	        
			    </div>
			    <span class="error_msg" id="error_conn_label"></span>
			    <div class="input-group">
			        <span class="input-group-addon input_title">CONNECTOR</span>
				    <select name="conn_type" class="form-control" id="conn_type" required>
						<option value="0">SELECT CONNECTOR</option>
						<?php 
							$connTypes = $controller->getConnectorTypes($databasecon,$DEBUG_STATUS);
							for($x=0;$x<count($connTypes);$x++)
							{
								echo "<option value='".$connTypes[$x][0]."'>".strtoupper($connTypes[$x][1])."</option>";
							}
						?>
		            </select>            
		        </div>
		        <span class="error_msg" id="error_conn_type"></span>
		        <div class="input-group">
			        <span class="input-group-addon input_title">FLOW ID</span>
			        <input id="flow_id" type="text" class="form-control" name="flow_id" value="<?php echo $_GET["flowId"];?>" readonly="true">
			    </div>
			    <div class="input-group">
			        <input type="button" id="addConnector" value="ADD CONNECTOR" class="btn btn-primary">
			    </div>
			</div>
		</div>
		<?php
			}
		?>
		<!-- Connector input end -->

		<!-- Table Data Start-->
		<div class="row inputForm">
			<div class="col-sm-12">
				<h5> FOUND <?php echo count($nodes);?> NODES</h5>
				<div class="row table_head">
					<div class="col-sm-1">ID</div>
					<div class="col-sm-3">START NODE</div>
					<div class="col-sm-2">NODE TYPE</div>
					<div class="col-sm-2">CONNECTOR</div>
					<div class="col-sm-3">END NODE</div>
					<div class="col-sm-1">LABEL</div>
				</div>
				<?php
					if(count($nodes)>0)
					{
						for($n=0;$n<count($nodes);$n++)
						{
				?>
				<div class="row table_row">
					<div class="col-sm-1"><?php echo strtoupper($nodes[$n][0]);?></div>
					<div class="col-sm-3"><?php echo strtoupper($nodes[$n][1]);?></div>
					<div class="col-sm-2"><?php echo strtoupper($nodes[$n][2]);?></div>
					<div class="col-sm-2"><?php echo strtoupper($nodes[$n][4]);?></div>
					<div class="col-sm-3"><?php echo strtoupper($nodes[$n][3]);?></div>
					<div class="col-sm-1"><?php echo strtoupper($nodes[$n][5]);?></div>
				</div>
				<?php
						}
					}
				?>
			</div>
		</div>
		<!-- Table Data End-->
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<?php
			if(count($data)>1)
		    {
		        echo '<pre><br>========PREV<br>';
		        print_r($data[0]);
		        echo '<br>========NEXT<br>';
		        print_r($data[1]); 
		        echo '<br><br>';   
		    }	
		    else
		    	echo '<br>ERROR : FLOW DATA INCOMPLETE<br>';
		?>
	</div>
</div>
<br>


<?php
	}
?>

