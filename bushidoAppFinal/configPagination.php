<div class="row">
    <div class="col-sm-12">
        PAGINA <?= ($current_page+1).' DE '.($total_pages);?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <?php 
            if($current_page>0) 
            { ?>
                <a title="PRIMERO" href=<?=$nombre_pagina;?>?pagecount=0 style="float:left;padding:0 15px 0 0;margin: 0 0 10px;color:#ccc"><span class="glyphicon glyphicon-chevron-left double-glyphicon"></span><span class="glyphicon glyphicon-chevron-left double-glyphicon"></span></a>
                <?php 
            }
            else 
            { ?>
                <p title="PRIMERO" style="float:left;padding:0 15px 0 0;margin: 0 0 10px;color:#676767;cursor:default;"><span class="glyphicon glyphicon-chevron-left double-glyphicon"></span><span class="glyphicon glyphicon-chevron-left double-glyphicon"></span></p>
                <?php 
            }
            if($current_page>0) 
            { ?>
                <a title="ANTERIOR" href=<?=$nombre_pagina;?>?pagecount=<?php echo $current_page-1; ?> style="float:left;padding:0 15px 0 0;margin: 0 0 10px;color:#ccc"><span class="glyphicon glyphicon-chevron-left"></span></a>
                <?php 
            } 
            else 
            { ?>
                <p title="ANTERIOR" style="float:left;padding:0 15px 0 0;margin: 0 0 10px;color:#676767;cursor:default;"><span class="glyphicon glyphicon-chevron-left"></span></p>
                <?php 
            }
            if($current_page<$last_page) 
            { ?>
                <a title="SIGUIENTE" href=<?=$nombre_pagina;?>?pagecount=<?php echo $current_page+1; ?> style="float:left;padding:0 15px 0 0;margin: 0 0 10px;color:#ccc"><span class="glyphicon glyphicon-chevron-right"></span></a>
                <?php 
            } 
            else 
            { ?>
                <p title="SIGUIENTE" style="float:left;padding:0 15px 0 0;margin: 0 0 10px;color:#676767;cursor:default;"><span class="glyphicon glyphicon-chevron-right"></span></p>
                <?php 
            }
            if($current_page<$last_page) 
            { ?>
                <a title="ULTIMO" href=<?=$nombre_pagina;?>?pagecount=<?php echo $last_page; ?> style="float:left;padding:0 15px 0 0;margin: 0 0 10px;color:#ccc"><span class="glyphicon glyphicon-chevron-right double-glyphicon-rt"></span><span class="glyphicon glyphicon-chevron-right double-glyphicon-rt"></span></a>
                <?php 
            } 
            else 
            { ?>
                <p title="ULTIMO" style="float:left;padding:0 15px 0 0;margin: 0 0 10px;color:#676767;cursor:default;"><span class="glyphicon glyphicon-chevron-right double-glyphicon-rt"></span><span class="glyphicon glyphicon-chevron-right double-glyphicon-rt"></span></p>
                <?php 
            }

        ?>
    </div>
</div>