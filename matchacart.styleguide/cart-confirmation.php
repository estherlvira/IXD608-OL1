<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Order Confirmation</title>

	<?php include "parts/meta.php"; ?> 
</head>
<body>

	<?php include "parts/navbar.php"; ?> 

<div class="container">
	<div class="card">
		<h3 class="h3-bold">Order</h3>
		<p>Delivery Address: 1234 Lorem Ipsum</p>

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
			<p>Arriving in 3-6 business days</p>
			<h2>Order Summary</h2>
			<div class="order-item">
				<div class="profile-small"></div>

				<div  class="order-item-info">
					<h3>Product Name</h3>
					<p>Product description</p>
					<p>Price $0.00</p>
				</div>
			</div>
		</div>

	<?php include "parts/footer.php"; ?> 

	</div>
</div>