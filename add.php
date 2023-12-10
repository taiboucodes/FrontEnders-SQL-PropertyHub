<?php

$location = $_POST["location"];
$age = $_POST["age"];
$square_footage = $_POST["sqr_feet"];
$num_bedrooms = $_POST["num_beds"];
$num_bathrooms = $_POST["num_bath"];
$garden = isset($_POST["y_nGarden"]) ? 1 : 0;
$parking = isset($_POST["parking"]) ? 1 : 0;
$proximity = $_POST["school_prox"];
$main_roads = $_POST["mainRoad_prox"];
$img_data = addslashes(file_get_contents($_FILES['images_blob']['tmp_name']));

$sql = "INSERT INTO properties (location, age, sqr_feet, num_beds, num_bath, y_nGarden, parking, school_prox, mainRoad_prox, images_blob)
 VALUES ('$location', '$age', '$square_footage', '$num_bedrooms', '$num_bathrooms', '$garden', '$parking', '$proximity', '$main_roads', '$img_data')";

$result = mysqli_query($conn, $sql);

// Check if the property was successfully added
if ($result) {
    header("Location: seller_dash.php");
} else {
    header("Location: index.html");
}

// Close the database connection
mysqli_close($conn);
?>
