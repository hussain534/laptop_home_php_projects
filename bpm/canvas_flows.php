<div class="row">
	<div class="col-sm-12 text-center">
		<h3>LIST OF FLOWS</h3>
	</div>
</div>
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
<div class="row">
	<div class="col-sm-10"></div>
	<div class="col-sm-2 text-right">
		<div class="input-group">
	        <a href=page_viewflowdtls.php?applId=<?php echo $_GET["applId"];?>&flowId=0><input type="button" class="btn btn-info" value="+ NEW FLOW" /></a>
	    </div>
	</div>
</div>
<br>
<div class="row">	
	<?php
		for($x=0;$x<count($flows);$x++)
		{
	?>
		<div class="col-sm-4 text-center" title="<?php echo $flows[$x][2];?>">
			<div class="row appls">
				<div class="col-sm-12">
					<img src="images/icons/flow.png" style="width:250px;height:250px;margin-bottom:15px">					
				</div>
				<div class="col-sm-12">
					<p><?php echo strtoupper($flows[$x][1]);?></p>
				</div>
				<div class="col-sm-12">
					<!-- <a href=page_flows.php?flowId=<?php echo $flows[$x][0];?>><input type="button" class="btn btn-info" value="OPEN FLOW" /></a> -->
					<a href=page_viewflowdtls.php?applId=<?php echo $_GET["applId"];?>&flowId=<?php echo $flows[$x][0];?>><input type="button" class="btn btn-info" value="OPEN FLOW" /></a>
				</div>
				<br>
				<br>
			</div>
		</div>
	<?php		
		}
	?>
</div>