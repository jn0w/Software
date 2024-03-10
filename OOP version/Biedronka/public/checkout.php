<?php
session_start();
// Check if the basket is empty
if (!isset($_SESSION['basket']) || empty($_SESSION['basket'])) {
    header('Location: products.php'); // Redirect to products page if basket is empty
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Biedronka Grocery Store</title>
    <link rel="stylesheet" href="../style.css">
    <script src="../js\payment_toggle.js"></script>
</head>
<body>
<?php include 'navbar.php'; ?>
    <h1>Checkout</h1>
    <form method="post" action="process_checkout.php">
        <div>
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>
        </div>
        <div>
            <label for="contact_number">Contact Number:</label>
            <input type="tel" id="contact_number" name="contact_number" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
    <p>Payment Method:</p>
    <input type="radio" id="pay_card" name="payment_method" value="card" checked>
    <label for="pay_card">Pay by Card</label><br>
    <input type="radio" id="pay_cash" name="payment_method" value="cash">
    <label for="pay_cash">Pay Cash on Delivery</label>
    </div>

    <div id="card_details" style="display: none;">
    <div>
        <label for="card_number">Card Number:</label>
        <input type="text" id="card_number" name="card_number">
    </div>
    <div>
        <label for="expiry_date">Expiry Date:</label>
        <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY">
    </div>
    <div>
        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv">
    </div>
    </div>


        <input type="submit" value="Place Order">
    </form>
    

</body>
</html>
