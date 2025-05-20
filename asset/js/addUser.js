
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
  } else if (fname === '' || !/^[a-zA-Z\s]+$/.test(fname)) {
    alert("Full name must contain only letters and spaces.");
    hasError = true;
  } else if (email === '' || !/^[\w\.-]+@[\w\.-]+\.\w{2,6}$/.test(email)) {
    alert("Invalid email format.");
    hasError = true;
  } else if (phone === '' || !/^01[0-9]{9}$/.test(phone)) {
    alert("Phone must be a valid Bangladeshi number (11 digits, starts with 01).");
    hasError = true;
  } else if (dob === '') {
    alert("Date of birth is required.");
    hasError = true;
  } else if (gender === '') {
    alert("Gender is required.");
    hasError = true;
  } else if (address === '') {
    alert("Address is required.");
    hasError = true;
  } else if (country === '') {
    alert("Country is required.");
    hasError = true;
  }

  return !hasError;
}
