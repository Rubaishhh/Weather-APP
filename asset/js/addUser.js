function validateForm() {
  let hasError = false;

  let uname = document.getElementById('uname').value.trim();
  let fname = document.getElementById('fname').value.trim();
  let email = document.getElementById('email').value.trim();
  let phone = document.getElementById('phone').value.trim();
  let dob = document.getElementById('dob').value.trim();
  let gender = document.getElementById('gender').value.trim();
  let address = document.getElementById('address').value.trim();
  let country = document.getElementById('country').value.trim();

  if (uname === '') {
    alert("Username is required.");
    hasError = true;
  }

  if (email === '' || email.indexOf('@') === -1 || email.indexOf('.') === -1) {
    alert("Invalid email format.");
    hasError = true;
  }

  // Phone validation without regex
  if (phone === '') {
    alert("Phone number is required.");
    hasError = true;
  } else if (phone.length !== 11) {
    alert("Phone must be exactly 11 digits.");
    hasError = true;
  } else if (phone[0] !== '0' || phone[1] !== '1') {
    alert("Phone must start with 01.");
    hasError = true;
  } else {
    for (let i = 0; i < phone.length; i++) {
      if (phone[i] < '0' || phone[i] > '9') {
        alert("Phone must contain only numbers.");
        hasError = true;
        break;
      }
    }
  }

  if (dob === '') {
    alert("Date of birth is required.");
    hasError = true;
  }

  if (gender === '') {
    alert("Gender is required.");
    hasError = true;
  }

  if (address === '') {
    alert("Address is required.");
    hasError = true;
  }

  if (country === '') {
    alert("Country is required.");
    hasError = true;
  }

  return !hasError;
}
