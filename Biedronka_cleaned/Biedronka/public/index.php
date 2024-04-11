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
    

    <div class="main-content">
    
        <div class="slideshow-container">
            
            <div class="mySlides fade">
                <img src="slide1.jpg" style="width:100%">
            </div>
            <div class="mySlides fade">
                <img src="slide2.jpg" style="width:100%">
            </div>
            <div class="mySlides fade">
                <img src="slide3.jpg" style="width:100%">
            </div>
            
            <div style="text-align:center">
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
            </div>
        </div>

        
        <div class="category-container">
            
            <div class="category">Fruits & Vegetables</div>
            <div class="category">Dairy & Eggs</div>
            
        </div>
    </div>

    <?php include 'footer.php'; ?>
    
    <script src="js/script.js"></script>
</body>
</html>
