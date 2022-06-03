<?php

    session_start();

    include_once('util.php');

    include_once('header.php');



    $msg='';

    

    if(isset($_GET["err"]))

        $err=$_GET["err"];

    else 

        $err=99;

    

    if($err==1)    

    {

        $msg= '<center>USUARIO REGISTRADO CORRECTAMENTE.</center>';

    }

    else if($err==0)

    {

         $msg= '<center>ERROR OCURIDO. INTENTA NUEVAMENTE</center>';

    }

    else if($err<0)

    {

         $msg= '<center>USUARIO EXISTE. REGISTRAR CON OTROS DATOS</center>';

    }

    else if($err==9)

    {

         $msg= '<center>ERROR EN ENVIAR CORREO DE CONFIRMACION DE REGISTRO EXITOSO DEL USUARIO.</center>';

    }

    else if($err==8)

    {

         $msg= '<center>ERROR OCURIDO EN REGISTRAR USUARIO. INTENTA NUEVAMENTE</center>';

    }



    /*include_once('config.php');

    $DEBUG_STATUS = $PRINT_LOG;

    require 'controladorDB.php';

    $controladorDB = new controladorDB();*/

    $data = $controladorDB->listaUsers($databasecon,0,$DEBUG_STATUS);

?>



<style type="text/css">

    body

    {

        background-image: none !important;

    }

</style>

<div class="container">

    <?php

    include_once('sessionData.php');

    ?>

    <div class="row pageTitle">

        <div class="col-sm-12">

            CREAR NUEVA CUENTA

        </div>

    </div>

    <br>

    <br>

    <div class="row">

        <div class="col-sm-3"></div>

        <div class="col-sm-6 text-center">

            <?php

            if(strlen($msg)>0)

            {

            ?>

            <div class="alert alert-info" role="alert">

                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <?php echo $msg;?>

            </div>

            <?php

            }

            ?>

        </div>

        <div class="col-sm-3"></div>

    </div>

    <br>

    <br>

    

    <div class="row">

         <div class="col-sm-1"></div>

         <div class="col-sm-10">

            <form method="post" action="controladorProceso.php?proceso=0&task=0" onsubmit="return validateFormCrearCuenta();">

                <div class="row">

                    <div class="col-sm-12">

                        <input type="hidden" name="submitted" value="true" />

                        <input type="hidden" class="form-control navbar-btn" id="usuarioRed" name="usuarioRed" value="000"> 

                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-4">

                        <label>NOMBRE*</label>

                        <input type="text" class="form-control navbar-btn" id="nombre" placeholder="Nombre Completo" name="userNombre" required> 

                    </div>

                    <div class="col-sm-4">

                        <label>EMAIL*</label>

                        <input type="email" class="form-control navbar-btn" id="email" placeholder="Email" name="userEmail" required>

                    </div>

                    <div class="col-sm-4">

                        <label>PASSWORD</label>

                        <input type="password" class="form-control navbar-btn" id="pwd" placeholder="Clave" name="userPwd" value="password" required readonly="true">

                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-4">

                        <label>TELEFONO 1*</label>

                        <input type="text" class="form-control navbar-btn" id="telefono" placeholder="Telefono" name="userTelefono" required>

                    </div>

                    <div class="col-sm-4">

                        <label>TELEFONO 2 (opcional)</label>

                        <input type="text" class="form-control navbar-btn" id="celular" placeholder="Celular" name="userCelular">

                    </div>

                    <div class="col-sm-4">

                        <label>DIRECCION (opcional)</label>

                        <input type="text" class="form-control navbar-btn" id="ubicacion" placeholder="Ubicacion" name="userUbicacion">

                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-4">

                        <label>PERFIL</label>

                        <select name="userPerfil" class="form-control navbar-btn" id="perfil" onChange="mostrarParalelo()" required>

                            <option value="-1">ESCOGER PERFIL</option>

                            <?php 

                                $perfil = $controladorDB->listaPerfil($databasecon,0,$DEBUG_STATUS);

                                for($i=0;$i<count($perfil);$i++)

                                {

                                    ?>

                                        <option value=<?php echo $perfil[$i][0];?>><?php echo '['.$perfil[$i][0].']:'.$perfil[$i][1];?></option>

                                    <?php

                                }

                            ?>

                        </select>

                    </div>

                    <div class="col-sm-4" id="paralelodropdown">

                        <label>PARALELO</label>

                        <select name="paralelo" class="form-control navbar-btn" id="idparalelo"  onChange="selectParalelo()" required>

                            <option value="-1">ESCOGER PARALELO</option>

                            <?php 

                                $paralelo = $controladorDB->getParaleloList($databasecon,0,$DEBUG_STATUS);

                                for($i=0;$i<count($paralelo);$i++)

                                {

                                    ?>

                                        <option value=<?php echo $paralelo[$i][0];?>><?php echo '['.$paralelo[$i][0].']:'.$paralelo[$i][1];?></option>

                                    <?php

                                }

                            ?>

                        </select>

                    </div>

                    <div class="col-sm-4">

                        <input type="hidden" class="form-control navbar-btn" id="paralelo" value="1" name="userParalelo" readonly="true">

                    </div>

                </div>

                <br>                        

                <!-- <center> -->

                    <button type="submit" class="btn btn-info btn_center" title="Click to enter our portal">CREAR CUENTA<span class="glyphicon glyphicon-chevron-right"></span></button>

                

                <!-- </center> -->

            </form>

        </div>

        <div class="col-sm-1"></div>    

    </div>

    <br>

    <?php

        if(isset($data))

        {

            $dbTable='datos';

            ?>

            <div class="table-responsive">

                <table class="table">

                    <thead>

                        <tr class="table-header">

                            <td>#FILA</td>

                            <td>NOMBRE</td>

                            <td>EMAIL</td>

                            <td>PERFIL</td>

                            <td>TELEFONO</td>

                            <td>CELULAR</td>

                            <td>UBICACION</td>

                            <td>PARALELO</td>

                            <td>HABILITADO</td>

                        </tr>

                    </thead>

                    <tbody>

            <?php

                for($x=0;$x<count($data);$x++)

                {

            ?>

                        <tr class="table-body">

                            <!-- <td><?php echo $data[$x][0];?></td> --> 
                            <td><?php echo $x+1;?></td>

                            <td><?php echo $data[$x][1];?></td>

                            <td><?php echo $data[$x][2];?></td>

                            <td><?php echo $data[$x][3];?></td>

                            <td><?php echo $data[$x][4];?></td>

                            <td><?php echo $data[$x][5];?></td>

                            <td><?php echo $data[$x][6];?></td>

                            <td><?php echo $data[$x][9];?></td>

                            <!-- <td><?php echo $data[$x][7];?></td> -->
                            <td>
                                <a href="controladorProceso.php?proceso=0&task=4&id=<?php echo $data[$x][0];?>"><span class="glyphicon glyphicon-remove" style="font-size:x-large;color:red;"></span></a>
                            </td>

                        </tr>

                    

            <?php

                }

            ?>

                    </tbody>

                </table>

            </div>

            <?php

        }

    ?>

    <br>

</div>