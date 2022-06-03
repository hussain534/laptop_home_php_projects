<?php
    if(isset($_SESSION["ERR"]))
    {
?>
<div class="row">
    <div class="col-sm-12">
        <?php
            echo $_SESSION["ERR"];
            unset($_SESSION['ERR']);
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
              <a class="navbar-brand" href="index.php"><span class="logo">SKRIMER V2</span></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#" data-toggle="modal" data-target="#loginModal">INGRESAR</a></li>
                <li><a href="#" data-toggle="modal" data-target="#recuperarClaveModal">RECUPERAR CLAVE</a></li>
              </ul>
            </div>
          </div>
        </nav>

        <!-- <div id="loginModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="modal-title text-center">INICIAR SESSION</h2>
                    </div>
                    <div class="modal-body text-center">
                        <br>
                        <br>
                        <form action="controller.php?controller=0&task=1" method="post">
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
        </div> -->
        <div id="loginModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="modal-title text-center">INICIAR SESSION</h2>
                    </div>
                    <div class="modal-body text-center">
                        <br>
                        <br>
                        <form action="controller.php?controller=0&task=1" method="post">
                            <!-- <form action="portal-index.php" method="post"> -->
                            <div class="input-group">
                                <span class="input-group-addon">EMAIL</span>
                                <input type="email" id="userEmail" name="userEmail" class="form-control" placeholder="Ingresar su correo electronico">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">CLAVE</span>
                                <input type="password" id="userPwd" name="userPwd" class="form-control" placeholder="Ingresar su clave">
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

        <div id="recuperarClaveModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="modal-title text-center">RECUPERAR CLAVE</h2>
                    </div>
                    <div class="modal-body text-center">
                        <br>
                        <br>
                        <form action="controller.php?controller=0&task=2" method="post">
                            <!-- <form action="portal-index.php" method="post"> -->
                            <div class="input-group">
                                <span class="input-group-addon">EMAIL</span>
                                <input type="email" id="userEmail" name="userEmail" class="form-control" placeholder="Ingresar su correo electronico">
                            </div>
                          
                            <br>
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary" id="btnOpenManageBusinessForm">RECUPERAR CLAVE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

