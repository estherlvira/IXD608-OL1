<?php
include_once "admin/function.php";

// CHANGE QUANTITY
if (isset($_POST['id'], $_POST['quantity'])) {
	updateCartItem(intval($_POST['id']), intval($_POST['quantity']), $_POST['packaging'] ?? "");
	header("Location: cart-review.php");
	exit;
}

$products = getCartItems();
$totals   = cartTotals($products);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cart | matchacart.</title>
	<?php include "parts/meta.php"; ?>
</head>
<body>
	<?php include "parts/navbar.php"; ?>

	<div class="container cart">
		<h1 class="cart-title">Cart</h1>

		<?php if (empty($products)): ?>

			<p>Your cart is empty.</p>
			<a href="product_list.php" class="cart-checkout">Shop Matcha</a>

		<?php else: ?>

			<div class="cart-row cart-head">
				<span>Product</span>
				<span>Quantity</span>
				<span class="cart-right">Total</span>
			</div>

			<?php foreach ($products as $product): ?>
			<div class="cart-row cart-item">
				<div class="cart-product">
					<img class="cart-image" src="img/<?= $product->thumbnail ?>" alt="<?= $product->name ?>">
					<div>
						<h3 class="cart-name"><?= $product->name ?></h3>
						<?php if ($product->packaging): ?>
							<p class="cart-price"><?= ucfirst($product->packaging) ?></p>
						<?php endif; ?>
						<p class="cart-price">$<?= number_format($product->price, 2) ?></p>
					</div>
				</div>

				<div class="qty">
					<form method="post" action="product-checkout.php">
						<input type="hidden" name="id" value="<?= $product->id ?>">
						<input type="hidden" name="packaging" value="<?= $product->packaging ?>">
						<input type="hidden" name="quantity" value="<?= $product->amount - 1 ?>">
						<button type="submit" class="qty-btn" aria-label="Decrease quantity">−</button>
					</form>

					<span class="qty-num"><?= $product->amount ?></span>

					<form method="post" action="cart-review.php">
						<input type="hidden" name="id" value="<?= $product->id ?>">
						<input type="hidden" name="packaging" value="<?= $product->packaging ?>">
						<input type="hidden" name="quantity" value="<?= $product->amount + 1 ?>">
						<button type="submit" class="qty-btn" aria-label="Increase quantity">+</button>
					</form>
				</div>

				<p class="cart-right">$<?= number_format($product->total, 2) ?></p>
			</div>
			<?php endforeach; ?>

			<form method="post" action="product-checkout.php" class="cart-footer">
				<div class="cart-note">
					<label for="note" class="cart-small">Add order note</label>
					<textarea id="note" name="note" rows="5"></textarea>
				</div>

				<div class="cart-summary">
					<p>Total $<?= number_format($totals->total, 2) ?></p>
					<p class="cart-small">Taxes and shipping calculated at checkout</p>

					<a href="product-checkout.php" button type="submit" class="cart-checkout">Checkout</a>
				</div>
			</form>

			<?php endif; ?>
	</div>

	<?php include "parts/footer.php"; ?>
</body>
</html>