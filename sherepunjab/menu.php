<!doctype html>
<html lang="en">
 <head>
	<title>Sher-e-Punjab | Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/google-api-jquery-ui.css">
	<script type="text/javascript" src="js/jquery-2.1.3.min.js" ></script>
	<script type="text/javascript" src="js/cycle2.js" ></script>
	<script type="text/javascript" src="js/myjs.js" ></script>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	<link href='https://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Courgette' rel='stylesheet' type='text/css'>


	<style>


	#sectionA,#sectionB,#sectionC,#sectionD {padding-top:50px;min-height:500px;}
	#dropdown1,#dropdown2 {padding-top:50px;min-height:500px;}

	/*#sectionA {padding-top:50px;color: #fff; background-color: #1E88E5;min-height:500px;}
	#sectionB {padding-top:50px;color: #fff; background-color: #673ab7;min-height:500px;}
	#dropdown1 {padding-top:50px;color: #fff; background-color: #ff9800;min-height:500px;}

	#secA.active>a {color: #fff; background-color: #1E88E5;}
	#secB.active>a {color: #fff; background-color: #673ab7;}
	#secC.active>a {color: #fff; background-color: #ff9800;}*/
	.mydiv12
	{
		#min-height: 375px;
		background: black;
		color: white;
		padding: 20px;
	}
	.footer
	{
		#min-height: 12px;
		line-height: 18px;		
		font-size: 12px;
		background: #222;
		color: white;
		padding: 3px;
		#border: 1px solid white;
	}

  </style>
 </head>
 <body>
	<nav class="navbar navbar-inverse" style="margin:0 !important;">
	  <div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>                        
		      </button>
		  <a class="navbar-brand" href="#" style="padding:0 15px !important"><img src="images/logo01.jpg" width="200px !important" height="51px !important" border="0" alt=""></a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
			  <li><a href="index.php">Home</a></li>
			  <li><a href="aboutUs.php">About Us</a></li>
			  <li class="active"><a href="#">Menu</a></li> 
			  <li><a href="http://localhost/restaurant/" target="#">Services</a></li>
			  <li><a href="gallery.php">Gallery</a></li>
			  <li><a href="contactUs.php">Contact Us</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			  <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
			  <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			</ul>

		</div>
	  </div>
	</nav>

	

	<div class="bs-example">
    <ul class="nav nav-tabs" id="myTab">
        <li id="secA"><a data-toggle="tab" href="#sectionA">Starters</a></li>
        <li id="secB"><a data-toggle="tab" href="#sectionB">Chicken</a></li>
        <li id="secC"><a data-toggle="tab" href="#sectionC">Mutton</a></li>
        <li id="secD"><a data-toggle="tab" href="#sectionD">Sea Food</a></li>
        <li id="secE" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Drinks <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a data-toggle="tab" href="#dropdown1">Non-alcoholic Drinks</a></li>
                <li><a data-toggle="tab" href="#dropdown2">Alcoholic Drinks</a></li>
            </ul>
        </li>
    </ul>
    <div class="tab-content" style="min-height:500px;">
        <div id="sectionA" class="tab-pane fade">
			<div class="row"  style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/chickentikka.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Chicken Tikka</h2></p>
					<p><h4>Pieces of tender boneless chicken marinated in a blend of dry, Indian Spices and yogurt. Cooked in charcoal tandoor. Served with mint chutney and fresh salad</h4></p>
					<p><i>(Tiernas piezas de pollo deshuesado, marinado en una mezcla de especies y yogurt cocinado en tandoor. Servido con salsa de menta.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$7.95</h4></p>
				</div>			
			</div>
			<div class="row"  style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/seekh-kabab.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Seekh Kebab</h2></p>
					<p><h4>Fenely minced finger rolls of chicken seasoned with exotic herbs and spices then grilled on skewers in our clay oven.</h4></p>
					<p><i>(Finamente picada rollos dedo de pollo sazonado con hierbas y species exóticas a continuación, la parilla en broches en nuestro horno de barro.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$10.95</h4></p>
				</div>			
			</div>
			<div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/tandoori-chicken.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Tandoori Chicken<img src="images/spicy.png"><img src="images/chef.png"></h2></p>
					<p><h4>Whole pieces of chicken marinated with Indian spices, yogurt, cooked in our tandoor and served with salad and mint chutney.</h4></p>
					<p><i>(Deliciosas piezas de pollo macerado en especias, yogurt, ensalada y cocinado en tandoor. Servido con ensalada y salsa de menta.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$10.95</h4></p>
				</div>			
			</div>			
			<div class="row"  style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/chicken-tikka-tandori.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Chicken Tikka Tandorri</h2></p>
					<p><h4>Pieces of tender boneless chicken marinated in indias spices, cooked in Charcoal tandoor and served with ninit chutney and fresh salad</h4></p>
					<p><i>(Tiernas piezas de pollo deshuesado. Macerado en una mezcla de especies y cocinado en tandoor. Servido con salsa de menta.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$7.95</h4></p>
				</div>			
			</div>
			<div class="row"  style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/samosa-with-chutney.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Veg Samosa with Chutney</h2></p>
					<p><h4>Tradicional indian starter. Patty  shells filled with potates, vegetales and spices. Fried in pan served with tamarind chutney.</h4></p>
					<p><i>(Bocaditos tradicionales hindu muy parecido a las empanadas, relleno con papas, verduras especies. Servido con salsa de tamarindo.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$3.99</h4></p>
				</div>			
			</div>
        </div>
        <div id="sectionB" class="tab-pane fade in active">
            <div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/chicken-mushrooms.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Chicken Mashroom<img src="images/spicy.png"><img src="images/chef.png"></h2></p>
					<p><h4>Chicken curry cooked with fresh mishroom and spices</h4></p>
					<p><i>(Curry de pollo cocido con setas frescas y especies)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$10.95</h4></p>
				</div>			
			</div>
			<div class="row"  style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/chickenJalfrezi.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Chicken JalFrezi<img src="images/spicy.png"><img src="images/chef.png"></h2></p>
					<p><h4>Chicken cooked with fresh carrost, potatoes, peas and other seasonal vegetables</h4></p>
					<p><i>(Pollo cocido con zanahorias, patatas, guisantes y oras verdura de temporada)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$8.99</h4></p>
				</div>			
			</div>
			<div class="row"  style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/chicken-dopiaza.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Chicken Do-pyaja<img src="images/spicy.png"><img src="images/chef.png"></h2></p>
					<p><h4>Chicken cooked with onions and curry of indian spices</h4></p>
					<p><i>(Pollo cocinado con trozos de cebolla y salsa espesa)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$10.95</h4></p>
				</div>			
			</div>
			<div class="row"  style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/butter-chicken.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Butter Chicken ( Pollo en curry de mantequilla )<img src="images/chef.png"></h2></p>
					<p><h4>Tender chunks of  boneless chicken cooked in tondooor and prepared.</h4></p>
					<p><i>(Tomato trozos de pollo deshuesado cocidas en salsa de tomate, mantequilla y especies.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$10.95</h4></p>
				</div>			
			</div>
			<div class="row"  style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/chicken-tikka-masala.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Chicken Tikka Masala( Pollo en curry de mantequilla )<img src="images/chef.png"></h2></p>
					<p><h4>Oven- baked cubet bonelless chicken cookes un a creamy curry..</h4></p>
					<p><i>(Trozos de pollo deshuesado cocido al horno en cremoso curry y especies.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$10.95</h4></p>
				</div>			
			</div>
			<div class="row"  style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/chicken-karahi.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Chicken Karahi<img src="images/chef.png"></h2></p>
					<p><h4>Succulet chicken simmered in a mildy spices curry sauce.</h4></p>
					<p><i>(Exquisito pollo macerado en churri cocido con aromáticas especias.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$10.95</h4></p>
				</div>			
			</div>
			<div class="row"  style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/chickenRoganJosh.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Chicken Rogan Josh<img src="images/chef.png"></h2></p>
					<p><h4>Hot chicken curry prepared in tomato saucew with a toch of cocnut and vinegar, A deliciou Goan Favorite.</h4></p>
					<p><i>(Pollo en curry picante al estilo de Goa, con un toque de vinagre y coco.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$10.95</h4></p>
				</div>			
			</div>
			<div class="row"  style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/chicken-korma.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Chicken Korma<img src="images/chef.png"></h2></p>
					<p><h4>Chicken cookedin aromatic curry Ruth yogourt, cashews and indian spices.</h4></p>
					<p><i>(Pollo cocinado en aromático curry de kaju, yogurt y aromática especias de la  india.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$10.95</h4></p>
				</div>			
			</div>
			<div class="row"  style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/chicken-kofta.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Chicken Kofta<img src="images/chef.png"></h2></p>
					<p><h4>Stuffed chicken & vegetable rolled together and cooked in mildly spiced creamy onions curry</h4></p>
					<p><i>(Bolitas rellenas de pollo cocinadas en curry hecho de cebolla.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$10.95</h4></p>
				</div>			
			</div>
        </div>
		<div id="sectionC" class="tab-pane fade in active">
            <div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/muttonMasala.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Mutton Masala<img src="images/spicy.png"><img src="images/chef.png"></h2></p>
					<p><h4>Pieces of lamb meatcooked in our homemade curry</h4></p>
					<p><i>(Trozos de carne de cordero cocido en delicico curry.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$11.95</h4></p>
				</div>			
			</div>
			<div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/mutton-korma.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Mutton Korma<img src="images/spicy.png"><img src="images/chef.png"></h2></p>
					<p><h4>Lamb cooked in aromatic curry with yogourt, cashews and indian spices.</h4></p>
					<p><i>(Trozos de carne de cordero cocinado en delicioso curry, yogurt, nueces y especies de la india.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$11.95</h4></p>
				</div>			
			</div>
			<div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/muttondopyaja.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Mutton Do Pyaja<img src="images/spicy.png"><img src="images/chef.png"></h2></p>
					<p><h4>Pieces of lamb meat cooked in onion gravy</h4></p>
					<p><i>(Cordero cocinado con trozos de cebolla y salsa espesa ( suave o picante).)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$11.95</h4></p>
				</div>			
			</div>
			<div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/muttonmughlai.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Mutton Mughlai<img src="images/spicy.png"><img src="images/chef.png"></h2></p>
					<p><h4>Boneless cubes of lamd cooked with mushrooms in chef so special curry sauce with touch of cream.</h4></p>
					<p><i>(Cubos de cordero deshuesado con champiñones en chef salsa de curry con un toque de crema.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$11.95</h4></p>
				</div>			
			</div>
		</div>
        <div id="sectionD" class="tab-pane fade in active">
            <div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/fishCurry.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Fish Curry<img src="images/spicy.png"><img src="images/chef.png"></h2></p>
					<p><h4>Pieces of fish cooked in a tradicional curry and flavoured, with sauteed onions tomatoes.</h4></p>
					<p><i>(Deliciosos trozosd e pescado cocina en curry, tomates cebollas.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$10.95</h4></p>
				</div>			
			</div>
			<div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/fishGoanCurry.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Fish Goan Curry<img src="images/spicy.png"><img src="images/chef.png"></h2></p>
					<p><h4>Pieces of fish cooked in a delicious Goan style sauce with coriander arvej and dried cocunut.</h4></p>
					<p><i>(Trazos de pescado cocinados en deliciosa salsa estilo Goa con semillas de culantro y coco, seco.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$10.95</h4></p>
				</div>			
			</div>
			<div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/prawnMalaiCurry.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Prawn Malai Curry<img src="images/spicy.png"><img src="images/chef.png"></h2></p>
					<p><h4>Prawns cooked in a aromatic sauce with ground cashew nuts, cream and mild spices.</h4></p>
					<p><i>(Langostinos cocinados en aromática salsa con nueces y especies.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$10.95</h4></p>
				</div>			
			</div>
			<div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/prawn-masala.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Prawn Masala<img src="images/spicy.png"><img src="images/chef.png"></h2></p>
					<p><h4>Prawn cooked in a tradition curry, flavoret with sautéed, onions and tomatoes.</h4></p>
					<p><i>(Langostinos cocinados en curry, tomates. Cebollas y especies.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$10.95</h4></p>
				</div>			
			</div>
		</div>
        <div id="dropdown1" class="tab-pane fade">
            <div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/mango-lassi.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Mango Lassi<img src="images/spicy.png"><img src="images/chef.png"></h2></p>
					<p><h4>A sweet refreshing blebd of yogurt, fresh maongo and  a secret spice.</h4></p>
					<p><i>(Refrescante bebida tradicional a base de mango. Yogurt y una especie secreta.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$2.25</h4></p>
				</div>			
			</div>
			<div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/lassi_plain.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Plain Lassi<img src="images/spicy.png"><img src="images/chef.png"></h2></p>
					<p><h4>Sweet or salty drink with plain yogurt y especias.</h4></p>
					<p><i>(Tipica bebida dulce o salada a base de yogurt y species)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$1.99</h4></p>
				</div>			
			</div>
			<div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/tea.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Indian Tea-Chai<img src="images/spicy.png"><img src="images/chef.png"></h2></p>
					<p><h4>Indian tea with milk, cardomom and ginger</h4></p>
					<p><i>(Te de la India con leche, cardomomo y jengibre.)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$1.99</h4></p>
				</div>			
			</div>
			<div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/juices.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-9">
					<p><h2>Natural Juices<img src="images/spicy.png"><img src="images/chef.png"></h2></p>
					<p><h4>Blackberry, strawberry , guava , naranjilla , pineapple, orange , guava , passion fruit , melon , watermelon , peach.</h4></p>
					<p><i>(Mora, frutilla, guanábana, naranjilla, piña, naranja, guayaba, maracuyá, melón, sandia, durazno)</i></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$2.5</h4></p>
				</div>			
			</div>
        </div>
        <div id="dropdown2" class="tab-pane fade">
            <div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/pilsner.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-3">
					<p><h4>Cerveza Pilsner</h4></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$1.99</h4></p>
				</div>
				<div class="col-sm-2">
					<img src="images/clubRoja.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-3">
					<p><h4>Cerveza Club Roja</h4></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$2.5</h4></p>
				</div>			
			</div>
			<div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/clubVerde.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-3">
					<p><h4>Cerveza Club Verde</h4></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$2.25</h4></p>
				</div>
				<div class="col-sm-2">
					<img src="images/budweiser.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-3">
					<p><h4>Cerveza Budweiser</h4></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$2.25</h4></p>
				</div>			
			</div>
			<div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/donadominga.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-3">
					<p><h4>Vino - Dona Domingo</h4></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$27.99</h4></p>
				</div>
				<div class="col-sm-2">
					<img src="images/casillerodeldiablo.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-3">
					<p><h4>Vino - Casillero del Diablo</h4></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$31.99</h4></p>
				</div>			
			</div>
			<div class="row" style="margin:0 0 10px 0 !important">
				<div class="col-sm-2">
					<img src="images/bluenun.jpg" style="width:100%;">					
				</div>
				<div class="col-sm-3">
					<p><h4>Vino - Blue Nun</h4></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$24.99</h4></p>
				</div>
				<div class="col-sm-2">
					<img src="images/elReservado.png" style="width:100%;">					
				</div>
				<div class="col-sm-3">
					<p><h4>El Reservado</h4></p>
				</div>
				<div class="col-sm-1">
					<p><h4>$24.99</h4></p>
				</div>			
			</div>
        </div>
    </div>
</div>










	<div class="row" style="margin:0 !important;background:black;">
		<div class="col-sm-3 mydiv12">
			<div class="divdt9">
				<ul>
					<li>Home</li>
					<li>About Us</li>
					<li>Menu</li>
					<li>Our Services</li>
					<li>Gallery</li>
					<li>Contact Us</li>
				</ul>
			</div>
		</div>
		<div class="col-sm-3 mydiv12">
			<div class="divdt9">
				<ul>
					<li>Starters</li>
					<li>Salad</li>
					<li>Vegeterian</li>
					<li>Chicken</li>
					<li>Mutton</li>
					<li>Sea-Food</li>
					<li>Rice Items</li>
					<li>Nans and Deserts</li>
					<li>Drinks</li>
					<li>Alcohol</li>
				</ul>
			</div>
		</div>
		<div class="col-sm-6 mydiv12">
			<div class="divdt9">
				<ul>
					<li>We accept all credits cards</li>					
					<li><img src="images/creditCards04.png"></li>
					<li>Conect With us</li>
					<li>
						<img src="images/facebook.png" style="width:12% !important">
						<img src="images/youtube.png" style="width:12% !important">
						<img src="images/twitter.png" style="width:12% !important">
						<img src="images/linkedin.png" style="width:12% !important">
					</li>
				</ul>
				
			</div>
		</div>
	</div>
	<div class="row" style="margin:0 !important;">		
		<div class="col-sm-12 footer">
			<div class="divdt12">
				MERAKI MINDS CIA LTDA &copy;2015. All rights reserved.
			</div>
		</div>
	</div>

	

 </body>
</html>
