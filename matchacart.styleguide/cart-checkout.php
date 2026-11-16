<?php
include_once "admin/function.php";

// CHANGE QUANTITY 
if (isset($_POST['id'], $_POST['quantity'])) {
	updateCartItem(intval($_POST['id']), intval($_POST['quantity']), $_POST['packaging'] ?? "");
	header("Location: cart-checkout.php");
	exit;
}

// REMOVE
if (isset($_GET['remove'])) {
	removeFromCart(intval($_GET['remove']), $_GET['packaging'] ?? "");
	header("Location: cart-checkout.php");
	exit;
}

// PRODUCTS IN CART + TOTAL
$products = getCartItems();
$total = array_reduce($products, function($sum, $p) { return $sum + $p->total; }, 0);

// PRODUCT JUST ADDED
$added = isset($_GET['added'])
	? array_find($products, function($p) { return $p->id == intval($_GET['added']); })
	: null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Your Cart | matchacart.</title>
	<?php include "parts/meta.php"; ?>
</head>
<body>
	<?php include "parts/navbar.php"; ?>

	<div class="container">
		<div class="card">
			<h2>Cart</h2>

			<?php if ($added): ?>
				<h2>You added <?= $added->name ?> to your cart</h2>
			<?php endif; ?>

			<?php if (empty($products)): ?>

				<p>Your cart is empty.</p>

			<?php else: ?>

				<?php foreach ($products as $product): ?>
				<div class="order-item">
					<div class="profile-small">
						<img src="img/<?= $product->thumbnail ?>" alt="<?= $product->name ?>">
					</div>

					<div class="order-item-info">
						<h3 class="product-detail-name"><?= $product->name ?></h3>

						<?php if ($product->packaging): ?> 
							<p class="product-detail-desc">Packaging: <?= ucfirst($product->packaging) ?></p>
						<?php endif; ?> 
						<p class="product-detail-price">Price $<?= number_format($product->price, 2) ?></p>

						<form method="post" action="cart-checkout.php">
							<input type="hidden" name="id" value="<?= $product->id ?>">
							<input type="hidden" name="packaging" value="<?= $product->packaging ?>">


							<label for="qty-<?= $product->id ?>-<?= $product->packaging ?>" class="option-label">Quantity</label>
							<?= str_replace("<select", "<select onchange=\"this.form.submit()\"",
								makeSelect(
									"quantity",
									array_combine(range(0, 10), array_merge(["Remove"], range(1, 10))),
									$product->amount,
									"option-select",
									"qty-{$product->id}-{$product->packaging}"
								)) ?>
						</form>

						<p>Subtotal: $<?= number_format($product->total, 2) ?></p>
						<a href="cart-checkout.php?remove=<?= $product->id ?>&packaging=<?= urlencode($product->packaging) ?>">Remove</a>
					</div>
				</div>
				<?php endforeach; ?>

				<h3>Total: $<?= number_format($total, 2) ?></h3>

				<a href="cart-review.php" class="form-button">Continue to Checkout</a>

			<?php endif; ?>

			<a href="product_list.php" class="form-button">Continue Shopping</a>
		</div>
	</div>

	<?php include "parts/footer.php"; ?>
</body>
</html>