  function containsDigit(str) {
            for (let i = 0; i < str.length; i++) {
                let ch = str.charAt(i);
                if (ch >= '0' && ch <= '9') {
                    return true;
                }
            }
            return false;
        }

        document.getElementById('contactForm').addEventListener('submit', function(event) {
            // Clear previous errors
            document.getElementById('full_name_error').innerText = '';
            document.getElementById('email_error').innerText = '';
            document.getElementById('subject_error').innerText = '';
            document.getElementById('message_error').innerText = '';

            let hasError = false;

            // Full Name validation
            const fullName = document.getElementById('full_name').value.trim();
            if (fullName === '') {
                document.getElementById('full_name_error').innerText = 'Full name is required.';
                hasError = true;
            } else if (containsDigit(fullName)) {
                document.getElementById('full_name_error').innerText = 'Full name cannot contain numbers.';
                hasError = true;
            }

            // Email validation (your requested simple logic)
            const email = document.getElementById('email').value.trim();
            if (email === '') {
                document.getElementById('email_error').innerText = 'Email is required.';
                hasError = true;
            } else if (!email.includes("@") || !email.includes(".") || email.indexOf("@") > email.lastIndexOf(".")) {
                document.getElementById('email_error').innerText = 'Please enter a valid email address.';
                hasError = true;
            }

            // Subject validation
            const subject = document.getElementById('subject').value.trim();
            if (subject === '') {
                document.getElementById('subject_error').innerText = 'Subject is required.';
                hasError = true;
            }

            // Message validation
            const message = document.getElementById('message').value.trim();
            if (message === '') {
                document.getElementById('message_error').innerText = 'Message is required.';
                hasError = true;
            }

            if (hasError) {
                event.preventDefault(); // Stop form submission
            }
        });