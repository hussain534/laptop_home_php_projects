<div class="row">
    <div class="col-sm-12 text-right pagination">
        PAGINA <?= ($current_page+1).' DE '.($total_pages);?>
    </div>    
</div>

<div class="row border-01">
    <div class="col-sm-12 text-right pagination">
        <?php 
            //echo 'current_page:'.$current_page.'<br>';
            //echo 'last_page:'.$last_page.'<br>';
            if($current_page<$last_page) 
            { ?>
                <a title="ULTIMO" href=<?=$nombre_pagina;?>?pagecount=<?php echo $last_page; ?> style="float:right;padding:0 0 0 35px;margin: 0 0 10px;color:#222"><span class="glyphicon glyphicon-fast-forward"></span></a>
                <?php 
            } 
            else 
            { ?>
                <p title="ULTIMO" style="float:right;padding:0 0 0 35px;margin: 0 0 10px;color:#ccc;cursor:default;"><span class="glyphicon glyphicon-fast-forward"></span></p>
                <?php 
            }
            if($current_page<$last_page) 
            { ?>
                <a title="SIGUIENTE" href=<?=$nombre_pagina;?>?pagecount=<?php echo $current_page+1; ?> style="float:right;padding:0 0 0 35px;margin: 0 0 10px;color:#222"><span class="glyphicon glyphicon-forward"></span></a>
                <?php 
            } 
            else 
            { ?>
                <p title="SIGUIENTE" style="float:right;padding:0 0 0 35px;margin: 0 0 10px;color:#ccc;cursor:default;"><span class="glyphicon glyphicon-forward"></span></p>
                <?php 
            }
            if($current_page>0) 
            { ?>
                <a title="ANTERIOR" href=<?=$nombre_pagina;?>?pagecount=<?php echo $current_page-1; ?> style="float:right;padding:0 0 0 35px;margin: 0 0 10px;color:#222"><span class="glyphicon glyphicon-backward"></span></a>
                <?php 
            } 
            else 
            { ?>
                <p title="ANTERIOR" style="float:right;padding:0 0 0 35px;margin: 0 0 10px;color:#ccc;cursor:default;"><span class="glyphicon glyphicon-backward"></span></p>
                <?php 
            }
            if($current_page>0) 
            { ?>
                <a title="PRIMERO" href=<?=$nombre_pagina;?>?pagecount=0 style="float:right;padding:0 0 0 35px;margin: 0 0 10px;color:#222"><span class="glyphicon glyphicon-fast-backward"></span></a>
                <?php 
            }
            else 
            { ?>
                <p title="PRIMERO" style="float:right;padding:0 0 0 35px;margin: 0 0 10px;color:#ccc;cursor:default;"><span class="glyphicon glyphicon-fast-backward"></span></p>
                <?php 
            }

        ?>
    </div>
</div>
<br>
<br>
<br>