function previewImage(event) {
      const reader = new FileReader();
      reader.onload = function () {
        document.getElementById('profilePreview').src = reader.result;
      };
      reader.readAsDataURL(event.target.files[0]);
    }


function saveProfile(){

    const fullname = document.getElementById('fullname').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const address = document.getElementById('address').value.trim();
    const country = document.getElementById('country').value;
    const gender = document.querySelector('input[name="gender"]:checked');

    if (!fullname || !email || !phone || !address || !country || !gender) {
        alert("Please fill in all fields(JS).");
        return false;
      }
    
    if (phone.length !== 11 || isNaN(Number(phone))) {
            alert("Phone number must be 11 digits.(JS)");
            return false;
    }
    
    return true;
      // alert("Profile saved successfully!");
      //     document.getElementById('profile_form').submit();

}