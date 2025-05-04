document.getElementById('forgotPasswordForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const email = document.getElementById('email').value;

    // Basic email validation
    if (email === "") {
        alert("Please enter your email address.");
    }
    if (!email.includes("@") || !email.includes(".") || email.indexOf("@") > email.lastIndexOf(".")) {
        alert("Please enter a valid email address.");
        return;
    }
    else {
        alert("A password reset link has been sent to your email.");
    }
});
