<!-- Navbar HTML -->
<nav id="navbar">
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <a href="basket.php">Basket</a>
        <!-- Add any other links you need here -->
    </div>
    <div id="search-bar">
        <form action="search.php" method="get">
            <input type="text" name="query" placeholder="Search for products...">
            <button type="submit">Search</button>
        </form>
    </div>
</nav>

<!-- Navbar Styles -->
<style>
    .navbar {
        background-color: #333;
        overflow: hidden;
        padding: 0;
        margin: 0;
    }

    .navbar a {
        float: left;
        display: block;
        color: white;
        text-align: center;
        padding: 14px 20px;
        text-decoration: none;
    }

    .navbar a:hover {
        background-color: #ddd;
        color: black;
    }

    #search-bar {
        float: right;
    }

    #search-bar input[type="text"] {
        padding: 6px;
        margin-top: 8px;
        font-size: 17px;
        border: none;
    }

    #search-bar button {
        padding: 6px;
        margin-top: 8px;
        margin-right: 16px;
        background: #ddd;
        font-size: 17px;
        border: none;
        cursor: pointer;
    }

    #search-bar button:hover {
        background: #ccc;
    }
</style>
