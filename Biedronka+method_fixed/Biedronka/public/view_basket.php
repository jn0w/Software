<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Basket - Biedronka Grocery Store</title>
    <link rel="stylesheet" href="../css/viewbasket.css">

</head>
<body>
<?php 
session_start(); 
include 'navbar.php'; 
require_once '../src/ProductManager.php'; 
//create a new product manager instance
$productManager = new ProductManager();
//variable to store the total price
$totalPrice = 0;
?>

<div class="basket-container">
    <?php
    // Check if the basket session variable exists and is not empty
    if (!isset($_SESSION['basket']) || empty($_SESSION['basket'])) {
        echo "<p>Your basket is empty.</p>";
    } else {
        echo "<h1>Your Basket</h1>";

        //loop through each item in the basket
        foreach ($_SESSION['basket'] as $productId => $quantity) {
            //get product details from database
            $product = $productManager->getProductById($productId);
            if ($product) {
                echo "<div class='basket-item'>";
                echo "<span class='item-name'>" . htmlspecialchars($product->getName()) . "</span>";
                echo "<span class='item-quantity'>Quantity: " . htmlspecialchars($quantity) . "</span>";
                echo "<span class='item-price'>Price: €" . htmlspecialchars(number_format($product->getPrice(), 2)) . "</span>";
                echo "<span class='item-subtotal'>Subtotal: €" . htmlspecialchars(number_format($product->getPrice() * $quantity, 2)) . "</span>";
                echo "<form method='post' action='remove_from_basket.php' style='display: inline;'>";
                echo "<input type='hidden' name='product_id' value='" . htmlspecialchars($product->getId()) . "'>";
                echo "<button type='submit' class='remove-button'>Remove</button>";
                echo "</form>";
                echo "</div>";

                $totalPrice += ($product->getPrice() * $quantity);
            }
        }

        echo "<div class='total-price'>Total Price: €" . number_format($totalPrice, 2) . "</div>";
    }
    ?>
    <div class="action-buttons">
        <a href="products.php">Continue Shopping</a>
        <a href="checkout.php">Checkout</a>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
