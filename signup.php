<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "Sadekin767#";
    $database = "sims";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Signup successful!";
            header('Location: index.php'); 
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    ?>

    <div class="login-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h1>Sign Up Here</h1>
            <div class="input-group">
                <label for="username">Email:</label>
                <input type="text" id="username" name="username" required placeholder="Email">
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required placeholder="Password">
            </div>
            <br>
            <button type="submit" name="signup">Sign up</button> 
            <div class="login-link">
                Already have an account? <a href="index.php"> <br> Log in</a>
            </div>       
        </form>
    </div>

</body>
</html>