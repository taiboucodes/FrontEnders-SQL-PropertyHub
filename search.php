<!DOCTYPE html>
<html>
<head>
    <title>Search Database</title>
    <link href="search.css "rel="stylesheet">
</head>
<body>
        <nav>
            <a href="index.html">Home</a>
            <a href="login.php">Login</a>
            <a href="registration.php">Register</a>
            <a href="seller_dash.php">Seller Dashboard</a>
            <a href="search.php">Search Database</a>
        </nav> 
    <div class="login-container">  
    <h2>Search Database</h2>
    <form action="search_results.php" method="post">
        <textarea name="search_query" placeholder="Search for a specific user by typing the username" cols="50"></textarea><br>
        <input type="submit" value="Search">
        <br><br>
        <textarea name="table_query" placeholder="Type users_new to see the entire username table" cols="50"></textarea><br>
        <input type="submit" value="Search Table">
        <br><br>
        <textarea name="property_query" placeholder="Type properties to retrieve all property listings" cols="50"></textarea><br>
        <input type="submit" value="Search Properties">
    </form>
    <p><a href='index.html'>Return to homepage</a></p>
    </div>  
</body>
</html>
