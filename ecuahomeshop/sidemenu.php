<div class="col-sm-2 filterList">
    <div class="dropdown">
        <ul>
            <?php
                $category = $controller->getCategory($databasecon,$DEBUG_STATUS);
                for($x=0;$x<count($category);$x++)
                {
                    echo "<li class=dropdown-header><a href=manageBusinessByCat.php?id=".$category[$x][0].">".$category[$x][1]."</a></li>";
                    //$data = $controller->getCategory($databasecon,$DEBUG_STATUS);
                    $sub_category = $controller->getSubCategory($databasecon,$category[$x][0],$DEBUG_STATUS);
                    for($y=0;$y<count($sub_category);$y++)
                    {
                        echo "<li class=dropdown-data><a href=manageBusinessBySubCat.php?id=".$sub_category[$y][0].">".$sub_category[$y][1]."</a></li>";
                    }
                }
            ?>
            <!-- <li class="dropdown-header">GASTRONOMIA</li>
            <li class="dropdown-data"><a href="#">CHINA</a></li>
            <li class="dropdown-data"><a href="#">INDU</a></li>
            <li class="dropdown-data"><a href="#">ITALIANO</a></li>
            <li class="dropdown-data"><a href="#">THAI</a></li>
            <li class="dropdown-data"><a href="#">ARGENTINA</a></li>
            <li class="dropdown-data"><a href="#">ECUATORIANO</a></li>
            <li class="dropdown-header">ROPAS</li>
            <li class="dropdown-data"><a href="#">HOMBRES</a></li>
            <li class="dropdown-data"><a href="#">MUJERES</a></li>
            <li class="dropdown-data"><a href="#">NINOS</a></li>
            <li class="dropdown-header">EVENTOS</li>
            <li class="dropdown-data"><a href="#">CONCIERTOS</a></li>
            <li class="dropdown-data"><a href="#">MATRIMONIOS</a></li>
            <li class="dropdown-data"><a href="#">FOOTBALL</a></li> -->
        </ul>
    </div>
</div>