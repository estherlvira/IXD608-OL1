<?php
include_once "admin/function.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$products = getCartItems();

	if (empty($products)) {
		header("Location: cart-checkout.php");
		exit;
	}

$_SESSION['last_order'] = (object)[
	"number"  => "MC" . date("ymd") . rand(1000, 9999),
	"items"   => $products,
	"totals"  => cartTotals($products, $_SESSION['promo'] ?? ""),
	"note"    => trim($_POST['note'] ?? ""),
	"name"    => trim($_POST['name'] ?? ""),
	"address" => (object)[
		"street"  => trim($_POST['street'] ?? ""),
		"city"    => trim($_POST['city'] ?? ""),
		"state"   => trim($_POST['state'] ?? ""),
		"zip"     => trim($_POST['zip'] ?? ""),
		"country" => trim($_POST['country'] ?? ""),
	],
];

	resetCart();
	unset($_SESSION['promo']);

	header("Location: cart-confirmation.php");
	exit;
}

$order = $_SESSION['last_order'] ?? null;

if (!$order) {
	header("Location: product_list.php");
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Order Confirmation | matchacart.</title>
	<?php include "parts/meta.php"; ?>
</head>
<body>
	<?php include "parts/navbar.php"; ?>

	<div class="container">

		<div class="card">
			<h3 class="h3-bold">
				Thank you, <?=e($order->name)?> for your purchase!
			</h3>
			<p>Your order number is <strong>#<?= $order->number ?></strong>.</p>
			<a href="product_list.php" class="form-button">Back to Shop</a>
		</div>

		<div class="card">
			<h3 class="h3-bold">Order</h3>

			<?php if (!empty($order->address)): ?>
				<p>Delivery Address:
					<?= e($order->address->street) ?>,
					<?= e($order->address->city) ?>, <?= e($order->address->state) ?> <?= e($order->address->zip) ?>,
					<?= e($order->address->country) ?>
				</p>
			<?php endif; ?>

			<?php if ($order->note): ?>
				<p>Order note: <?= e($order->note) ?></p>
			<?php endif; ?>

			<ol class="tracker" style="--progress: 0.15">
				<li class="tracker-step done">
					<span class="tracker-dot">✓</span>
					<span>Processing</span>
				</li>
				<li class="tracker-step">
					<span class="tracker-dot"></span>
					<span>Shipped</span>
				</li>
				<li class="tracker-step">
					<span class="tracker-dot"></span>
					<span>Out for delivery</span>
				</li>
				<li class="tracker-step">
					<span class="tracker-dot"></span>
					<span>Delivered</span>
				</li>
			</ol>
		</div>

		<div class="card border">
			<p>Arriving in 3–6 business days</p>
			<h2>Order Summary</h2>

			<?php foreach ($order->items as $product): ?>
			<div class="order-item">
				<div class="profile-small">
					<img src="img/<?= $product->thumbnail ?>" alt="<?= $product->name ?>">
				</div>

				<div class="order-item-info">
					<h3><?= $product->name ?></h3>
					<?php if ($product->packaging): ?>
						<p><?= ucfirst($product->packaging) ?></p>
					<?php endif; ?>
					<p>Qty <?= $product->amount ?> × $<?= number_format($product->price, 2) ?></p>
					<p><strong>$<?= number_format($product->total, 2) ?></strong></p>
				</div>
			</div>
			<?php endforeach; ?>

			<?php if ($order->totals->discount > 0): ?>
				<p>Discount: −$<?= number_format($order->totals->discount, 2) ?></p>
			<?php endif; ?>
			<h3>Total: $<?= number_format($order->totals->total, 2) ?></h3>
		</div>

	</div>

	<?php include "parts/footer.php"; ?>
</body>
</html>