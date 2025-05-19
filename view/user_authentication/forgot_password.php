<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../../asset/css/forgot_pass.css">
</head>
<body>
    <div class="f_pass_container">
        <form id="forgotPasswordForm" onsubmit="return validateForgotPassword()">
            <h2>Forgot Password</h2>
            <p>Please enter your email address below. We will send you a link to reset your password.</p>
            
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <button type="submit" id="submit">Send Reset Link</button>
            <p>Remembered your password? <a href="../user_authentication/login.php">Login here</a></p>
        </form>
    </div>

    <script src="../../asset/js/forgotpass_validation.js"></script>
</body>
</html>
