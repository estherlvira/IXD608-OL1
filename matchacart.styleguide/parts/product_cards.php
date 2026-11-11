<?php
function productCard($product) {
	$price = number_format($product->price, 2);

	return <<<HTML
	<div class="product-card">
		<div class="product-image">
			<img src="img/{$product->thumbnail}" alt="{$product->name}">
		</div>

		<h2 class="product-title">{$product->name}</h2>
		<p class="product-price">\$$price</p>

		<div class="row actions">
			<div class="flex-none">
				<a href="product_item.php?id={$product->id}" class="btn-primary">Add to Bag</a>
			</div>
			<div class="flex-stretch"></div>
			<div class="flex-none">
				<button class="btn-icon" aria-label="Save">♡</button>
			</div>
		</div>
	</div>
	HTML;
}