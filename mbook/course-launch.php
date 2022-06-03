<?php
    session_start();
    include_once('util.php');
    include_once('config.php');
    $DEBUG_STATUS = $PRINT_LOG;
    $nombre_pagina='course-launch.php';
    if(isset($_GET["pagecount"]))
        $current_page=$_GET["pagecount"];
    else
        $current_page=0;

    require 'dbcontroller.php';
    $controller = new controller();

    $data = $controller->getCourseContentDtl($databasecon,$_GET["id"],0,$current_page,$pagination_count,$DEBUG_STATUS);
    //$data = $controller->getDoc($databasecon,$_GET["id"],$DEBUG_STATUS);
    
    //echo $docPath;
?>
<div class="container">
    <div class="row paging_back">
        <div class="col-sm-12">
            <?php        
                if(isset($data))
                    echo '<b>Records Found : '.count($data).'</b>';
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?php
                $incitailDocSet=false;
                for($x=0;$x<count($data);$x++)
                {
                    if($x==0 && !$incitailDocSet)
                    {
                        $docPath=$data[0][3];
                        $incitailDocSet=true;
                    }
                    
                    ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <iframe src="<?php echo $data[$x][3];?>" style="width:100%;height:325px;"></iframe>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                    <?php
                    
                    /*echo 'ID::'.$data[$x][0].'<br>';*/
                    echo 'COURSE ID::'.$data[$x][1].'<br>';
                    echo 'DOC TYPE::'.$data[$x][2].'<br>';
                    echo 'DOC PATH::'.$data[$x][3].'<br>';
                    ?>
                    <button type="submit" class="btn btn-danger navbar-btn" onclick="loadFile('<?php echo $data[$x][3];?>')">LOAD</button>
                    </br>
                    </br>
                    </br>
                    </div>
                        </div>
                    <?php
                }
            ?>
        </div>
        <div class="col-sm-8">
            <iframe src="<?php echo $docPath;?>" style="width:100%;height:600px;padding:4% 4% 0px;"  id="docLoader"></iframe>
        </div>
    </div>
</div>


<script>
    function loadFile(path)
    {
        //alert(path);
        //alert('BEFORE:'+document.getElementById("docLoader").src);
        document.getElementById("docLoader").src=""+path;
        //alert('AFTER:'+document.getElementById("docLoader").src);
    }
</script>