<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project 4</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="login-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h1>Login Here</h1>
            <div class="input-group">
                <label for="username">Email:</label>
                <input type="text" id="username" name="username" required placeholder="Email">
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required placeholder="Password">
            </div><br>
            <button type="submit" name="signup">Log in</button>
            <div class="login-link">
                <img src="" alt="">
                <a href="signup.php">Register</a>
            </div>
            <div class="login-link">
                <img src="lock.png" alt="lock" id="lock">
                <a href="index.php">Forgot Password?</a>
            </div>
        </form>
    </div>

</body>
</html>