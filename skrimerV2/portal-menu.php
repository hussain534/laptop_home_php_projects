<?php
    if(isset($_SESSION["ERR"]))
    {
?>
<div class="row">
    <div class="col-sm-12">
        <?php
            echo strtoupper($_SESSION["ERR"]);
        ?>
    </div>
</div>
<?php
    }
?>
<div class="row">
    <div class="col-sm-12">
        <nav class="navbar option animated pulse">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
              <a class="navbar-brand" href="#"><span class="logo">SKRIMER V2</span></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="admin-clave.php">CAMBIAR CLAVE</a></li>
                <li><a href="logout.php">SALIR</a></li>
              </ul>
            </div>
          </div>
        </nav>
    </div>
</div>
