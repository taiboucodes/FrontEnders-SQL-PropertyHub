<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("HTTP/1.1 403 Forbidden");
    exit("Forbidden");
}

// Database configuration
$host = "localhost";
$user = "pdelrossi1";
$pass = "pdelrossi1";
$dbname = "pdelrossi1";

// Establish database connection
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    header("HTTP/1.1 500 Internal Server Error");
    exit("Internal Server Error");
}

// Retrieve form data
$location = $_POST["location"];
$age = $_POST["age"];
$square_footage = $_POST["sqr_feet"];
$num_bedrooms = $_POST["num_beds"];
$num_bathrooms = $_POST["num_bath"];
$garden = isset($_POST["y_nGarden"]) ? 1 : 0;
$parking = isset($_POST["parking"]) ? 1 : 0;
$proximity = $_POST["school_prox"];
$main_roads = $_POST["mainRoad_prox"];

// Insert data into the properties table
$sql = "INSERT INTO properties (location, age, sqr_feet, num_beds, num_bath, y_nGarden, parking, school_prox, mainRoad_prox, images_blob)
 VALUES ('$location', '$age', '$square_footage', '$num_bedrooms', '$num_bathrooms', '$garden', '$parking', '$proximity', '$main_roads', '$img_data')";

$result = mysqli_query($conn, $sql);

// Check if the property was successfully added
if ($result) {
    // Return a response indicating success
    header("HTTP/1.1 200 OK");
    exit("Property successfully added");
} else {
    // Return a response indicating failure
    header("HTTP/1.1 500 Internal Server Error");
    exit("Internal Server Error");
}

mysqli_close($conn);
?>
