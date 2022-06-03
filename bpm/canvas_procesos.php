<div class="row row_no_margin">
	<div class="col-sm-12 text-center">
		<h3>LIST OF PROCESSES</h3>
	</div>
</div>
<div class="row row_no_margin">	
	<?php
		for($x=0;$x<count($appls);$x++)
		{
	?>
		<div class="col-sm-4 text-center" title="<?php echo $appls[$x][2];?>">
			<div class="row appls">
				<div class="col-sm-12">
					<img src="images/icons/workflow.png" style="width:250px;height:250px">					
				</div>
				<div class="col-sm-12">
					<p><?php echo strtoupper($appls[$x][1]);?></p>
				</div>
				<div class="col-sm-12">
					<a href=page_flows.php?applId=<?php echo $appls[$x][0];?>><input type="button" class="btn btn-info" value="SHOW FLOWS" /></a>
				</div>
				<br>
				<br>
			</div>
		</div>
	<?php		
		}
	?>
</div>