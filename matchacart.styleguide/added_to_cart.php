<?php
session_start();
include "admin/function.php";

$id       = isset($_POST['id']) ? intval($_POST['id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

// Make sure the product exists
$result = makeQuery(makeConn(), "SELECT * FROM `products` WHERE `id` = $id");
if (empty($result) || $quantity < 1) {
	header("Location: product_list.php");
	exit;
}
$product = $result[0];

// Add to the cart (stored in the session)
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

if (isset($_SESSION['cart'][$id])) {
	$_SESSION['cart'][$id] += $quantity;   // already in cart: add more
} else {
	$_SESSION['cart'][$id] = $quantity;    // new item
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Added to Bag | matchacart.</title>
	<?php include "parts/meta.php"; ?>
</head>
<body>
	<?php include "parts/navbar.php"; ?>

	<div class="container">
		<h2>Added to your bag</h2>
		<p><?= $quantity ?> × <?= $product->name ?></p>

		<a href="product_list.php" class="btn-primary">Continue Shopping</a>
		<a href="cart.php" class="btn-primary">View Bag</a>
	</div>

	<?php include "parts/footer.php"; ?>
</body>
</html>