function validate_signup() {
    let username = document.getElementById("username").value.trim();
    let fullname = document.getElementById("fullname").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    let confirmpassword = document.getElementById("confirmpassword").value.trim();
    let phone = document.getElementById("phone").value;
    let dob = document.getElementById("dob").value;
    //not clear
    let gender = document.querySelector('input[name="gender"]:checked');
    let address = document.getElementById("address").value.trim();
    let country = document.getElementById("country").value;
    const genderSelected = (gender !== null);
    
    

    if (!username || !fullname || !email || !phone || !dob || !address || !country || !password || !confirmpassword) {
        alert("All fields are required!");
        return;
    }

    if (password !== confirmpassword) {
        alert("Passwords do not match.");
        return;
    }
    if (isNaN(phone) || phone.length !== 11) {
        alert("Phone number should contain only digits.");
        return;
    }
    if (!genderSelected) {
        alert("Please select a gender.");
        return;
    }
    if (!email.includes("@") || !email.includes(".") || email.indexOf("@") > email.lastIndexOf(".")) {
        alert("Please enter a valid email address.");
        return;
    }
    let profilePic = document.getElementById("profile_image").files[0];
if (!profilePic) {
    alert("Please upload a profile picture.");
    return false;
}
    return true;
}
