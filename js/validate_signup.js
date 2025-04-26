function validate_signup() {
    let username = document.getElementById("username").value.trim();
    let fullname = document.getElementById("fullname").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    let confirmPassword = document.getElementById("confirmPassword").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let dob = document.getElementById("dob").value;
    //not clear
    let gender = document.querySelector('input[name="gender"]:checked');
    let address = document.getElementById("address").value.trim();
    let country = document.getElementById("country").value;

    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/;
    let phonePattern = /^[0-9]{10,15}$/;

    if (!username || !fullname || !email || !phone || !dob || !gender || !address || !country || !password || !confirmPassword) {
        alert("All fields are required!");
        return;
    }

    if (!email.match(emailPattern)) {
        alert("Invalid email format.");
        return;
    }

    if (!phone.match(phonePattern)) {
        alert("Phone number should be 10–15 digits.");
        return;
    }

    alert("Form submitted successfully!");

//checking
    console.log("Username:", username);
    console.log("Fullname:", fullname);
    console.log("Email:", email);
    console.log("Phone:", phone);
    console.log("DOB:", dob);
    console.log("Gender:", gender.value);
    console.log("Address:", address);
    console.log("Country:", country);
}
