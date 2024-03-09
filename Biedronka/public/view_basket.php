<?php
session_start();
require_once '../src/ProductManager.php';

// Initialize ProductManager
$productManager = new ProductManager();

// Initialize total price
$totalPrice = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Basket - Biedronka Grocery Store</title>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="../style.css"> <!-- Ensure the path to style.css is correct -->
</head>
<body>
<?php include 'navbar.php'; ?>
<?php
// Check if the basket exists
if (!isset($_SESSION['basket']) || empty($_SESSION['basket'])) {
    echo "Your basket is empty.";
} else {
    $basket = $_SESSION['basket'];
    echo "<h1>Your Basket</h1>";
    echo "<ul>";

    foreach ($basket as $productId => $quantity) {
        // Fetch product details from the database
        $product = $productManager->getProductById($productId);
        echo "<li>";
        echo "<div class='basket-item'>";
        echo "<span class='item-name'>" . htmlspecialchars($product['name']) . "</span>";
        echo "<span class='item-quantity'> - Quantity: " . htmlspecialchars($quantity) . "</span>";
        echo "<span class='item-price'> - Price: €" . htmlspecialchars(number_format($product['price'], 2)) . "</span>";
        echo "<span class='item-subtotal'> - Subtotal:€" . htmlspecialchars(number_format($product['price'] * $quantity, 2)) . "</span>";
        echo "<form method='post' action='remove_from_basket.php' style='display: inline;'>";
        echo "<input type='hidden' name='product_id' value='" . htmlspecialchars($productId) . "'>";
        echo "<button type='submit' class='remove-button'>Remove</button>";
        echo "</form>";
        echo "</div>";
        echo "</li>";

        // Update total price
        $totalPrice += ($product['price'] * $quantity);
    }

    echo "</ul>";
    echo "<strong>Total Price: €" . $totalPrice . "</strong>";
    // Link to the page where the user can check out or continue shopping
    echo '<a href="products.php">Continue Shopping</a> | <a href="checkout.php">Checkout</a>';
}
?>
</body>
</html>
