<?php
include_once "admin/function.php";

if (empty(getCart())) {
	header("Location: cart-checkout.php");
	exit;
}

$note = $_POST['note'] ?? "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Checkout | matchacart.</title>
	<?php include "parts/meta.php"; ?>
</head>
<body>
	<?php include "parts/navbar.php"; ?>

	<div class="container">
		<div class="card soft">
			<h2>Product Checkout</h2>

			<form method="post" action="cart-confirmation.php">
				<input type="hidden" name="note" value="<?= htmlspecialchars($note) ?>">

				<h3>Address</h3>

				<div class="form-control">
					<label class="form-label" for="street">Street Name</label>
					<input type="text" id="street" name="street" placeholder="Street Name" class="form-input" autocomplete="street-address" required>
				</div>

				<div class="form-control">
					<label class="form-label" for="city">City</label>
					<input type="text" id="city" name="city" placeholder="City" class="form-input" autocomplete="address-level2" required>
				</div>

				<div class="form-control">
					<label class="form-label" for="state">State</label>
					<input type="text" id="state" name="state" placeholder="State" class="form-input" autocomplete="address-level1" required>
				</div>

				<div class="form-control">
					<label class="form-label" for="zip">Zip Code</label>
					<input type="text" id="zip" name="zip" placeholder="Zip Code" class="form-input" inputmode="numeric" autocomplete="postal-code" required>
				</div>

				<div class="form-control">
					<label class="form-label" for="country">Country</label>
					<input type="text" id="country" name="country" placeholder="Country" class="form-input" autocomplete="country-name" required>
				</div>

				<h3>Payment</h3>

				<div class="form-control">
					<label class="form-label" for="fullname">Full Name</label>
					<input type="text" id="fullname" name="name" placeholder="Name" class="form-input" autocomplete="name" required>
				</div>


				<div class="form-control">
					<label class="form-label" for="card">Card Number</label>
					<input type="text" id="card" placeholder="####-####-####-####" class="form-input" inputmode="numeric" autocomplete="off" required>
				</div>

				<div class="form-control">
					<label class="form-label" for="exp">Expiration</label>
					<input type="text" id="exp" placeholder="MM/YY" class="form-input" inputmode="numeric" autocomplete="off" required>
				</div>

				<div class="form-control">
					<label class="form-label" for="cvv">CVV</label>
					<input type="text" id="cvv" placeholder="CVV" class="form-input" inputmode="numeric" autocomplete="off" required>
				</div>

				<div class="form-control">
					<label class="form-label" for="billzip">Billing Zip Code</label>
					<input type="text" id="billzip" placeholder="Zip Code" class="form-input" inputmode="numeric" autocomplete="off" required>
				</div>

				<button type="submit" class="cart-checkout">Complete Checkout</button>

			</form>
		</div>
	</div>

	<?php include "parts/footer.php"; ?>
</body>
</html>