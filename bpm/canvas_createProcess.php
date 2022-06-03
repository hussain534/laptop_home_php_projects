<div class="row">
	<div class="col-sm-12 text-center">
		<h3>CREATE PROCESS</h3>

	</div>
</div>
<br>
<br>
<br>

<?php  
if(isset($message)) 
{
?>
<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8 text-center">
		<div class='alert alert-success shopAlert'>
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?php  echo $message; ?>
		</div>
	</div>
	<div class="col-sm-2">
	</div>
</div>
<?php
    }
?>

<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8">
		<form method="post" action="datacontroller.php?dojob=1&metodo=1">
			<input type="hidden" name="submitted" value="true">
			<div class="input-group">
				<span class="input-group-addon"><img src="images/icons/icons8-Workflow-50.png" class="icons"></span>
				<input id="process_name" type="text" class="form-control" name="process_name" placeholder="PROCESS NAME">
			</div>
			<br>
			<div class="input-group">
				<span class="input-group-addon"><img src="images/icons/icons8-Paste-50.png" class="icons"></span>
				<textarea id="process_desc" class="form-control" name="process_desc" placeholder="PROCESS DESCRIPTION" rows="10"></textarea>
			</div>
			<div class="input-group">
                <input type="submit" value="CREATE PROCESS" class="btn btn-primary">
            </div>
		</form>
	</div>
	<div class="col-sm-2">
	</div>
</div>