document.getElementById('username').addEventListener('blur', function() {
    const username = this.value.trim();
    if (username === "") 
        return; 

    const xhr = new XMLHttpRequest();
    const params = "check_username=" + encodeURIComponent(username);

    xhr.open("POST", "../../controller/sign_up_handler.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(params);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText === "exists") {
                alert("Username already taken. Please choose another.");
                document.getElementById('username').value = "";
                document.getElementById('username').focus();
            }
        }
    };
});


function validate_signup() {
    let username = document.getElementById("username").value.trim();
    let fullname = document.getElementById("fullname").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    let confirmpassword = document.getElementById("confirmpassword").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let dob = document.getElementById("dob").value;
    let gender = document.querySelector('input[name="gender"]:checked');
    let address = document.getElementById("address").value.trim();
    let country = document.getElementById("country").value;
    

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
    const genderSelected = (gender !== null);
    if (!genderSelected) {
        alert("Please select a gender.");
        return;
    }
    if (!email.includes("@") || !email.includes(".") || email.indexOf("@") > email.lastIndexOf(".")) {
        alert("Please enter a valid email address.");
        return;
    }
    let profilePic = document.getElementById("profile_image").files[0];//file list obj er first element
if (!profilePic) {
    alert("Please upload a profile picture.");
    return false;
}
    return true;
}
