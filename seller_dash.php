<?php
$host = "localhost";
$user = "pdelrossi1";
$pass = "pdelrossi1";
$dbname = "pdelrossi1";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is submitted
    if (isset($_POST["submit_property"])) {
        // Process the form data and insert into the properties table

        // Sanitize and retrieve form data
        $location = mysqli_real_escape_string($conn, $_POST["location"]);
        $age = mysqli_real_escape_string($conn, $_POST["age"]);
        $sqr_feet = mysqli_real_escape_string($conn, $_POST["sqr_feet"]);
        $num_beds = mysqli_real_escape_string($conn, $_POST["num_beds"]);
        $num_bath = mysqli_real_escape_string($conn, $_POST["num_bath"]);
        $y_nGarden = mysqli_real_escape_string($conn, $_POST["y_nGarden"]);
        $parking = mysqli_real_escape_string($conn, $_POST["parking"]);
        $school_prox = mysqli_real_escape_string($conn, $_POST["school_prox"]);
        $mainRoad_prox = mysqli_real_escape_string($conn, $_POST["mainRoad_prox"]);

        // Insert data into properties table
        $sql_insert_property = "INSERT INTO properties (location, age, sqr_feet, num_beds, num_bath, y_nGarden, parking, school_prox, mainRoad_prox)
                               VALUES ('$location', '$age', '$sqr_feet', '$num_beds', '$num_bath', '$y_nGarden', '$parking', '$school_prox', '$mainRoad_prox')";

        if ($conn->query($sql_insert_property) === TRUE) {
            echo "<p>Property details submitted successfully.</p>";
        } else {
            echo "Error: " . $sql_insert_property . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <style>
        /* Add some basic styling for better presentation */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-image: url('background.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            overflow: hidden;
        }

        form {
            width: 400px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Seller Dashboard</h2>

<div id="formContainer">
    <form method="post">
        <!-- Fields -->
        <?php
        $fields = [
            "Where is the location of your property" => "location",
            "How old is your property" => "age",
            "How many square feet is your property? Type a number only." => "sqr_feet",
            "How many beds are there?" => "num_beds",
            "How many bathrooms are there?" => "num_bath",
            "Is there a garden? Type yes or no" => "y_nGarden",
            "Is there parking availability? Type Street, Garage, or None" => "parking",
            "How far is the nearest school? Type an Int" => "school_prox",
            "How far is the main road? Type an Int" => "mainRoad_prox"
        ];

        foreach ($fields as $label => $name) {
            echo '<label>' . $label . '</label>';
            echo '<input type="text" name="' . $name . '">';
        }
        ?>

        <!-- Submit button -->
        <button type="submit" name="submit_property">Submit</button>
    </form>
</div>

</body>
</html>