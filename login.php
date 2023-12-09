<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

$host = "localhost";
$user = "pdelrossi1";
$pass = "pdelrossi1";
$dbname = "pdelrossi1";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login"])) {
        // Login logic
        $input_user = $_POST["username"];
        $input_pass = $_POST["password"];

        // Validate login credentials against the database
        $sql_login = "SELECT * FROM users_new WHERE username='$input_user'";
        $result = $conn->query($sql_login);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $stored_pass = $row["password"];

            // Verify the hashed password
            if (password_verify($input_pass, $stored_pass)) {
                $_SESSION["loggedin"] = true;
                header("Location: index.html");
                exit;
            } else {
                echo '<div class="login-container">';
                echo "Invalid username or password.";
                echo '</div>';
            }
        } else {
            echo '<div class="login-container">';
            echo "Invalid username or password.";
            echo '</div>';
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.html">Home</a>
        <a href="login.php">Login</a>
        <a href="registration.php">Register</a>
        <a href="seller_dash.php">Seller Dashboard</a>
        <a href="search.php">Search Database</a>
    </nav> 
    <div class="login-container">
    <h1>Login</h1>
    <form action="" method="post">
        <div class="input-group">
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="Email" required><br>
        </div>
        <div class="input-group">
            <label for="username">Password:</label>
            <input type="password" name="password" placeholder="Password" required><br>
        </div>
        <input type="submit" name="login" value="Login"><br><br>
        <div class="input-group">
            <div class="register">
                <img src="register.png" alt="register">
        </div>
            <a href="registration.php">Register</a>
        </div>
        <div class="input-group">
            <div class="lock">
                <img src="lock.png" alt="lock">
            </div>
            <a href="#">Forgot Password?</a>
        </div>
    </form>
</div>

</body>
</html>
