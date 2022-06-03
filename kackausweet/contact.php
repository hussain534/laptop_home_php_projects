<?php
include_once('util.php');
include_once('logoPanel.php');
include_once('menu.php');
?>
<br>
<br>
<br>
<div id="contact" class="container  text-center option animated zoomInLeft">
  <div class="row">
    <div class="col-sm-4 contactPanel" data-mh="my-group">
      <img src="images/image05.jpg">
    </div>
    <div class="col-sm-4" data-mh="my-group">
      <br><br>
      <form method="post" action="sendMessage.php">
            <input type="hidden" name="submitted" value="true" />  
      <div class="row">
        <div class="col-sm-12 form-group">
          <input class="form-control" id="contact_user" name="contact_user" placeholder="Nombre" type="text" required>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 form-group">
          <input class="form-control" id="contact_email" name="contact_email" placeholder="Email" type="text" required>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 form-group">
          <input class="form-control" id="asunto" name="asunto" placeholder="Asunto" type="text" required>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 form-group">
          <textarea class="form-control" id="contact_msg" name="contact_msg" placeholder="Tu Mensaje" rows="5"></textarea>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-success pull-left" type="submit" onclick="return validateEmail();">ENVIAR</button>
        </div>
      </div>
    </form>
    </div>
    <div class="col-sm-3 text-right" data-mh="my-group">
      <br>
      <br>
      <br>
      <br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <span style="font-size: 20px">0987817871 / 02-2668762<i class="fa fa-phone" style="padding-left:10px;color:#891619"></i></span>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 form-group">
          <span style="font-size: 20px">kackau1@hotmail.com<i class="fa fa-envelope" style="padding-left:10px;color:#891619"></i></span>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 form-group">
          <span style="font-size: 20px">Santa Anita Mz. 15 Cs. 12<i class="fa fa-home" style="padding-left:10px;color:#891619"></i></span>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 form-group">
          <span style="font-size: 20px">www.kackausweet.com<i class="fa fa-globe" style="padding-left:10px;color:#891619"></i></span>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 form-group">
          <span style="font-size: 20px">/kackausweet<i class="fa fa-facebook-official" style="padding-left:10px;color:#891619"></i></span>
        </div>
      </div>
    </div>
  </div>
  
</div>
<br>
<br>
<br>


<script>
  function validateEmail() 
    {
        //alert("HI");
        var x = document.getElementById("contact_email").value;
        var atpos = x.indexOf("@");
        var dotpos = x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
            alert("ERROR FORMATO EMAIL");
            return false;
        }
        else
            return true;
}
</script>
<?php
include_once('footer.php');
?>