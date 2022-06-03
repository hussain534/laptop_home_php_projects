<?php

defined('_JEXEC') or die('Restricted access');
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'media/com_shop/css/frontend.css');
$dbcon = mysqli_connect('localhost','merakiprod01','merakiprod01','merakiprod01') or die('Error:DB Connect error.');//IP,user,pwd,db
$products_per_page=20;

?>
<script type="text/javascript">
  $(".category").hide();
</script>
<form method="post" action="index.php?view=shop&amp;layout=registerForm">
	<input type="hidden" name="submitted" value="true" />
	<div class="container login" id="login">  
		<div class="row">
			<div class="col-sm-12">
				<p class="sectionHeader">PLANS</span></p>
			</div>		
		
			<div class="col-sm-4">
				<table class="table table_style">
					<thead>
						<tr>
							<th colspan="2" class="th-style th02">BASICO  <!-- <a href='index.php?view=shop&amp;layout=registerForm'><button type="button" class="btn btn-success Select02">Select</button></a> --></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="td02">MAX PRODUCTS</td>
							<td class="td02">20</td>
						</tr>
						<tr>
							<td class="td02">Cost 1 month</td>
							<td class="td02">$ 20</td>
						</tr>
						<tr>
							<td class="td02">Cost 3 month($ 18/month)</td>
							<td class="td02">$ 54</td>
						</tr>
						<tr>
							<td class="td02">Cost 6 month($ 16/month)</td>
							<td class="td02">$ 96</td>
						</tr>
						<tr>
							<td class="td02">Cost 1 year($ 15/month)</td>
							<td class="td02">$ 180</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-sm-4">
				<table class="table table_style">
					<thead>
						<tr>
							<th colspan="2" class="th-style th03">INTERMEDIO  <!-- <a href='index.php?view=shop&amp;layout=registerForm'><button type="button" class="btn btn-success Select03">Select</button></a> --></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="td03">MAX PRODUCTS</td>
							<td class="td03">40</td>
						</tr>
						<tr>
							<td class="td03">Cost 1 month</td>
							<td class="td03">$ 40</td>
						</tr>
						<tr>
							<td class="td03">Cost 3 month($ 36/month)</td>
							<td class="td03">$ 108</td>
						</tr>
						<tr>
							<td class="td03">Cost 6 month($ 32/month)</td>
							<td class="td03">$ 192</td>
						</tr>
						<tr>
							<td class="td03">Cost 1 year($ 30/month)</td>
							<td class="td03">$ 360</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-sm-4">
				<table class="table table_style">
					<thead>
						<tr>
							<th colspan="2" class="th-style th04">MEGA <!--  <a href='index.php?view=shop&amp;layout=registerForm'><button type="button" class="btn btn-success Select04">Select</button></a> --></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="td04">MAX PRODUCTS</td>
							<td class="td04">> 40</td>
						</tr>
						<tr>
							<td class="td04">Cost 1 month</td>
							<td class="td04">$ 80</td>
						</tr>
						<tr>
							<td class="td04">Cost 3 month($ 72/month)</td>
							<td class="td04">$ 216</td>
						</tr>
						<tr>
							<td class="td04">Cost 6 month($ 64/month)</td>
							<td class="td04">$ 384</td>
						</tr>
						<tr>
							<td class="td04">Cost 1 year($ 60/month)</td>
							<td class="td04">$ 720</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</form>

