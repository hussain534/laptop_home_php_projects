<?php

defined('_JEXEC') or die('Restricted access');

?>
Hi..this is test layout.

<?php
        $pagedata =  $this->data;
        for($i=0;$i<count($pagedata);$i++)
        {
            $pdata=$pagedata[$i];
            echo 'Id::'.$pdata[0].' | ';
            echo 'Name::'.$pdata[1].'<br>';
        } 
    ?>