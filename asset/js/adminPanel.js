let usermanagementContent = document.getElementById("usermanagementContent");
let contentmoderationContent = document.getElementById("contentmoderationContent");
let settingsContent = document.getElementById("settingsContent");

let usermanagementBtn = document.getElementById("usermanagement");
let contentmoderationBtn = document.getElementById("contentmoderation");
let settingsBtn = document.getElementById("settings");

function clearTabs() {
  usermanagementContent.style.display = "none";
  contentmoderationContent.style.display = "none";
  settingsContent.style.display = "none";

  usermanagementBtn.style.backgroundColor = "rgb(220,220,220)";
  contentmoderationBtn.style.backgroundColor = "rgb(220,220,220)";
  settingsBtn.style.backgroundColor = "rgb(220,220,220)";
}

usermanagementBtn.onclick = function () {
  clearTabs();
  usermanagementContent.style.display = "block";
  usermanagementBtn.style.backgroundColor = "rgb(180,180,250)";
};

contentmoderationBtn.onclick = function () {
  clearTabs();
  contentmoderationContent.style.display = "block";
  contentmoderationBtn.style.backgroundColor = "rgb(180,180,250)";
};

settingsBtn.onclick = function () {
  clearTabs();
  settingsContent.style.display = "block";
  settingsBtn.style.backgroundColor = "rgb(180,180,250)";
};

document.getElementById("saveBtn").onclick = function () {
  let location = document.getElementById("defaultLocation").value;
  if (location === "") {
    alert("Please enter a location.");
  } else {
    alert("Location saved: " + location);
  }
};

document.getElementById("addUserBtn").onclick = function () {
  alert("User form will open");
};
