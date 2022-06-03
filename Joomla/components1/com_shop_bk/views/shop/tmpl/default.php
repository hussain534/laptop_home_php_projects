<?php

defined('_JEXEC') or die('Restricted access');
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');

?>
<hr>
<div id="welcome_def">
    <?php
        $pagedata =  $this->data;
        for($i=0;$i<count($pagedata);$i++)
        {
            $pdata=$pagedata[$i];
            echo 'Id::'.$pdata[0].' | ';
            echo 'Name::'.$pdata[1].'<br>';
        } 
    ?>
</div>