aa<?php
$host = "localhost";
$user = "pdelrossi1";
$pass = "pdelrossi1";
$dbname = "pdelrossi1";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["register"])) {
        // Registration logic
        $input_user = $_POST["username"];
        $input_pass = $_POST["password"];
        $input_confirm_pass = $_POST["confirm_password"];
        $input_email = $_POST["email"];
        $input_user_type = $_POST["user_type"];
        $secret_password = $_POST["secret_password"];

        // Check if the username already exists
        $sql_check_user = "SELECT * FROM users_new WHERE username='$input_user'";
        $result_check_user = $conn->query($sql_check_user);

        if ($result_check_user->num_rows > 0) {
            echo "Username already exists. Please choose a different username.";
        } elseif ($input_pass !== $input_confirm_pass) {
            echo "Passwords do not match. Please re-type the password.";
        } elseif ($input_user_type === "admin" && $secret_password !== "WebProg") {
            echo "Invalid secret password. Admin privileges not granted.";
        } else {
            // Hash the password
            $hashed_pass = password_hash($input_pass, PASSWORD_DEFAULT);

            // Insert user into the database with user_type
            $sql_register = "INSERT INTO users_new (username, password, email, user_type) VALUES ('$input_user', '$hashed_pass', '$input_email', '$input_user_type')";
            
            if ($conn->query($sql_register) === TRUE) {
                // Redirect to login page after successful registration
                header("Location: login.php");
                exit;
            } else {
                echo "Error: " . $sql_register . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="registration.css">
<script>
    function toggleSecretPassword() {
        var userType = document.getElementById("user_type").value;
        var secretPasswordDiv = document.getElementById("secret_password_div");

        if (userType === "admin") {
            secretPasswordDiv.style.display = "block";
            document.getElementById("secret_password").setAttribute("required", "true");
        } else {
            secretPasswordDiv.style.display = "none";
            document.getElementById("secret_password").removeAttribute("required");
        }
    }
</script>


</head>
<body>
<nav>
            <a href="login.php">Login</a>
            <a href="registration.php">Register</a>

</nav> 

<div class="login-container">
    <h1>Registration</h1>
    <div class="input-group">
        <p>Register below</p>
    </div>
    <form action="" method="post">
        <div class="input-group">
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="Username" required><br>
        </div>
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Password" required><br>
        </div>
        <div class="input-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
        </div>
        <div class="input-group">
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Email" required><br>
        </div>
        <div class="input-group">
             <label for="terms">I agree to the terms and conditions</label>
             <input type="checkbox" id="terms" name="terms" required>
        </div>
        <div class="input-group">
            <label for="user_type">User Type:</label>
            <select name="user_type" id="user_type" onchange="toggleSecretPassword()" required>
                <option value="buyer">Buyer</option>
                <option value="seller">Seller</option>
                <option value="admin">Admin</option>
            </select><br>
        </div>
        <div class="input-group">
            <div id="secret_password_div" style="display: none;">
                <label for="secret_password">Secret Password:</label>
                <input type="password" name="secret_password" id="secret_password">
        </div>
    </div>
              <input type="submit" name="register" value="Register">
    </form>
</div>

</body>
</html>
