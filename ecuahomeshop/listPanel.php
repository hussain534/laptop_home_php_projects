<br>
<br>
<div class="headerBox home-data-panel">
    <div class="row">        
        <div class="col-sm-12 data-panel-2 text-right">
            <ul>
                <li><a href="manageBusiness.php?id=OTROS">#</a></li>
                <li><a href="manageBusiness.php?id=A">A</a></li>
                <li><a href="manageBusiness.php?id=B">B</a></li>
                <li><a href="manageBusiness.php?id=C">C</a></li>
                <li><a href="manageBusiness.php?id=D">D</a></li>
                <li><a href="manageBusiness.php?id=E">E</a></li>
                <li><a href="manageBusiness.php?id=F">F</a></li>
                <li><a href="manageBusiness.php?id=G">G</a></li>
                <li><a href="manageBusiness.php?id=H">H</a></li>
                <li><a href="manageBusiness.php?id=I">I</a></li>
                <li><a href="manageBusiness.php?id=J">J</a></li>
                <li><a href="manageBusiness.php?id=K">K</a></li>
                <li><a href="manageBusiness.php?id=L">L</a></li>
                <li><a href="manageBusiness.php?id=M">M</a></li>
                <li><a href="manageBusiness.php?id=N">N</a></li>
                <li><a href="manageBusiness.php?id=O">O</a></li>
                <li><a href="manageBusiness.php?id=P">P</a></li>
                <li><a href="manageBusiness.php?id=Q">Q</a></li>
                <li><a href="manageBusiness.php?id=R">R</a></li>
                <li><a href="manageBusiness.php?id=S">S</a></li>
                <li><a href="manageBusiness.php?id=T">T</a></li>
                <li><a href="manageBusiness.php?id=U">U</a></li>
                <li><a href="manageBusiness.php?id=V">V</a></li>
                <li><a href="manageBusiness.php?id=W">W</a></li>
                <li><a href="manageBusiness.php?id=X">X</a></li>
                <li><a href="manageBusiness.php?id=Y">Y</a></li>
                <li><a href="manageBusiness.php?id=Z">Z</a></li>
                <li><a href="manageBusiness.php?id=">TODOS</a></li>
            </ul>
        </div>
    </div>
    <?php
    if($showListPanel)
    {
        if(!isset($id) || empty($id))
            $id='TODOS';
        ?>
    <!-- <div class="row">   
        <div class="col-sm-10"></div>  
        <div class="col-sm-2 dTitle text-center">
            <h3 class="h3-style-2"><?=$id;?></h3>            
        </div>
    </div>
    <br> -->
    <div class="row">
        <div class="col-sm-12 databox-count"><?=count($data);?> NEGOCIOS ENCONTRADO</div>
    </div>
    <?php
    }
    ?>
</div>