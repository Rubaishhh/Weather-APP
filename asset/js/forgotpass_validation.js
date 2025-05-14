function validateForgotPassword() {
    var email = document.getElementById('email').value;

    // Basic email validation
    if (email === "") {
        alert("Please enter your email address.");
        return false;
    }

    if (!email.includes("@") || !email.includes(".") || email.indexOf("@") > email.lastIndexOf(".")) {
        alert("Please enter a valid email address.");
        return false;
    }

    alert("A password reset link has been sent to your email.");
    return false; 
}