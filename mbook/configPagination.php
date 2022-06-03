<?php
    //echo 'current_page::'.$current_page.'<br>';
    //echo 'last_page::'.$last_page.'<br>';
?>
<div class="row paging_back">
    <div class="col-sm-4">
        <?php        
            if(isset($dataLoop))
                echo '<b>Records Found : '.count($dataLoop).'</b>';
        ?>
    </div>
    <div class="col-sm-4 text-center pagination">
        <?= 'SHOWING    '.($current_page+1).' / '.($total_pages);?>
    </div>
    <div class="col-sm-4 text-right pagination">
        <?php 
            if($current_page<$last_page) 
            { ?>
                <a title="ULTIMO" href=<?=$nombre_pagina;?>?pagecount=<?php echo $last_page; ?> style="float:right;padding:0 0 0 35px;margin: 0 0 4px;color:#222"><span class="glyphicon glyphicon-fast-forward ff-enable"></span></a>
                <?php 
            } 
            else 
            { ?>
                <p title="ULTIMO" style="float:right;padding:0 0 0 35px;margin: 0 0 4px;color:#ccc;cursor:default;"><span class="glyphicon glyphicon-fast-forward ff-disable"></span></p>
                <?php 
            }
            if($current_page<$last_page) 
            { ?>
                <a title="SIGUIENTE" href=<?=$nombre_pagina;?>?pagecount=<?php echo $current_page+1; ?> style="float:right;padding:0 0 0 35px;margin: 0 0 4px;color:#222"><span class="glyphicon glyphicon-forward f-enable"></span></a>
                <?php 
            } 
            else 
            { ?>
                <p title="SIGUIENTE" style="float:right;padding:0 0 0 35px;margin: 0 0 4px;color:#ccc;cursor:default;"><span class="glyphicon glyphicon-forward f-disable"></span></p>
                <?php 
            }
            if($current_page>0) 
            { ?>
                <a title="ANTERIOR" href=<?=$nombre_pagina;?>?pagecount=<?php echo $current_page-1; ?> style="float:right;padding:0 0 0 35px;margin: 0 0 4px;color:#222"><span class="glyphicon glyphicon-backward b-enable"></span></a>
                <?php 
            } 
            else 
            { ?>
                <p title="ANTERIOR" style="float:right;padding:0 0 0 35px;margin: 0 0 4px;color:#ccc;cursor:default;"><span class="glyphicon glyphicon-backward b-disable"></span></p>
                <?php 
            }
            if($current_page>0) 
            { ?>
                <a title="PRIMERO" href=<?=$nombre_pagina;?>?pagecount=0 style="float:right;padding:0 0 0 35px;margin: 0 0 4px;color:#222"><span class="glyphicon glyphicon-fast-backward fb-enable"></span></a>
                <?php 
            }
            else 
            { ?>
                <p title="PRIMERO" style="float:right;padding:0 0 0 35px;margin: 0 0 4px;color:#ccc;cursor:default;"><span class="glyphicon glyphicon-fast-backward fb-disable"></span></p>
                <?php 
            }
        ?>
    </div>
</div>