<?php
    defined('__JEXEC') or ('Access denied');
    session_start();
    //include_once('util.php');
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
    //include_once('header.php');
    $detallesPago = $controller->getDetallesPago($databasecon,$_GET["tipo"],$_GET["codigo_pago"],$DEBUG_STATUS);
    
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
        /*$data->Amount = 1200;
        $data->AmountWithOutTax = 700;
        $data->AmountWithTax = 440;
        $data->Tax = 60;*/
        $data->Amount = $detallesPago[0][0]*100;
        $data->AmountWithOutTax = 0;
        $data->AmountWithTax = round($detallesPago[0][0]*100/112,2)*100;
        $data->Tax = round($detallesPago[0][0]*12/112,2)*100;
        /*$data->Amount = $detallesPago[0][0]*100;
        $data->AmountWithOutTax = 0;
        $data->AmountWithTax = $detallesPago[0][0]*100;
        $data->Tax = $detallesPago[0][0]*12;*/
        
        $data->Latitud = -5.2112;
        $data->Longitud = -2.6666;
        $data->PurshaseLanguage = 'es';
        $data->TimeZone = -5;


        $phone_number=$_GET["usrCelular"];
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
        }
        $_SESSION['payphone_status']=$response->Status;
        $_SESSION['payphone_txn_id']=$id;
        $_SESSION['DB_Payment_Upd_Status']=$codigoStr;
        echo 'payphone_txn_id::'.$_SESSION['payphone_txn_id'];
    } 
    catch (PayPhoneWebException $exc) 
    {
       //header('HTTP/1.1 '.$exc->StatusCode.' Error');
        echo 'ERR::9999';
       echo json_encode($exc->ErrorList);
    }