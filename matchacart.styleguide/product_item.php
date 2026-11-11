<?php
include "admin/function.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$result = makeQuery(makeConn(), "SELECT * FROM `products` WHERE `id` = $id");


$product = $result[0];
$price = number_format($product->price, 2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $product->name ?> | matchacart.</title>
	<?php include "parts/meta.php"; ?>
</head>
<body>
	<?php include "parts/navbar.php"; ?>

	<div class="container">
		<div class="product-detail">

			<div class="product-detail-image">
				<img src="img/<?= $product->thumbnail ?>" alt="<?= $product->name ?>">
			</div>

			<div class="product-detail-info">
				<div class="category-tags">
					<span class="category-tag"><?= $product->category ?></span>
				</div>

				<h2><?= $product->name ?></h2>
				<p class="product-price">$<?= $price ?></p>
				<p><?= $product->description ?></p>

				<form method="post" action="added_to_cart.php">
					<input type="hidden" name="id" value="<?= $product->id ?>">

					<select name="quantity">
						<?php for ($i = 1; $i <= 10; $i++): ?>
							<option value="<?= $i ?>"><?= $i ?></option>
						<?php endfor; ?>
					</select>

					<p>15% off! Use code LABORWEEK at checkout</p>

					<button type="submit" class="btn-primary">Add to Bag</button>
				</form>
			</div>

		</div>
	</div>

	<?php include "parts/footer.php"; ?>
</body>
</html>