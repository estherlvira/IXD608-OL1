<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


if (session_status() === PHP_SESSION_NONE) session_start();

function e($v) {
	return htmlspecialchars($v ?? "");
}

function print_p($v) {
	echo "<pre>", print_r($v, true), "</pre>";
}

function file_get_json($filename) {
	$file = file_get_contents($filename);
	return json_decode($file);
}

include_once "php/auth.php";

function makeConn() {
	$conn = new mysqli(...MYSQLIAuth());
	if ($conn->connect_errno) die($conn->connect_error);
	$conn->set_charset('utf8');
	return $conn;
}

function makeQuery($conn, $qry) {
	$result = $conn->query($qry);
	if ($conn->errno) die($conn->error);
	$a = [];
	while ($row = $result->fetch_object()) {
		$a[] = $row;
	}
	return $a;
}



if (!function_exists('array_find')) {
	function array_find($array, $fn) {
		foreach ($array as $o) if ($fn($o)) return $o;
		return false;
	}
}


function getCart() {
	if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
		$_SESSION['cart'] = [];
	}
	// Keep only new-format items (objects); drop leftovers from the old format
	$_SESSION['cart'] = array_values(array_filter($_SESSION['cart'], 'is_object'));
	return $_SESSION['cart'];
}


function addToCart($id, $amount, $packaging = "") {
	$p = cartItem($id, $packaging); 

	if ($p) {
		$p->amount += $amount;
	} else {
		$_SESSION['cart'][] = (object)[
			"id" => $id,
			"amount" => $amount,
			"packaging" => $packaging, 
		];
	}
}

function resetCart() { $_SESSION['cart'] = []; }

function cartItem($id, $packaging = "") {
	return array_find(getCart(), function($o) use($id, $packaging) { 
		return $o->id == $id && ($o->packaging ?? "") == $packaging; 
	});
}

// CART TOTAL 
function cartCount() {
	return array_reduce(getCart(), function($r, $o) { return $r + $o->amount; }, 0);
}

// CART NAV BADGE
function makeCartBadge() {
	$count = cartCount();
	return $count > 0 ? $count : "";
}

function updateCartItem($id, $amount, $packaging = "") {
	if ($amount < 1) { removeFromCart($id, $packaging); return; }
	$p = cartItem($id, $packaging);
	if ($p) $p->amount = $amount;
}

// CART REMOVE
function removeFromCart($id, $packaging = "") {
	$_SESSION['cart'] = array_values(array_filter(getCart(), function($o) use($id, $packaging) {
		return !($o->id == $id && ($o->packaging ?? "") == $packaging);
	}));
}

function getCartItems() {
	$cart = getCart();
	if (empty($cart)) return [];

	$ids = implode(",", array_unique(array_map(function($o) { return intval($o->id); }, $cart)));
	$rows = makeQuery(makeConn(), "SELECT * FROM `products` WHERE `id` IN ($ids)");

	$byId = [];
	foreach ($rows as $row) $byId[$row->id] = $row;

	$items = [];
	foreach ($cart as $c) {
		if (!isset($byId[$c->id])) continue;   
		$p = clone $byId[$c->id];             
		$p->amount    = $c->amount;
		$p->packaging = $c->packaging ?? "";
		$p->total     = $c->amount * $p->price;
		$items[] = $p;
	}
	return $items;
}

function cartTotals($items, $promo = "") {
	$subtotal = array_reduce($items, function($sum, $p) { return $sum + $p->total; }, 0);
	$discount = strtoupper($promo) === "LABORWEEK" ? round($subtotal * 0.15, 2) : 0;

	return (object)[
		"subtotal" => $subtotal,
		"discount" => $discount,
		"total"    => $subtotal - $discount,
	];
}

function makeSelect($name, $options, $selected = null, $class = "form-select") {
	$isList = array_is_list($options);
	$html = "<select name=\"$name\" id=\"$name\" class=\"$class\">";

	foreach ($options as $value => $label) {
		if ($isList) $value = $label;  
		$sel = ($value == $selected) ? " selected" : "";
		$html .= "<option value=\"" . htmlspecialchars($value) . "\"$sel>"
		       . htmlspecialchars($label) . "</option>";
	}

	return $html . "</select>";
}
