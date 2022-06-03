<?php
  defined('__JEXEC') or ('Access denied');
?>


<form method="post" action="doRegisterAndLogin.php">
  <input type="hidden" name="submitted" value="true" />
  <!-- Modal -->
  <div class="modal fade" id="myModalReg" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center">LOGIN</h4>
        </div> -->
        <div class="modal-body">

            <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="font-weight:bolder;">REGISTRAR</h4>
            <input type="text" class="form-control navbar-btn" id="email" placeholder="Email" maxlength=40 name="userEmail">
            <input type="password" class="form-control navbar-btn" id="email" placeholder="Clave" maxlength=40 name="userPwd">
            <label class="radio-inline">
              <input type="radio" name="userRole" value="2" checked="true">Registar como conductor
            </label>
            <label class="radio-inline">
              <input type="radio" name="userRole" value="3">Registar como pasajero
            </label>
            <br>
            <button type="submit" class="btn btn-info navbar-btn" title="Click to enter our portal">
              REGISTRAR 
              <span class="glyphicon glyphicon-chevron-right"></span>
            </button>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
      </div>
      
    </div>
  </div>
</form>