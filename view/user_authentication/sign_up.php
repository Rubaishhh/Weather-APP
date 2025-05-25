<?php
session_start();
if(isset($_GET['error']) && $_GET['error'] === 'username_exists'){
    echo "<script>alert('Username already taken. Please choose another.');</script>";
}
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
    <form id="signupForm" action="../../controller/sign_up_handler.php" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data" >
    <img src="../../asset/images and icons/Skysence_logo.png" alt="SKYSENCE">

    <h2><u>Sign up</u></h2>
    <label for="username"> User name :</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="fullname"> Full name:</label>
    <input type="text" id="fullname" name="fullname" required><br><br>

    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="profile_image">Profile Image:</label>
    <input type="file" id="profile_image" name="profile_image" accept="image/*" required><br><br>
    
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
    <!-- have to change this lame approach -->
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
    <option value="China">China</option>
    <option value="Japan">Japan</option>
    <option value="Russia">Russia</option>
    <option value="Brazil">Brazil</option>
    <option value="South Korea">South Korea</option>
    <option value="Italy">Italy</option>
    <option value="Spain">Spain</option>
    <option value="Mexico">Mexico</option>
    <option value="Netherlands">Netherlands</option>
    <option value="Sweden">Sweden</option>
    <option value="Switzerland">Switzerland</option>
    <option value="Nepal">Nepal</option>
    <option value="Pakistan">Pakistan</option>
    <option value="Sri Lanka">Sri Lanka</option>
    <option value="Malaysia">Malaysia</option>
    <option value="Indonesia">Indonesia</option>
    <option value="Philippines">Philippines</option>
    <option value="New Zealand">New Zealand</option>
    <option value="South Africa">South Africa</option>
    <option value="Turkey">Turkey</option>
    <option value="Saudi Arabia">Saudi Arabia</option>
    <option value="UAE">United Arab Emirates</option>
</select>

<br>

<p>Already have an account? <a href="../user_authentication/login.php">Login here</a></p>
<div class="buttons">
    <button type="button" id="cancel">Cancel</button><br><br>
    <button type="reset" id="reset">Reset</button>
    <button type="submit" id="submit">Sign up</button>
</div>
</form>
<script src="../../asset/js/validate_signup.js"></script>

</body>
</html>

