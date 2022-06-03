<!-- <div class="contact">
    <p class="contact_me"><span class="unicodespan">&#9993;</span>info@merakiminds.com</p>
</div> -->
<div class="header">
    <!-- <div class="logo">
        <img src="images/merakiminds_v2.png">
    </div>
    <div class="menu">
        <ul>
            <li><a href="index.php">INICIO</a></li>
            <li><a href="aboutus.php">NOSOTROS</a></li>
            <li><a href="services.php">SERVICIOS</a></li>
            <li><a href="projects.php">NUESTRO PROYECTOS</a></li>
        </ul>
    </div> -->

    <nav class="navbar navbar-inverse" style="margin:0 !important;">
      <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
          <a class="navbar-brand" href="index.php"><img src="images/merakiminds_v2.png" border="0" alt=""></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="index.php">INICIO</a></li>
                <li><a href="aboutus.php">NOSOTROS</a></li>
                <li><a href="services.php">SERVICIOS</a></li>
                <li><a href="projects.php">PROYECTOS</a></li>
                <li><a href="partners.php">PARTNERS</a></li>
                <!-- <li><a href="joinus.php">ÚNETE</a></li> -->
                <li><a href="joinus_smallPanel.php">ÚNETE</a></li>
                <li><a href="contact.php">CONTACTENOS</a></li>
                <li><a href="#" data-toggle="modal" data-target="#loginModal">LOGIN</a></li>
            </ul>
        </div>
      </div>
    </nav>
</div>

<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title text-center">INICIAR SESSION</h2>
            </div>
            <br>
            <div class="modal-body text-center">
                <form action="action.php?action=2" method="post"><!-- portal-index.php -->
                    <div class="input-group">
                        <input type="email" id="userEmail" name="userEmail" class="form-control" placeholder="Ingresar su correo electronico">
                        <div class="input-group-btn">
                            <button class="btn btn-info buscar" type="button"><i class="glyphicon glyphicon-envelope"></i></button>
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="password" id="userPwd" name="userPwd" class="form-control" placeholder="Ingresar su clave">
                        <div class="input-group-btn">
                            <button class="btn btn-info buscar" type="button"><i class="fa fa-key"></i></button>
                        </div>
                    </div>
                  
                    <br>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary" id="btnOpenManageBusinessForm">INICIAR SESSION</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>