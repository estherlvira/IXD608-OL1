<?php
include_once "admin/function.php";

$isFetch  = isset($_SERVER['HTTP_X_REQUESTED_WITH']);
$id       = isset($_POST['id']) ? intval($_POST['id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

$result = makeQuery(makeConn(), "SELECT * FROM `products` WHERE `id` = $id");

if (empty($result) || $quantity < 1) {
	if ($isFetch) {
		header("Content-Type: application/json");
		echo json_encode(["success" => false, "message" => "Product not found."]);
	} else {
		header("Location: product_list.php");
	}
	exit;
}

$product = $result[0];

$allowed = array_map("trim", explode(",", $product->packaging ?? ""));
$packaging = $_POST['packaging'] ?? ""; 

if (!in_array($packaging, $allowed)) $packaging = $allowed[0] ?? ""; 

addToCart($id, $quantity, $packaging); 

if ($isFetch) {
	header("Content-Type: application/json");
	echo json_encode([
		"success"   => true,
		"message"   => "Added $quantity × {$product->name} to your bag.",
		"cartCount" => cartCount()
	]);
} else {
	header("Location: cart-checkout.php?added=$id");
}
exit;