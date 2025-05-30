<?php
$error_message = $_GET['error'] ?? '';
if (isset($_COOKIE['status']) && $_COOKIE['status'] === 'true') {
    //user rmember koreche, so redirect to dashboard
    header("Location: ../Dashboard/dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../asset/css/login.css">
</head>
<body>
    <div class="container">
        <div class="form-section">
            <form method="POST" action="../../controller/loginCheck.php">
                <h2>Login</h2>

                <?php
                    if (!empty($error_message)) {
                        echo "<p style='color:red;'>$error_message</p>";
                    }
                ?>

                <label for="username">Username:</label>
                <input type="text" name="username" id="username"><br><br>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password"><br><br>
                
            <!-- <label class="remember-me"><input type="checkbox" /> Remember me</label> -->

                <p><a href="../user_authentication/forgot_password.php">Forgot Password?</a></p>

                <button type="submit" onclick="validateForm()">Login</button>
                <button type="reset">Reset</button><br><br>

                <p>Don't have an account? <a href="../user_authentication/sign_up.php">Sign up here</a></p>
            </form>
        </div>
        <div class="image-section">
            <img src="../../asset/images and icons/Skysence_logo.png" alt="Logo">
        </div>
    </div>

    <script src="../../asset/js/validate_login.js"></script>
</body>
</html>
