<?php
include_once('util.php');
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center header">
            <h4>BPM - MERAKIMINDS</h4>
        </div>
    </div>
    <div class="row data">
        <div class="col-sm-9 flujo">
            <div class="canvas" id="mainCanvas">
                <p class="block brdr draggable fin" id="start" style="left:35px; top: 30px;" title="start title"></p>
                <p class="block brdr draggable" id="block1" style="left:35px; top: 70px;background:#E7FDC8" title="block1 title">block1 <span class="glyphicon glyphicon-ok status status_complete"></span></p></p>
                <p class="block brdr draggable" id="block2" style="left:35px; top: 170px;background:#E7FDC8" title="block2 title">block2 <span class="glyphicon glyphicon-ok status status_complete"></span></p></p>
                <p class="block draggable decision" id="block3" style="left:35px; top: 270px;" title="block3 title"><span class="condicion">block3 <span class="glyphicon glyphicon-ok status status_complete"></span></p></span></p>
                <p class="block brdr draggable" id="block4" style="left:35px; top: 370px;background:#E7FDC8" title="block4 title">block4 <span class="glyphicon glyphicon-ok status status_ongoing"></span></p></p>
                <p class="block brdr draggable" id="block5" style="left:300px; top: 370px;background:#E7FDC8" title="block5 title">block5 <span class="glyphicon glyphicon-remove status status_ongoing"></span></p></p>
                <p class="block brdr draggable" id="block6" style="left:565px; top: 370px;background:#E7FDC8" title="block6 title">block6 <span class="glyphicon glyphicon-remove status status_error"></span></p></p>
                <p class="block brdr draggable fin" id="end" style="left: 35px; top: 470px;background:#E7FDC8" title="end title"></p>

                <div class="connector start block1 down_start">
                    <img src="images/arrow.gif">
                    <img src="images/arrow.gif" class="connector-end">        
                </div>

                <div class="connector block1 block2 down_start">
                    <img src="images/arrow.gif">
                    <img src="images/arrow.gif" class="connector-end">
                    <!-- <label class="source-label">start</label> -->
                    <!-- <label class="middle-label">middle</label> -->
                    <!-- <label class="destination-label">end</label> -->
                </div>

                <div class="connector block2 block3 down_start">
                    <img src="images/arrow.gif">
                    <img src="images/arrow.gif" class="connector-end">
                </div>

                <div class="connector block3 block2  right_start">
                    <img src="images/arrow.gif">
                    <img src="images/arrow.gif" class="connector-end">
                    <label class="source-label">NO</label>
                </div>

                <div class="connector block3 block4  down_start">
                    <img src="images/arrow.gif">
                    <img src="images/arrow.gif" class="connector-end">
                    <label class="source-label">SI</label>
                </div>

                <div class="connector block3 block5  down_start">
                    <img src="images/arrow.gif">
                    <img src="images/arrow.gif" class="connector-end">
                </div>

                <div class="connector block3 block6  down_start">
                    <img src="images/arrow.gif">
                    <img src="images/arrow.gif" class="connector-end">
                </div>

                <div class="connector block4 end down_start">
                    <img src="images/arrow.gif">
                    <img src="images/arrow.gif" class="connector-end">
                </div>

                <div class="connector block5 end down_start">
                    <img src="images/arrow.gif">
                    <img src="images/arrow.gif" class="connector-end">
                </div>

                <div class="connector block6 end down_start">
                    <img src="images/arrow.gif">
                    <img src="images/arrow.gif" class="connector-end">
                </div>
            </div>
        </div>        
        <div class="col-sm-3">
          PARAMETERS
        </div>
    </div>
</div>