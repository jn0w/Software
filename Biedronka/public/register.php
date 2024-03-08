<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Biedronka Grocery Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Register</h2>
    <form method="post" action="register_user.php">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" required>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <label for="address">Address:</label>
        <input type="text" name="address" id="address">

        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" id="contact_number">

        <!-- This hidden input field is used to define the user role -->
        <input type="hidden" name="role" value="customer">

        <input type="submit" value="Register">
    </form>
</body>
</html>
