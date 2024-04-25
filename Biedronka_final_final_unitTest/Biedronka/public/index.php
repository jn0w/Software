<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biedronka Grocery Store - Home</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="brand-area">
       
        <h1>Biedronka Your Best Corner Store</h1>
    </div>
    
    <div class="content-area">
        <div class="feature-section">
            <h2>Weekly Specials</h2>
            <img src="../images/special.png" alt="Weekly Specials">
            <p>Don't miss out on our amazing deals across all departments!</p>
            <a href="products.php" class="button">Shop Now</a>
        </div>
        
        <div class="slideshow-container">
            <!-- Navigation arrows -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

            <!-- Slides -->
            <div class="mySlides fade">
            <a href="products.php"> <img src="../images/apple.png" style="width:100%"> </a>
            </div>
            <div class="mySlides fade">
            <a href="products.php"> <img src="../images/milk.png" style="width:100%"> </a>
            </div>
            <div class="mySlides fade">
            <a href="products.php"> <img src="../images/egg.png" style="width:100%"> </a>
            </div>

            <!-- Dots navigation -->
            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span> 
                <span class="dot" onclick="currentSlide(2)"></span> 
                <span class="dot" onclick="currentSlide(3)"></span> 
            </div>
        </div>
        
        <div class="cta-section">
            <h2>Become a member today!</h2>
            <img src="../images/member.png" alt="Newsletter">
            <p>Register today to me a memeber of the best corner store in the market.</p>
            <a href="register.php" class="button">Register Today!</a>
        </div>
    </div>

  

    <?php include 'footer.php'; ?>
    
    <script src="../js/script.js"></script>
</body>
</html>
