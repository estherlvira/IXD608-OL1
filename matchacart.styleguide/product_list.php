<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Product List</title>

	<?php include "parts/meta.php"; ?> 
</head>
<body>
	<?php include "parts/navbar.php"; ?> 
	<?php include "parts/product_cards.php"; ?> 
	<?php include "parts/products.php"; ?> 

<div class="container">
	<div class="header-link">
		<a href="index.php">Home</a>
		<a>></a>
		<a href="product_list.php">Collection</a>
	</div>

	<h2>Explore Premium Matcha Selections</h2>

	<p class="paragraph-content">We source directly from Japan's most storied growing regions, preserving the distinct character each terroir imparts, and offer thoughtfully composed gift boxes for those who wish to share this ritual with others. Every product we carry is chosen not for convenience alone, but for the quiet craftsmanship behind it — because matcha, done right, is never rushed.</p>

</div>

<section class="container">
	<div class="product-grid">
		<?php
		foreach ($products as $product) {
			echo productCard($product);
		}
		?>
	</div>
</section>

<?php include "parts/footer.php"; ?> 

</body>
</html>