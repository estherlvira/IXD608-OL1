<?php
include_once "admin/function.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$result = makeQuery(makeConn(), "SELECT * FROM `products` WHERE `id` = $id");

if (empty($result)) {
	header("Location: product_list.php");
	exit;
}

$product = $result[0];
$price = number_format($product->price, 2);

$images = !empty($product->images)
	? array_map("trim", explode(",", $product->images))
	: [$product->thumbnail];

$packagingOptions = !empty($product->packaging)
	? array_map("trim", explode(",", $product->packaging))
	: []; 
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

			<div class="product-gallery">
				<div class="product-detail-image">
					<img id="main-image" src="img/<?= $images[0] ?>" alt="<?= $product->name ?>">
				</div>

				<?php if (count($images) > 1): ?>
				<div class="product-detail-thumbs">
					<?php foreach ($images as $index => $img): ?>
						<button type="button"
							class="thumb <?= $index === 0 ? 'active' : '' ?>"
							data-src="img/<?= $img ?>"
							aria-label="View image <?= $index + 1 ?>">
							<img src="img/<?= $img ?>" alt="">
						</button>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>

			<div class="product-detail-info">
				<div class="category-tags">
					<span class="category-tag"><?= $product->category ?></span>
				</div>

				<h2><?= $product->name ?></h2>
				<p class="product-price">$<?= $price ?></p>
				<p><?= $product->description ?></p>

				<form id="add-to-cart-form" method="post" action="cart_add.php">
					<input type="hidden" name="id" value="<?= $product->id ?>">


					<?php if (count($packagingOptions) > 1): ?> 
						<div class="option-field">
							<label for="packaging" class="option-label">Packaging</label>
							<?= makeSelect("packaging", $packagingOptions, null, "option-select") ?> 
						</div>
					<?php elseif (count($packagingOptions) == 1): ?> 
						<input type="hidden" name="packaging" value="<?= $packagingOptions[0] ?>">
					<?php endif; ?> 

					<div class="option-field">
						<label for="quantity" class="option-label">Quantity</label>
						<?= makeSelect("quantity", range(1, 10), null, "option-select") ?> 
					</div>
					
					<p>15% off! Use code LABORWEEK at checkout</p>

					<button type="submit" class="btn-primary">Add to Bag</button>
					<p id="cart-message" class="cart-message" aria-live="polite"></p>

				</form>
			</div>

		</div>
	</div>

	<?php include "parts/footer.php"; ?>

/* PHOTO GALLERY */ 
<script>
document.querySelectorAll(".thumb").forEach(function (thumb) {
	thumb.addEventListener("click", function () {
		document.getElementById("main-image").src = thumb.dataset.src;
		document.querySelectorAll(".thumb").forEach(function (t) {
			t.classList.remove("active");
		});
		thumb.classList.add("active");
	});
});


const cartForm = document.getElementById("add-to-cart-form");

if (cartForm) {
	cartForm.addEventListener("submit", function (e) {
		e.preventDefault();

		const button  = cartForm.querySelector("button[type=submit]");
		const message = document.getElementById("cart-message");
		const id      = cartForm.querySelector('input[name="id"]').value;
		button.disabled = true;
		message.textContent = "Adding…";

		fetch("cart_add.php", {
			method: "POST",
			headers: { "X-Requested-With": "fetch" },
			body: new FormData(cartForm)
		})
		.then(function (response) { return response.text(); })
		.then(function (text) {
			let data;
			try {
				data = JSON.parse(text);
			} catch (err) {
				console.error("cart_add.php did not return JSON:\n", text);
				throw new Error("Server error, open the Console to see details.");
			}

			if (data.success) {
				const count = document.getElementById("cart-count");
				if (count) count.textContent = data.cartCount;
				window.location.href = "cart-checkout.php?added=" + id;
			} else {
				message.textContent = data.message;
				button.disabled = false;
			}
		})
		.catch(function (error) {
			message.textContent = error.message;
			button.disabled = false;
		});
	});
}


</script>
	
</body>
</html>