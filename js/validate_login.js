function validate_login() {
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();

    if (username === "" || password === "") {
        alert("Please fill in both username/email and password.");
        return;
    }
    alert("Login Successful!");
    window.location.href = "dashboard.html";
}