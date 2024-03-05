<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biedronka Grocery Store - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div id="main-content">
        <!-- Slideshow container -->
        <div class="slideshow-container">
            <!-- Full-width images with number and caption text -->
            <div class="mySlides fade">
                <img src="slide1.jpg" style="width:100%">
            </div>
            <div class="mySlides fade">
                <img src="slide2.jpg" style="width:100%">
            </div>
            <div class="mySlides fade">
                <img src="slide3.jpg" style="width:100%">
            </div>
            <!-- The dots/circles -->
            <div style="text-align:center">
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
            </div>
        </div>

        <!-- Product Categories -->
        <div class="category-container">
            <!-- PHP code to dynamically load categories -->
            <div class="category">Fruits & Vegetables</div>
            <div class="category">Dairy & Eggs</div>
            <!-- Add more categories here -->
        </div>
    </div>

    <?php include 'footer.php'; ?>
    
    <script src="script.js"></script>
</body>
</html>
