<?php
session_start();

// Function to add a product to the cart
function addToCart($product_id) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }
}

// Function to remove a product from the cart
function removeFromCart($product_id) {
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

// Handle adding a product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    addToCart($product_id);
    header("Location: cart_view.php"); // Redirect to cart view
    exit();
}
// Handle removing a product
elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_product_id'])) {
    $product_id = $_POST['remove_product_id'];
    removeFromCart($product_id);
    header("Location: cart_view.php"); // Redirect to cart view
    exit();
} else {
    // Redirect if accessed directly without a product ID
    header("Location: index.php");
    exit();
}
?>
