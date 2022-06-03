<br>
<div class="row">
    <div class="col-sm-12  text-center">        
        <h2 style="color:crimson;margin:5px">COMENTARIOS</h2>
    </div>
</div>
<br>
<?php
echo '<h5>'.count($comments).' comentarios encontrados</h5>';
if(isset($comments) && count($comments)>0)
{
    for($z=0;$z<count($comments);$z++)
    {
?>
    <div class="row">
        <div class="col-sm-12 banner_caption">
            <div class="row comment">
                <div class="col-sm-3">
                    <img src=<?php echo $comments[$z][6].'?rand='.rand();?> style="width:150px;" class="img-thumbnail">
                </div>
                <div class="col-sm-9"><!-- 
                    <?php echo $comments[$z][4];?><br> -->
                    <?php echo '<p style="font-family: Bree Serif, serif;font-style:italic;font-size:13px;letter-spacing:.1em">'.$comments[$z][2].'</p>';?>
                    <?php echo '<i class="material-icons" style="font-size:26px;color:#fbc96c;top:5px;position:relative">brush</i><span style="font-size:14px;color:#fbc96c;"> '.$comments[$z][5].'</span>';?>
                </div>
            </div>              
        </div>     
    </div>
<?php
    }
}
?>
<div class="row">
    <form method="post" action="addCommentsToViaje.php">
        <input type="hidden" name="submitted" value="true" />
        <input type="hidden" name="viajeIDComment" value=<?php echo $viajeId;?>>
        <div class="col-sm-12">
            <textarea class="form-control" name="comments" id="comments" value="" rows="4" placeholder="Puedes ingresar su comentarios-400 caracteres" maxlength=400 required></textarea>
        </div>
        <div class="col-sm-12">
        <p style="color:green">NOTA:Se acceptan que los comentarios que se suben aqui, son propiedades de plataforma y 
        podemos usarlo para mostrar en cualquier pagina de este sitio </p>
        </div>
        <div class="col-sm-12">
            <button type="submit" class="btn btn-success btn_center" title="Click to enter our portal">SUBMIT<span class="glyphicon glyphicon-chevron-right"></span></button>
        </div>
    </form>
</div>