<?php
    if(isset($_SESSION["ERR1"]))
    {
        //echo $_SESSION["ERR1"].'<br>';
        $messageData=explode(':',$_SESSION["ERR1"]);
        //print_r($messageData);
        unset($_SESSION['ERR1']);
        $messageCode=$messageData[0];
        $messageDesc=$messageData[1];
?>
<div class="row">
    <div class="col-sm-3"></div>
    <?php
        if(strcmp($messageCode, "OK")==0)
        {
    ?>
    <div class="col-sm-6 messageSuccess">
    <?php
        }
        else
        {
    ?>
    <div class="col-sm-6 messageError">   
    <?php
        }
    ?>
        <?php
            echo '<p>'.$messageDesc.'</p>';
            
        ?>
    </div>
    <div class="col-sm-3"></div>
</div>
<?php
    }
?>