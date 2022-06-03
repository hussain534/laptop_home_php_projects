<?php
  defined('__JEXEC') or ('Access denied');
  include_once('config.php'); 
  //require 'dbcontroller.php';
  require_once('dbcontroller.php');
  $controller = new controller();
?>


<div class="container views" id="myviews">  
    <div class="row" id="viewPanel">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12">
                    <h1><p class="text-right commentPanelTitle">Los buenos palabras...</p></h1>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <?php
                            $comments = $controller->getTopCommentsForHomePage($databasecon,false);
                           
                            if(isset($comments) && count($comments)>0)
                            {
                                for($z=0;$z<count($comments);$z++)
                                {
                            ?>
               
                                    <?php
                                    if(($z+1)%3>0)
                                    {
                                    ?>
                                            <div class="col-sm-4 banner_caption">
                                                <div class="row comment2">
                                                    <!-- <div class="col-sm-3 viemImg">
                                                        <img src=<?php echo $comments[$z][6].'?rand='.rand();?> class="img-thumbnail">
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <?php echo '<p class="comment-text">'.$comments[$z][2].'</p>';?>
                                                        <?php echo '<i class="material-icons" class="comment-brush">brush</i><span class="comment-writer"> '.strtoupper($comments[$z][5]).'</span>';?>
                                                    </div> -->
                                                    <div class="col-sm-12">
                                                        <img src=<?php echo $comments[$z][6].'?rand='.rand();?> class="img-thumbnail">
                                                        <?php echo '<p class="comment-text">'.$comments[$z][2].'</p>';?>
                                                        <?php echo strtoupper($comments[$z][5]);?>
                                                    </div>
                                                </div>              
                                            </div>
                                    <?php  
                                    }
                                    else
                                    {
                                    ?>
                                            <div class="col-sm-4 banner_caption">
                                                <div class="row comment2">
                                                    <!-- <div class="col-sm-3 viemImg">
                                                        <img src=<?php echo $comments[$z][6].'?rand='.rand();?> class="img-thumbnail">
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <?php echo '<p class="comment-text">'.$comments[$z][2].'</p>';?>
                                                        <?php echo '<i class="material-icons" class="comment-brush">brush</i><span class="comment-writer"> '.strtoupper($comments[$z][5]).'</span>';?>
                                                    </div> -->
                                                    <div class="col-sm-12">
                                                        <img src=<?php echo $comments[$z][6].'?rand='.rand();?> class="img-thumbnail">
                                                        <?php echo '<p class="comment-text">'.$comments[$z][2].'</p>';?>
                                                        <?php echo strtoupper($comments[$z][5]);?>
                                                    </div>
                                                </div>              
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php  
                                    }
                                    ?>
                                <?php
                                }
                            }
                            ?>
                      
                 
            </div>
        </div>
</div>
