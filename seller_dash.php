<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// Database configuration
$host = "localhost";
$user = "pdelrossi1";
$pass = "pdelrossi1";
$dbname = "pdelrossi1";

// Establish database connection
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM properties";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="dash.css">
</head>
<body>
    <nav class="nav-bar">
        <div>
            <a href="index.html">Home</a>
            <a href="login.php">Login</a>
            <a href="registration.php">Register</a>
            <a href="seller_dash.php">Seller Dashboard</a>
            <a href="search.php">Search Database</a>
        </div>
        <div>
            <span class="nav-welcome">Welcome, <?php echo htmlspecialchars(isset($_SESSION["username"]) ? $_SESSION["username"] : "User"); ?> !</span>
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
    </nav>

<div id="formContainer" style="display: none;">
    <form id="propertyForm" method="post" action="#" enctype="multipart/form-data">
        <label for="location">Location:</label>
        <input type="text" name="location" required><br>

        <label for="age">Age:</label>
        <input type="number" name="age" required><br>

        <label for="sqr_feet">Square Feet:</label>
        <input type="number" name="sqr_feet" required><br>

        <label for="num_beds">Number of Bedrooms:</label>
        <input type="number" name="num_beds" required><br>

        <label for="num_bath">Number of Bathrooms:</label>
        <input type="number" name="num_bath" required><br>

        <label for="y_nGarden">Is there a garden?:</label>
        <input type="checkbox" name="y_nGarden" required><br>

        <label for="parking">Select Parking Option:</label>
        <select id="parking" name="parking">
            <option value="garage">Garage</option>
            <option value="public">Public</option>
            <option value="none">None</option>
        </select>

        <label for="school_prox">Proximity to school in miles:</label>
        <input type="number" name="school_prox" required><br>

        <label for="mainRoad_prox">Proximity to main road in miles:</label>
        <input type="number" name="mainRoad_prox" required><br>

       

        <button type="submit" onclick="addProperty()">Submit Property</button>
        <button type="button" onclick="goBack()">Back</button>
    </form>
</div><br>

<button id="addPropertyBtn">Add Property</button>

<div id="propertyList" class="card-container">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $location = $row["location"];
        $age = $row["age"];
        $sqr_feet = $row["sqr_feet"];
        $num_beds = $row["num_beds"];
        $num_bath = $row["num_bath"];
        $y_nGarden = $row["y_nGarden"];
        $parking = $row["parking"];
        $school_prox = $row["school_prox"];
        $mainRoad_prox = $row["mainRoad_prox"];
    ?>

<div class="card" id="property_<?php echo $id; ?>">
    <a href="#" class="property-link" onclick="showPropertyDetails(
        '<?php echo $location; ?>',
        '<?php echo $sqr_feet; ?>',
        '<?php echo $age; ?>',
        '<?php echo $num_beds; ?>',
        '<?php echo $num_bath; ?>',
        '<?php echo $y_nGarden; ?>',
        '<?php echo $parking; ?>',
        '<?php echo $school_prox; ?>',
        '<?php echo $mainRoad_prox; ?>'
    )">
        <h1><?php echo $location; ?></h1>
        <p>Square Feet: <?php echo $sqr_feet; ?></p>
    </a>
    <button onclick="deleteProperty(<?php echo $id; ?>)">Delete</button>
</div>


    <?php
    }
    mysqli_close($conn);
    ?>
</div>
<script src="addProperty.js"></script>
</body>
</html>
