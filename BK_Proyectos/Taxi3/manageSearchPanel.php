<?php
	defined('__JEXEC') or ('Access denied');
	
	if(isset($viewid))	
	{
		if($viewid==1)
		{
			?>
				<div class="row">
					<div class="col-sm-4">
					</div>
					<div class="col-sm-4 itemDtl">
						<label for="user_id">UserId</label>
	                    <input type="text" class="form-control" name="user_id" value="<?php echo $usrDtl[0]; ?>" readonly="true" >
					</div
					<div class="col-sm-4">
			        </div>
				</div>
			<?php
		}



		else if($viewid==1)
		{
			?>
				<div class="row">
					<div class="col-sm-4">
					</div>
					<div class="col-sm-4 itemDtl">
						<label for="user_id">ID</label>
	                    <input type="text" class="form-control" name="user_id" value="<?php echo $usrDtl[0]; ?>" readonly="true" >
					</div
					<div class="col-sm-4">
			        </div>
				</div>
			<?php
		}




	}
?>
