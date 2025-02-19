
<?php 

include_once "lib/php/functions.php";
include_once "parts/templates.php";

$product =  makeQuery(makeConn(), "SELECT * FROM `products` WHERE `id`=".$_GET['id'])[0];

$images = explode(",", $product->images);

$image_elements = array_reduce($images, function($r,$o){
	return $r. "<img src = '$o'>";

});
//print_p([$_GET,$_POST,$_SESSION]);

//print_p($_SESSION);

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<?php include "parts/meta.php"; ?>

</head>
<body>
	<?php include "parts/navbar.php"; ?>

	<script src="js/product_thumbs.js"></script>

	<div class="container">
		<div class="grid gap">
			<div class="col-xs-12 col-md-7">
				<div class="card soft">
					<div class="images-main">
						<img src="<?=$product->thumbnail?>" alt="">
					</div>
					<div class="images-thumbs">
						<?= $image_elements?>
					</div>

				</div>
			</div>
			<div class="col-xs-12 col-md-5">
				<form class="card soft flat" method="post" action="cart_actions.php?action=add-to-cart">

					<input type="hidden" name="product-id" value ="<?=$product->id?>">



					<div class="card-section">
							<button class="back-btn"><a href="product_list.php?id=<?=$product->id?>">Go Back</a></button>
						<h2 class="prodcut-name"><?=$product->name?></h2>
						<div class="display-flex">
							<div class="prduct-price flex-none">&dollar;<?=$product->price?></div>
							<div class="flex-stretch"></div>
							<div class="prduct-price flex-none"><?=$product->category?> donut</div>
						</div>
						
						<p class="prduct-description"><?=$product->description?></p>
					</div>
					
					<div class="card-section">		
							<label for="product-amount" class="form-label" style="margin-bottom:0.5em;">Amount</label>
							<div class="form-select">
								<select id="product-amount" name="product-amount">
									<option>1</option>
								    <option>2</option>
								    <option>3</option>
								    <option>4</option>
								    <option>5</option>
								    <option>6</option>
								    <option>7</option>
								    <option>8</option>
								    <option>9</option>
								    <option>10</option>
								</select>
							</div>
					</div>	
					<div class="card-section">
							<label for="product-types" class="form-label" style="margin-bottom:0.5em;">Types</label>
							<div class="form-select">
								<select id="product-types" name="product-types">
									<option>Regular</option>
								    <option>Low Sugar</option>
								    <option>Gluten Free</option>
								</select>	
							</div>	
					</div>
					<div class="card-section">
						<!-- <a href="product_added_to_cart.php?id=<?=$product->id?>" class="form-button">Add To Cart</a> -->
						<input type="submit" class="form-button" value="Add To Cart">

					</div>
				</form>
			</div>
		</div>


	<!--    <div class="card soft dark">
	  		<p class="prduct-description"><?=$product->description?></p>
	   </div> -->

	   <h2>Recommended Products</h2>
	   <?php
	   recommendedSimilar($product->category,$product->id);

	   ?>








	</div>

</body>
</html>