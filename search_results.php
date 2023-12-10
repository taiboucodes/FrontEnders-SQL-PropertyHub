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
    $search_query = trim($_POST["search_query"]);
    $table_query = trim($_POST["table_query"]);
    $property_query = trim($_POST["property_query"]);

    // Perform search in the users_new table for a specific username
    if (!empty($search_query) && empty($table_query) && empty($property_query)) {
        $search_query = $conn->real_escape_string($search_query); // Use real_escape_string to prevent SQL injection
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

    
    if (!empty($table_query) && empty($search_query) && empty($property_query)) {
        $table_query = strtolower($table_query);

    
        echo "<h3>Entire Specified Table</h3>";

        if ($table_query === "users_new") {
            $sql_table = "SELECT * FROM users_new";
            $result_table = $conn->query($sql_table);

            
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

    // Perform search for all property listings
    if (!empty($property_query) && strtolower($property_query) === "properties" && empty($search_query) && empty($table_query)) {
        $sql_property_table = "SELECT * FROM properties";
        $result_property_table = $conn->query($sql_property_table);

        echo "<h3>All Property Listings</h3>";

        echo "<table border='1'>";
        echo "<tr><th>Location</th><th>Age</th><th>Square Feet</th><th>Beds</th><th>Baths</th><th>Garden</th><th>Parking</th><th>School Proximity</th><th>Main Road Proximity</th><th>Property Tax</th><th>Creator Username</th></tr>";

        while ($row = $result_property_table->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["location"] . "</td>";
            echo "<td>" . $row["age"] . "</td>";
            echo "<td>" . $row["sqr_feet"] . "</td>";
            echo "<td>" . $row["num_beds"] . "</td>";
            echo "<td>" . $row["num_bath"] . "</td>";
            echo "<td>" . $row["y_nGarden"] . "</td>";
            echo "<td>" . $row["parking"] . "</td>";
            echo "<td>" . $row["school_prox"] . "</td>";
            echo "<td>" . $row["mainRoad_prox"] . "</td>";
            echo "<td>" . $row["prop_tax"] . "</td>";
            echo "<td>" . $row["creator_username"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }

    echo "<p><a href='index.html'>Return to homepage</a></p>";
    echo "<p><a href='search.php'>Return to search</a></p>";
}

$conn->close();
?>
