<?php
	defined('_JEXEC') or ('Access Deny');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<base href="http://merakiminds.com/" />
    <!--<title>MERAKI MINDS</title>-->
  <link href="images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <!-- <link href='https://fonts.googleapis.com/css?family=Lobster|Cabin|Noto+Serif|Shadows+Into+Light|Pacifico|Alegreya' rel='stylesheet' type='text/css'> -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/css/google-api-jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/css/style.css">
    
    <script type="text/javascript" src="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/js/jquery-2.1.3.min.js" ></script>
    <script type="text/javascript" src="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/js/cycle2.js" ></script>

  	<jdoc:include type="head"/>
    
    <script>
        $(document).ready(function(){
            $("#wrappermobile").hide();
            $("#show").click(function(){
                
                $("#wrappermobile").toggle(1000);

            });
        });
    </script>
</head>
<body>
<div class="contact">
    <jdoc:include type="modules" name="contact_header"/>
</div>
<div class="header">
        <div class="logo">
            <jdoc:include type="modules" name="logo"/>
        </div>
        <div class="menu">
            <jdoc:include type="modules" name="menu"/>
        </div>
        <div class="mobilemenuicon">
            <jdoc:include type="modules" name="mobileMenuIcon"/>
        </div>
    </div>
<div id="wrappermobile" class="wrappermobile">
    <br>
    <div class="menushort">
        <jdoc:include type="modules" name="mobileMenu"/>
    </div>
</div>
<jdoc:include type="modules" name="slider"/>
<jdoc:include type="modules" name="container"/>
</body>
</html>
