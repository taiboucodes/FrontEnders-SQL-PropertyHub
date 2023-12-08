<?php
$host = "localhost";
$user = "pdelrossi1";
$pass = "pdelrossi1";
$dbname = "pdelrossi1";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_query = $_POST["search_query"];
    $table_query = $_POST["table_query"];

    // Perform search in the users_new table for a specific username
    if (!empty($search_query) && empty($table_query)) {
        $sql_user_search = "SELECT * FROM users_new WHERE username = '$search_query'";
        $result_user_search = $conn->query($sql_user_search);

        echo "<h2>Search Results</h2>";

        if ($result_user_search->num_rows > 0) {
            echo "<h3>Users</h3>";
            while ($row = $result_user_search->fetch_assoc()) {
                echo "Username: " . $row["username"] . "<br>";
            }
        } else {
            echo "User not found.";
        }
    }

    // Perform search for the entire specified table
    if (!empty($table_query)) {
        $table_query = strtolower($table_query);

        // Display the entire specified table
        echo "<h3>Entire Specified Table</h3>";

        if ($table_query === "users_new") {
            $sql_table = "SELECT * FROM users_new";
            $result_table = $conn->query($sql_table);

            // Display all rows and columns, including user_type
            echo "<table border='1'>";
            echo "<tr><th>Username</th><th>Password</th><th>Email</th><th>User Type</th></tr>";

            while ($row = $result_table->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["password"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["user_type"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Invalid table specified.";
        }
    }

    echo "<p><a href='index.html'>Return to homepage</a></p>";
    echo "<p><a href='search.php'>Return to search</a></p>";
}

$conn->close();
?>
