<?php
session_start();

$check = $_SERVER['HTTP_REFERER'] ?? '';
// it is a superglobal var. etr modhe current page e ashar age kon page e chilo otr info
//thake , eta basically url return kore
//ekhn just url er modhe strpos die dekhbo je login.php ase ki na

if(strpos($check, 'login.php')!== false){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../asset/css/signup.css">
</head>
<body>
    <form id="signupForm">
    <h2>Sign up</h2>
    <label for="username"> User name :</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="fullname"> Full name:</label>
    <input type="text" id="fullname" name="fullname" required><br><br>

    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required><br><br>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="confirmpassword">Confirm Password:</label>
    <input type="password" id="confirmpassword" name="confirmpassword" required><br><br>

    <label for="phone">Phone number:</label>
    <input type="text" id="phone" name="phone" required><br><br>

    <label for="dob">Date of birth</label>
    <input type="date" id="dob" name="dob" required><br><br>
    <label for="gender">Gender:</label><br>
    <div class="gender-options">
        <input type="radio" id="male" name="gender" value="male" required>
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="female">
        <label for="female">Female</label>
        <input type="radio" id="other" name="gender" value="other">
        <label for="other">Other</label><br>
    </div>
    

    <label for="address">Address</label>
    <input type="text" id="address" name="address" required><br><br>
    
    <label for="country">Select a country:</label>
<select id="country" name="country">
    <option value="">--Select a Country--</option>
    <option value="USA">United States</option>
    <option value="Canada">Canada</option>
    <option value="UK">United Kingdom</option>
    <option value="India">India</option>
    <option value="Bangladesh">Bangladesh</option>
    <option value="Australia">Australia</option>
    <option value="Germany">Germany</option>
    <option value="France">France</option>
</select>
<br>

<p>Already have an account? <a href="../user_authentication/login.php">Login here</a></p>
<div class="buttons">
    <button type="button" id="submit" onclick="validate_signup()">Sign up</button>
    <button type="reset" id="reset">Reset</button>
    <button type="button" id="cancel">Cancel</button><br><br>
</div>
</form>
<script src="/js/validate_signup.js"></script>

</body>
</html>
<?php
} else {
    header('Location: login.php');
    exit;
}
?>
