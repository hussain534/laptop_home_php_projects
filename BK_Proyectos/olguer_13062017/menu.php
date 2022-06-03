<?php
    defined('__JEXEC') or ('Access denied');
    //session_start();
    //include_once('util.php');
    //include_once('config.php'); 
    //$DEBUG_STATUS = $PRINT_LOG;

    //require 'dbcontroller.php';
    //$controller = new controller();

    //include_once('menuPanel.php');
    //$message='';
    
    $menu = $controller->getMenuPanel($databasecon,$DEBUG_STATUS);
?>
<div class="panel-group">
    <div class="panel panel-default">
        <?php 
        $str='';
        $ctr=0;
        for($x=0;$x<count($menu);$x++)
        {
            if($menu[$x][1]==1)
            {
                if($ctr>0)
                {
                    ?>
                            </ul>
                        </div>
                    <?php
                    $ctr=0;
                }
                ?>
                <div class="panel-heading">
                    <h4 class="panel-title">                
                        <a data-toggle="collapse" href=<?php echo '#collapse'.$x.$menu[$x][1];?>><?php echo $menu[$x][2];?></a>
                    </h4>
                </div>
                <?php                
            }
            else
            {
                if($ctr==0)
                {
                ?>
                    <div id=<?php echo 'collapse'.($x-1).$menu[$x-1][1];?> class="panel-collapse collapse">
                        <ul class="list-group">
                            <li class="list-group-item"><a href=<?php echo $menu[$x][3];?>><?php echo $menu[$x][2];?></a></li>
                <?php
                }
                else
                {
                ?>
                    <li class="list-group-item"><a href=<?php echo $menu[$x][3];?>><?php echo $menu[$x][2];?></a></li>
                <?php    
                }
                $ctr++;
            }
            if($x==(count($menu)-1) && $ctr>0)
            {
                echo '</ul></div>';
            }
        }
        
        ?>
    </div>
</div>
