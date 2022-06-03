<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    include_once('util.php');
    include_once('config.php'); 
    include_once('library/Configuration.php');
    include_once('library/api/Transaction.php');
    include_once('library/common/Constants.php');
    $session_time=$session_expirry_time;
    $payment_wait_time = $payment_max_wait_time;
    $target_dir=$pics_location;
    
    require 'dbcontroller.php';

    $DEBUG_STATUS = $PRINT_LOG;
    if(isset($_SESSION['LAST_ACTIVITY']))
    {
        if(!isset($_SESSION['userid']) || ($_SERVER['REQUEST_TIME']-$_SESSION['LAST_ACTIVITY'])>$session_time)
        {
            $url="userlogin.php";
            header("Location:$url"); 
        }        
    }
    $_SESSION['LAST_ACTIVITY'] = time();

    if(isset($_SESSION["session_msg"]))
    {
        $message=$_SESSION["session_msg"];
        unset($_SESSION["session_msg"]);
    }

    $tipoPago=0;
    $nroDocumentoPago=0;
    $fechaDocumentoPago="1999-12-31";
    $montoDocumentoPago=0;
    
    $controller = new controller();
    include_once('header.php');
    $detallesPago = $controller->getDetallesPago($databasecon,$_GET["tipo"],$_GET["codigo_pago"],$DEBUG_STATUS);
    ?>
        <br>
        <div class="container inner_body" id="estadoReservarViaje">
            <br>
            <br>
            <?php
                if(isset($_SESSION['userid']))
                        include_once('submenu.php');
            ?>
            
            <div class="row">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-10 inner_body-block">
                    <div class="row">
                        <div class="col-sm-12 text-center" id="costoTotal">
                            <br>
                           <h1 style="background:#00b0f0;padding:10px;border:1px solid #00b0f0;color:#FFF"><b>VALOR TOTAL A PAGAR : </b>$ <?=$detallesPago[0][0].'.00';?></h1>                                 
                        </div>
                    </div>
                    <form method="post" action=<?=$_SERVER['REQUEST_URI'].'&doTxn=1';?> enctype="multipart/form-data">
                        <input type="hidden" name="submitted" value="true">
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="button" id="payphone" class="btn btn-info btn_center">CONFIRMAR PAGO<span class="glyphicon glyphicon-chevron-right"></span></button>
                            </div>
                        </div>
                    </form>
                                                   
                    <?php
                        if($_GET["doTxn"]==1)
                        {
                            $config = ConfigurationManager::Instance();
                            
                            //echo 'RefreshToken::'.$config->RefreshToken.'<br>';
                            $transaction = new Transaction();
                            try 
                            {
                                /*$response = $transaction->GetRegions();
                                foreach ($response as $region) 
                                {
                                   echo $region->RegionPrefixNumber + '-' + $region->Name;
                                }

                                /*$response = $transaction->GetCurrency();
                                foreach ($response as $currency) 
                                {
                                   echo $currency->Name . ' - ' . $currency->CatId . ' - ' .$currency->Symbol . '<br/>';
                                }*/

                                //$instance = new Transaction();
                                $response = $transaction->GetToken("0190402452001");
                                //var_dump($response);
                                $config->RefreshToken = $response->refresh_token;
                                

                                $data = new TransactionRequestModel();
                                $data->Amount = 1200;
                                $data->AmountWithOutTax = 700;
                                $data->AmountWithTax = 440;
                                $data->Tax = 60;
                                $data->Latitud = -5.2112;
                                $data->Longitud = -2.6666;
                                $data->PurshaseLanguage = 'es';
                                $data->TimeZone = -5;


                                $phone_number="999332098";
                                $region_code="593";
                                //echo '//////////<br>';
                                /*$response = $transaction->SetAndDoTransaction($data, $phone_number, $region_code);
                                print("<pre>".print_r($response,true)."</pre>");
                                if($response->TransactionStatusId == Constants::STATUS_APPROVED)
                                {
                                    $_SESSION['approved'] = true;
                                    echo 'Transaction approved';
                                }
                                else if($response->TransactionStatusId == Constants::STATUS_CANCELED)
                                {
                                    $_SESSION['approved'] = true;
                                    echo 'Transaction Canceled';
                                }
                                else if($response->TransactionStatusId == Constants::STATUS_PENDIGN)
                                {
                                    $_SESSION['approved'] = true;
                                    echo 'Transaction Pending';
                                }
                                else
                                {
                                    echo 'Transaccion failed';
                                }*/

                                //$response = $transaction->SetTransaction($data, $phone_number, $region_code);
                                $response = $transaction->SetTransaction($data, $phone_number, $region_code);
                                //echo 'Transaction ID::'.$response->TransactionId.'<br>';
                                $_SESSION['TransactionId'] = $response->TransactionId;
                                $id = $_SESSION['TransactionId'];
                                $transaction = new Transaction();
                                $response = $transaction->DoTransaction($id);
                                //$_SESSION['TXN_START_TIME']=time();
                                //print("<pre>".print_r($response,true)."</pre>");
                                //echo '===========DO Transaction ID:'.$response->TransactionId.'<br>';
                                $id = $_SESSION['TransactionId'];
                                
                                

                                /*while(((time()-$_SESSION['TXN_START_TIME'])<$payment_wait_time) && ($response->Status == Constants::STATUS_PENDIGN))
                                {
                                    $response = $transaction->GetTransactionById($id);
                                    sleep(5);
                                }*/
                                $st_time = time();
                                $ctr=0;
                                set_time_limit(0);
                                ?>

                                <?php
                                $response = $transaction->GetTransactionById($id);
                                while($response->Status == Constants::STATUS_PENDIGN)
                                {
                                    $response = $transaction->GetTransactionById($id);
                                    $ctr++;
                                    //echo 'Transaction Pending for approval::'.$ctr.'<br>';
                                    sleep(5);
                                }
                                $et_time = time();
                                //echo "TOTAL EXECUTION TIME ::".($et_time-$st_time).'<br>';

                                if($response->Status == Constants::STATUS_APPROVED)
                                {
                                    $_SESSION['approved'] = true;
                                    //echo 'Transaction approved';
                                    
                                    $codigoStr = $controller->registrarPago($databasecon,$_GET["tipo"],$_GET["codigo_pago"],$id,$_GET["tipo"],'',null,$detallesPago[0][0],$DEBUG_STATUS);
                                    $codigoStr=1;
                                    
                                    ?>
                                    
                                    <div class="row">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-10 inner_body-block">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                </div>
                                                <div class="col-sm-8 text-center">                                                                    
                                                    <?php
                                                        if($codigoStr==1)
                                                        {
                                                    ?>
                                                            <div class='alert alert-success shopAlert'>  
                                                            <?php
                                                                $messsage= 'DETALLES DE PAGO GUARDAO CORRECTAMENTE.<br>';
                                                                $messsage=$messsage.'Numero Comprobante::'.$id.'<br><br>';
                                                                $messsage=$messsage."<a href='misreservas.php'><button type='button' class='btn btn-default btn_center'>MIS VIAJES <span class='glyphicon glyphicon-chevron-right'></span></button></a><br>";
                                                                echo $messsage; 
                                                            ?>
                                                            </div>
                                                    <?php
                                                        }                                                                    
                                                        else
                                                        {
                                                    ?>
                                                            <div class='alert alert-danger shopAlert'>
                                                            <?php
                                                                $messsage= 'ERROR EN REGISTRAR PAGO.<br><br><br>';
                                                                $messsage=$messsage."<a href='".$_SERVER['REQUEST_URI'].'&doTxn=1'."'><button type='button' class='btn btn-default btn_center' id='payphone'>INTENTAR NUEVAMENTE <span class='glyphicon glyphicon-chevron-right'></span></button></a><br>";
                                                                echo $messsage;
                                                            ?>                                                                                                            
                                                            </div>
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                                <div class="col-sm-2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                        </div>
                                    </div>
                                <?php
                                }
                                else if($response->Status == Constants::STATUS_CANCELED)
                                {
                                    $_SESSION['approved'] = true;
                                    ?>
                                    <a href="#" class="btn btn-warning">
                                        <span class="glyphicon glyphicon-info-sign"></span> Transaccion Cancelado 
                                    </a>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <a href="#" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-remove"></span> Error en Transaccion 
                                    </a>
                                    <?php
                                }

                            } 
                            catch (PayPhoneWebException $exc) 
                            {
                               //header('HTTP/1.1 '.$exc->StatusCode.' Error');
                               echo json_encode($exc->ErrorList);
                            }
                        }
                    ?>
                </div>
                <div class="col-sm-1">
                </div>
            </div>
            <br>
            <br>
        </div>
<?php
include_once('container_footer.php');
?>
