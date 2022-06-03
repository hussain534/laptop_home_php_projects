<?php
    session_start();
    include_once('util.php');
    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    
    require 'dbcontroller.php';
    $controller = new controller();

    $data = $controller->getDoc($databasecon,$_GET["id"],$DEBUG_STATUS);
    $docPath=$data[0][3];
    //echo $docPath;
?>
<embed src="<?php echo $docPath.'#toolbar=0&navpanes=0&scrollbar=0';?>" style="width:100%;height:700px;padding:4% 4% 0px;">

    <!-- <iframe src="//www.slideshare.net/slideshow/embed_code/key/4BHCiFwb1kx8DK" width="595" height="485" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="border:1px solid #CCC; border-width:1px; margin-bottom:5px; max-width: 100%;" allowfullscreen> </iframe> <div style="margin-bottom:5px"> <strong> <a href="//www.slideshare.net/secret/4BHCiFwb1kx8DK" title="Fundamentals of web_design_v2" target="_blank">Fundamentals of web_design_v2</a> </strong> from <strong><a href="https://www.slideshare.net/hussain534" target="_blank">hussain534</a></strong> </div> -->