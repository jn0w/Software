<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Biedronka Grocery Store</title>
    <link rel="stylesheet" href="../css/checkout.css">
    
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="checkout-container">
        <h2>Checkout</h2>
        <form method="post" action="process_checkout.php">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="contact_number">Contact Number:</label>
            <input type="text" id="contact_number" name="contact_number" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="PayPal">PayPal</option>
            </select>

            <button type="submit">Place Order</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
