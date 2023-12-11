<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
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

    
    $host = "localhost";
    $user = "pdelrossi1";
    $pass = "pdelrossi1";
    $dbname = "pdelrossi1";
    $conn = new mysqli($host, $user, $pass, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
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

    
    if ($conn->query($sqlUpdate) === TRUE) {
        
        echo 'Property updated successfully.';
    } else {
       
        echo 'Error updating property: ' . $conn->error;
    }


    $conn->close();
}
?>
