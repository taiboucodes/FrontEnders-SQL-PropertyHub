<!DOCTYPE html>
<html>
<head>
    <title>Search Database</title>
</head>
<body>
    <h2>Search Database</h2>
    <form action="search_results.php" method="post">
        <textarea name="search_query" placeholder="Search for a specific user by typing the username" cols="50"></textarea><br>
        <input type="submit" value="Search">
        <br><br>
        <textarea name="table_query" placeholder="Type users_new to see the entire specified table" cols="50"></textarea><br>
        <input type="submit" value="Search Table">
    </form>
    <p><a href='index.html'>Return to homepage</a></p>
</body>
</html>
