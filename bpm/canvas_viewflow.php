<?php
    $controller = new controller();
    $data = $controller->drawFlow($databasecon,$_GET["flowId"],$DEBUG_STATUS);  
    //echo '========DATA=========';
    
    if($DEBUG_STATUS)
    {
        echo '<br>========PREV<br>';
        print_r($data[0]);
        echo '<br>========NEXT<br>';
        print_r($data[1]);    
    }
    
?>
<div class="row">
    <div class="col-sm-12 text-right">
        <input type="button" id="fullscreenOn" class="btn btn-success" value="Fullscreen On">
        <input type="button" id="fullscreenOff" class="btn btn-success" value="Fullscreen Off">
    </div>
</div>
<?php  
    /*$vDist=100;
    $hDist=265;
    $vInicio=10;
    $hInicio=35;*/

    $vDist=70;
    $hDist=140;
    $vInicio=10;
    $hInicio=35;

    $prev=$data[0];
    $next=$data[1];
    $startLocated=0;
    $endLocated=0;
    /*$ind= array_search('39;block2;3', $prev);
    echo 'HUSSAIN::'.$ind.'<br>';*/
    for($x=0;$x<count($prev);$x++)
    {
        $txt = explode(';', $prev[$x]);
        $txtNext = explode(';', $next[$x]);
        $class = '';
        $id=$txt[0];
        $style='';
        $title=$txt[1];
        $background='';
        
        if($txt[2]==1 || $txt[2]==2)
        {
            $class = 'block brdr draggable fin';
        }
        else if($txt[2]==3)
        {
            $class='block brdr draggable';
            $background='background:#E7FDC8';
        }
        else if($txt[2]==4)
        {
            $class='block draggable decision';
        }
        $tmpStyle=explode('|', $prev[$x]);
        
        $index=99999;
        $nextElementPos = -1;
        echo '<br>ID::'.$id.'<br>';
        for($a=0;$a<count($next);$a++)
        {
            $nextChildren = explode('|', $next[$a]); 
            for($i=0;$i<(count($nextChildren)-1);$i++)
            {
                $nextChildrenNode = explode(';',$nextChildren[$i]); 
                //echo '<br>';
                //print_r($nextChildren);
                if($index==99999 || empty($index))
                {
                    $index = array_search($id, $nextChildrenNode);
                }
                if($index!=99999 && !empty($index) && $nextElementPos<0)
                {
                    $nextElementPos=($a);
                }
            }
            //echo 'index::'.$index.'<br>';
        }
        echo 'nextElementPos::'.$nextElementPos.'<br>';
        for($y=0;$y<count($tmpStyle);$y++)
        {         
            
            //echo '$prev::'.$prev[$x].';pos::'.$index.'<br>';
            $style='left:'.($hInicio+($y*$hDist)).'px;top:'.($vInicio).'px;'.$background;

            if($txt[2]==1 && $startLocated==0)
            {
                $startLocated=1;
                echo "<p class='".$class."' id='".$id."' style='".$style."' title='".$prev[$x]."'></p>"; 
            }
            else if($txt[2]==2 && $endLocated==0)
            {
                $endLocated=1;
                echo "<p class='".$class."' id='".$id."' style='".$style."' title='".$prev[$x]."'></p>";          
            }
            else if($txt[2]>2)
            {
                echo "<p class='".$class."' id='".$id."' style='".$style."' title='".$prev[$x]."'>".$txt[1]."</p>"; 
            }

            //echo 'startLocated::'.$startLocated.'<br>';
            //echo 'endLocated::'.$endLocated.'<br>';
        }
        $vInicio=$vInicio+(($nextElementPos+1)*($vDist));        
    }


    for($x=0;$x<count($prev);$x++)
    {
        $txt = explode(';', $prev[$x]);
        $txtNextPipe = explode('|', $next[$x]);
        
        $class = '';
        $id=$txt[0];
        $style='';
        $title=$txt[1];
        $background='';
        if($txt[2]==1 || $txt[2]==2)
        {
            $class = 'block brdr draggable fin';
        }
        else if($txt[2]==3)
        {
            $class='block brdr draggable';
            $background='background:#E7FDC8';
        }
        else if($txt[2]==4)
        {
            $class='block draggable decision';
        }
        $tmpStyle=explode('|', $next[$x]);
        for($y=0;$y<count($tmpStyle)-1;$y++)
        {
            //$tmp=explode(';', $tmpStyle[$y]);
            //$style='left:'.($hInicio+($y*$hDist)).'px;top:'.($vInicio).'px;'.$background;

            //echo "<p class='".$class."' id='".$id."' style='".$style."' title='".$prev[$x]."'>".$prev[$x]."</p>";
            $txtNext = explode(';', $txtNextPipe[$y]);
            if($txtNext[0]!=0)
            {
                $conn_class='connector '.$id.' '.$txtNext[0].' '.$txtNext[1];
                echo "<div class='".$conn_class."'>";
                echo "<img src=images/arrow.gif>";
                echo "<img src=images/arrow.gif class=connector-end>";        
                echo '</div>';
            }
        }
        $vInicio=$vInicio+$vDist;        
    }

?>

<!-- <p class="block brdr draggable fin" id="start" style="left:35px; top: 30px;" title="start title"></p> -->