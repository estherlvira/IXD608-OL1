<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Checkout Page</title>

	<?php include "parts/meta.php"; ?> 
</head>
<body>
	<?php include "parts/navbar.php"; ?> 
	
	<div class="container">
		<div class="card soft">
			<h2>Product Checkout</h2>

		<h3>Address<h3>
		<form>
			<div class="form-control">
				<label class="form-label">Street Name</label>
				<input type="text" placeholder="Street Name" class="form-input">
			</div>

			<div class="form-control">
				<label class="form-label">City</label>
				<input type="text" placeholder="City" class="form-input">
			</div>

			<div class="form-control">
				<label class="form-label">State</label>
				<input type="text" placeholder="State" class="form-input">
			</div>

			<div class="form-control">
				<label class="form-label">Zip Code</label>
				<input type="number" placeholder="Zip Code" class="form-input">
			</div>

			<div class="form-control">
				<label class="form-label">Country</label>
				<input type="text" placeholder="Country" class="form-input">
			</div>

	
		</form>

		<h3>Payment</h3>

		<form>
			<div class="form-control">
				<label class="form-label">Full Name</label>
				<input type="text" placeholder="Name" class="form-input">
			</div>

			<div class="form-control">
				<label class="form-label">Card Number</label>
				<input type="number" placeholder="####-####-####-####" class="form-input">
			</div>

			<div class="form-control">
				<label class="form-label">Expiration</label>
				<input type="number" placeholder="MM-YY" class="form-input">
			</div>

			<div class="form-control">
				<label class="form-label">CVV</label>
				<input type="number" placeholder="CVV" class="form-input">
			</div>

			<div class="form-control">
				<label class="form-label">Zip Code</label>
				<input type="number" placeholder="Zip Code" class="form-input">
			</div>

		</form>

		
			<a href="product-confirmation.php" class="form-button">Complete Checkout</a>

		</div>
	</div>

	<?php include "parts/footer.php"; ?> 


</body>
</html>