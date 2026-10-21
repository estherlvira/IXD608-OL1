<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Product List</title>

	<?php include "parts/meta.php"; ?> 
</head>
<body>
	<?php include "parts/navbar.php"; ?> 
	<?php include "parts/products.php"; ?> 

<?php
include "parts/products.php";

$id = $_GET['id'] ?? 1;

$product = null;
foreach ($products as $p) {
	if ($p['id'] == $id) {
		$product = $p;
		break;
	}
}

if ($product === null) {
	$product = $products[0];
}
?>

<div class="container">
	<div class="product-detail">

		<div class="product-detail-image"></div>

		<div class="product-detail-info">
			<div class="category-tags">
				<a href="#" class="category-tag">CATEGORY 1</a>
				<a href="#" class="category-tag">CATEGORY 2</a>
			</div>

			<h3 class="product-detail-name"><?= $product['name'] ?></h3>
			<p class="product-detail-price">$<?= number_format($product['price'], 2) ?></p>
			<p class="product-detail-desc"><?= $product['description'] ?></p>
			<div class="form-select">
				<select>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
				</select>
			</div>

			<p class="product-detail-promo">15% off! Use code LABORWEEK at checkout</p>


			<a href="cart-checkout.php" class="form-button">Add to Bag</a>
		</div>

	</div>

	<?php include "parts/footer.php"; ?> 
</div>


</body>
</html>