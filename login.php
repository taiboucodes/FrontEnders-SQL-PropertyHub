<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

$host = "localhost";
$user = "pdelrossi1"; // Your database username
$pass = "pdelrossi1"; // Your database password
$dbname = "pdelrossi1"; // Your database name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    // Login logic
    $input_user = $_POST["username"];
    $input_pass = $_POST["password"];

    
    $stmt = $conn->prepare("SELECT id, username, password FROM users_new WHERE username = ?");
    $stmt->bind_param("s", $input_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_pass = $row["password"];

        
        if (password_verify($input_pass, $stored_pass)) {
         
            $_SESSION["loggedin"] = true;
            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["username"];

           
            header("Location: index.html");
            exit;
        } else {
            $login_error = "Invalid username or password.";
        }
    } else {
        $login_error = "Invalid username or password.";
    }

    $stmt->close();
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
        <a href="login.php">Login</a>
        <a href="registration.php">Register</a>
    </nav>
    <div class="login-container">
        <h1>Login</h1>
        <form action="" method="post">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" name="username" placeholder="username" required><br>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" required><br>
            </div>
            <input type="submit" name="login" value="Login">
            <?php if(isset($login_error)): ?>
                <p><?php echo $login_error; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
