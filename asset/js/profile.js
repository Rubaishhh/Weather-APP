document.getElementById("picture_up").addEventListener("change", function(event) {
    const file = event.target.files[0];

    if (!file) {
        return;
    }

    const validFormats = ["image/png", "image/jpeg"];

    if (!validFormats.includes(file.type)) { // MIME format e return kore like image/png image/jpeg
        alert("Please upload a PNG or JPEG image.");
        return;
    }

    const profilePic = document.querySelector(".picture img");
    profilePic.src = URL.createObjectURL(file);
});



function saveProfile(){

    const fullname = document.getElementById('fullname').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const address = document.getElementById('address').value.trim();
    const country = document.getElementById('country').value;
    const gender = document.querySelector('input[name="gender"]:checked');

    if (!fullname || !email || !phone || !address || !country || !gender) {
        alert("Please fill in all fields.");
        return;
      }
    
    if (phone.length !== 11 || isNaN(Number(phone))) {
            alert("Phone number must be 11 digits.");
            return;
    }
    
      alert("Profile saved successfully!");
}