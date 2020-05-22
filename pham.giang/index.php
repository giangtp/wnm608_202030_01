<?
	require_once "library/php/functions.php";
	require_once "partials/templates.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Comikz</title>
	<?php include "partials/head.html"; ?>
</head>
<body>
	
	<?php include "partials/header.php"; ?>

	<div class="content">
		<div class="view-window hero" style="background-image:url(images/general/banner_1.jpg)">
			<div>
				<h1>Collecting Manga and Comics.</h1>
				<h1>All in One Place.</h1>
			</div>
		</div>
		
		<div class="container pad">
			<div class="card card-flat">
				<h1 class="center">Why Comikz?</h1>
				<div class="grid gap xs-large push-down">
					<div class="col-xs-12 col-md-4">
						<div class="card-center image-thumbnail">
							<img src="images/general/collections.png" alt="Collection">
						</div>
						<hr class="spacer small">
						<div style="text-align: center;">
							<h3>DIVERSE COLLECTION</h3>
							<span>Special editions of popular and niche titles!</span>
						</div>
					</div>
					<div class="col-xs-12 col-md-4">
						<div class="card-center image-thumbnail">
							<img src="images/general/deals.png" alt="Deals">
						</div>
						<hr class="spacer small">
						<div style="text-align: center;">
							<h3>GREAT DEALS</h3>
							<span>Reasonable pricing with lots of deals!</span>
						</div>
					</div>
					<div class="col-xs-12 col-md-4">
						<div class="card-center image-thumbnail">
							<img src="images/general/gifts.png" alt="Gifts">
						</div>
						<hr class="spacer small">
						<div style="text-align: center;">
							<h3>BONUS GIFTS</h3>
							<span>Giveaway opportunities at your door!</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="spacer">

		<div class="view-window" style="background-image:url(images/general/banner_2.jpg)">
			<a class="form-button secondary" href="product_list.php" style="width: 10em; font-size: 2em;">Shop Now</a>
		</div>

		<hr class="spacer">
		<div class="container pad">
			<h2>Featured Products</h2>
			<hr class="spacer small">
			<div class="grid gap">
				 <?php

				 	$data = getData("
						SELECT * 
						FROM `products`
						ORDER BY rand() 
						LIMIT 3
				 		");

	                echo array_reduce($data,'featuredTemplate');
	             ?>
			</div>
		</div>
	</div>

	<?php include "partials/footer.php"; ?>

</body>
</html>