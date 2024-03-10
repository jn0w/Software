<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Basket - Biedronka Grocery Store</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php 
include 'navbar.php';
session_start();
require_once '../src/ProductManager.php';
$productManager = new ProductManager();

// Initialize total price
$totalPrice = 0;

if (!isset($_SESSION['basket']) || empty($_SESSION['basket'])) {
    echo "<p>Your basket is empty.</p>";
} else {
    echo "<h1>Your Basket</h1>";
    echo "<ul>";

    foreach ($_SESSION['basket'] as $productId => $quantity) {
        // Fetch product object from the database
        $product = $productManager->getProductById($productId);
        if ($product) {
            echo "<li>";
            echo "<div class='basket-item'>";
            echo "<span class='item-name'>" . htmlspecialchars($product->getName()) . "</span>";
            echo "<span class='item-quantity'> - Quantity: " . htmlspecialchars($quantity) . "</span>";
            echo "<span class='item-price'> - Price: €" . htmlspecialchars(number_format($product->getPrice(), 2)) . "</span>";
            echo "<span class='item-subtotal'> - Subtotal: €" . htmlspecialchars(number_format($product->getPrice() * $quantity, 2)) . "</span>";
            echo "<form method='post' action='remove_from_basket.php' style='display: inline;'>";
            echo "<input type='hidden' name='product_id' value='" . htmlspecialchars($product->getId()) . "'>";
            echo "<button type='submit' class='remove-button'>Remove</button>";
            echo "</form>";
            echo "</div>";
            echo "</li>";

            // Update total price
            $totalPrice += ($product->getPrice() * $quantity);
        }
    }

    echo "</ul>";
    echo "<strong>Total Price: €" . number_format($totalPrice, 2) . "</strong>";
    echo '<a href="products.php">Continue Shopping</a> | <a href="checkout.php">Checkout</a>';
}
?>
<?php include 'footer.php'; ?>
</body>
</html>
