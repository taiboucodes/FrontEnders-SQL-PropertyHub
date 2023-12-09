<?php
    $host = "localhost";
    $user = "pdelrossi1";
    $pass = "pdelrossi1";
    $dbname = "pdelrossi1";
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create users_new table
    $sql_users_new = "CREATE TABLE users_new (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL
    )";

    if ($conn->query($sql_users_new) === TRUE) {
        echo "Table 'users_new' created successfully\n";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $conn->close();
?>
