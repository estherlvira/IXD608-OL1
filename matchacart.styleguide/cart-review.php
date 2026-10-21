<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Product List</title>

	<?php include "parts/meta.php"; ?> 
</head>
<body>

	<?php include "parts/navbar.php"; ?> 
	
<div class="container">
	<div class="cart">
	<h2 class="cart-title">Cart</h2>

	<div class="cart-row cart-head">
		<span>Product</span>
		<span>Quantity</span>
		<span class="cart-right">Total</span>
	</div>

	<div class="cart-row cart-item">
		<div class="cart-product">
			<div class="cart-image"></div>
			<div>
				<h3 class="cart-name">Product name</h3>
				<p class="cart-price">$0.00</p>
			</div>
		</div>

		<div class="qty">
			<button type="button" class="qty-btn">−</button>
			<span class="qty-num">1</span>
			<button type="button" class="qty-btn">+</button>
		</div>

		<p class="cart-right">$0.00</p>
	</div>

	<div class="cart-footer">
		<div class="cart-note">
			<label for="order-note" class="form-label">Add order note</label>
			<textarea id="order-note" rows="4"></textarea>
		</div>

		<div class="cart-summary">
			<p class="cart-total">Total $0.00</p>
			<p class="cart-small">Taxes and shipping calculated at checkout</p>
			<a href="cart-confirmation.php" class="cart-checkout">Checkout</a>
		</div>
	</div>
</div>

</div>

	<?php include "parts/footer.php"; ?> 


</body>
</html>