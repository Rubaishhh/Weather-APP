function validateForm() {
    var username = document.getElementById("username").value.trim();
    var password = document.getElementById("password").value.trim();

    if (username === "" || password === "") {
        alert("Both fields are required. Please fill in the username and password.");
        return false;
    }
    return true; 
}
