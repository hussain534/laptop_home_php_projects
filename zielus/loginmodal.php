<?php
  defined('__JEXEC') or ('Access denied');
?>



<form method="post" action="doLogin.php">
  <input type="hidden" name="submitted" value="true" />
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="font-weight:bolder;">LOGIN</h4>
            <input type="text" class="form-control navbar-btn" id="email" placeholder="Email" maxlength=40 name="userEmail">
            <input type="password" class="form-control navbar-btn" id="email" placeholder="Clave" maxlength=40 name="userPwd">
            <button type="submit" class="btn btn-info navbar-btn" title="Click to enter our portal">
              LOGIN 
              <span class="glyphicon glyphicon-chevron-right"></span>
            </button>
        </div>
      </div>      
    </div>
  </div>
</form>