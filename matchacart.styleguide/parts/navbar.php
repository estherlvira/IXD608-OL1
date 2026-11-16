<?php

include_once "admin/function.php"; 

?> 


<header class="navbar">
	<div class="container navbar-inner">
		<h2 class="h2-light navbar-logo">matchacart.</h2>

		<input type="checkbox" id="nav-toggle" class="nav-toggle">
		<label for="nav-toggle" class="nav-toggle-label" aria-label="Open menu">☰</label>

		<div class="navbar-menu">
			<form class="navbar-search">
				<input type="search" class="hotdog" placeholder="Search">
			</form>

			<nav class="nav">
				<ul>
					<li><a href="index.php">HOME</a></li>
					<li><a href="product_list.php">SHOP</a></li>t

					<li><a href="cart-checkout.php" class="nav-cart">
						CART
						<span class="cart-badge" id="cart-count"><?= makeCartBadge() ?></span>
					<li></a>

					
					</a></li>
				</ul>
			</nav>
		</div>
	</div>
</header>