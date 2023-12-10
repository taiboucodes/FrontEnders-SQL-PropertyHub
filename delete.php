<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

$host = "localhost";
$user = "pdelrossi1";
$pass = "pdelrossi1";
$dbname = "pdelrossi1";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];

$sql = "DELETE FROM properties WHERE id = $id";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);

?>
