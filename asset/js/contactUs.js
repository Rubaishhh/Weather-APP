function generateCaptcha() {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let captcha = '';
    for (let i = 0; i < 6; i++) {
        captcha += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return captcha;
}

let currentCaptcha = generateCaptcha();
document.getElementById('captchaText').innerHTML = currentCaptcha;

// Refresh CAPTCHA functionality
document.getElementById('refreshCaptcha').onclick = function() {
    currentCaptcha = generateCaptcha();
    document.getElementById('captchaText').innerHTML= currentCaptcha;
    document.getElementById('captchaInput').value = ''; // Clear CAPTCHA input
    document.getElementById('captcha-error').style.display = 'none'; // Hide error message
};

// Validate form
document.getElementById('contactForm').onsubmit = function(event) {
    event.preventDefault();

    let isValid = true;
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;
    const captchaInput = document.getElementById('captchaInput').value;

    // Validate Name
    if (!name) {
        document.getElementById('name-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('name-error').style.display = 'none';
    }

    // Validate Email
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!email || !emailPattern.test(email)) {
        document.getElementById('email-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('email-error').style.display = 'none';
    }

    // Validate Message
    if (!message) {
        document.getElementById('message-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('message-error').style.display = 'none';
    }

    // Validate CAPTCHA
    if (captchaInput !== currentCaptcha) {
        document.getElementById('captcha-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('captcha-error').style.display = 'none';
    }

    // If all fields are valid, show success message
    if (isValid) {
        document.getElementById('successMessage').style.display = 'block';
    }
};