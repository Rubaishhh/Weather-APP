<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App - Contact Us</title>
    <link rel="stylesheet" href="../../asset/css/contactUs.css"> 
  
</head>
<body>
 <div class="container">
        <h2>Contact Us</h2>
        <form id="contactForm" method="POST" action="../../controller/contactcheck.php">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" placeholder="Your full name" />
            <div id="full_name_error" class="error"></div>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Your email address" />
            <div id="email_error" class="error"></div>

            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" placeholder="Subject" />
            <div id="subject_error" class="error"></div>

            <label for="message">Message</label>
            <textarea id="message" name="message" placeholder="Your message"></textarea>
            <div id="message_error" class="error"></div>

            <button type="submit">Send Message</button>
        </form>
    </div>

<script src="../../asset/js/contactUs.js"></script>

</body>
</html>
