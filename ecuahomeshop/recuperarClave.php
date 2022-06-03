<?php
    include_once('util.php');    
    include_once('banner.php');
    include_once('menu.php');
?>


<div class="container login-data">
    <br>
    <br>
    <div class="row">        
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4 text-center bg-info data-panel">
             <br>
            <h3 class="h3-style">RECUPERAR CLAVE</h3>
            <form>
                <br>
                <div class="input-group">
                    <input type="email" class="form-control" placeholder="Ingresar su correo electronico">
                    <div class="input-group-btn">
                        <button class="btn btn-default buscar" type="submit"><i class="glyphicon glyphicon-envelope"></i></button>
                    </div>
                </div>
                
                <br>
                <br>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary button-style" id="btnSubmitRecuperarClaveForm">RECUPERAR CLAVE</button>
                </div>

            </form>
            <br>
        </div>        
        <div class="col-sm-4">
        </div>
    </div>
    <br>
    <br>
    <br>
    <?php
        include_once('footer.php');
    ?>
</div>