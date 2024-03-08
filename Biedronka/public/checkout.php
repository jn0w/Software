<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biedronka Grocery Store - Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="checkout-container">
        <form action="process_checkout.php" method="post">
            <!-- Input fields for delivery address, etc. -->
            <input type="text" name="address" placeholder="Delivery Address" required>
            <!-- Add more fields as necessary -->
            
            <div class="payment-methods">
                <!-- Payment method options will go here -->
            </div>
            
            <input type="submit" value="Checkout">
        </form>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>
