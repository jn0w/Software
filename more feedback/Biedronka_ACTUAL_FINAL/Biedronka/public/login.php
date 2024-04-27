<!-- login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Biedronka Grocery Store</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <?php
    if (isset($_SESSION['error_message'])) {
        echo '<p style="color: red;">' . $_SESSION['error_message'] . '</p>';
        // Clear the error message after it's displayed
        unset($_SESSION['error_message']);
    }
    ?>

    <form action="authenticate.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Login">
    </form>
</body>

</html>
