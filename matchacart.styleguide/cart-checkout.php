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
		<div class="card">
				<h2>Cart</h2>
				<div class="order-item">
					<div class="profile-small"></div>

					<div  class="order-item-info">
						
					<h3 class="product-detail-name">Product Name</h3>
					<p class="product-detail-price">Price $0.00</p>
					<p class="product-detail-desc">Product description</p>


						<div class="form-select">
							<select>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
							</select>
						</div>
					</div>
					
				</div>

				<a href="cart-review.php" class="form-button">Continue to Checkout</a>
				<a href="product_list.php" class="form-button">Continue Shopping</a>
		</div>
	</div>

	<?php include "parts/footer.php"; ?> 


</body>
</html>