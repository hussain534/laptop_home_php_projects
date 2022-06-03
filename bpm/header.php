<div class="col-sm-12 header">
	<div class="row">
		<div class="col-sm-6">
		    <h4>BPM - MERAKIMINDS</h4>
		</div>
		<div class="col-sm-6 text-right">
		    <?php
		    	if(isset($_SESSION['userEmail']))
		    		echo '<h5><span class="glyphicon glyphicon-user"></span> '.$_SESSION['userEmail'].'&nbsp;&nbsp;&nbsp;&nbsp; <a href=datacontroller.php?dojob=0&metodo=2><span class="glyphicon glyphicon-log-out"></span> LOGOUT</a></h5>';
		    	else
		    		echo '';
		    ?>
		</div>
	</div>		
</div>
