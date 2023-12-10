<?php
session_start();

// Check if the user is not logged in, redirect to login page
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $propertyId = $_POST['property_id'];
    $location = $_POST['location'];
    $age = $_POST['age'];
    $sqrFeet = $_POST['sqr_feet'];
    $numBeds = $_POST['num_beds'];
    $numBath = $_POST['num_bath'];
    $y_nGarden = isset($_POST['y_nGarden']) ? $_POST['y_nGarden'] : 'No';
    $parking = $_POST['parking'];
    $schoolProx = $_POST['school_prox'];
    $mainRoadProx = $_POST['mainRoad_prox'];

    // Perform the update query
    $sqlUpdate = "UPDATE properties SET
        location = '$location',
        age = '$age',
        sqr_feet = '$sqrFeet',
        num_beds = '$numBeds',
        num_bath = '$numBath',
        y_nGarden = '$y_nGarden',
        parking = '$parking',
        school_prox = '$schoolProx',
        mainRoad_prox = '$mainRoadProx'
        WHERE id = '$propertyId'";

    if (mysqli_query($conn, $sqlUpdate)) {
        // Successfully updated
        echo 'Property updated successfully.';
    } else {
        // Error in update
        echo 'Error updating property: ' . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}
?>