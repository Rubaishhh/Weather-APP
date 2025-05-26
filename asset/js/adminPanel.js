let btnUser = document.getElementById("btnUser");
  let btnContent = document.getElementById("btnContent");
  let userSection = document.getElementById("userSection");
  let contentSection = document.getElementById("contentSection");

  btnUser.onclick = function () {
    btnUser.className = "active";
    btnContent.className = "";

    userSection.className = "section active";
    contentSection.className = "section";
  };

  btnContent.onclick = function () {
    btnContent.className = "active";
    btnUser.className = "";

    userSection.className = "section";
    contentSection.className = "section active";
  };

  document.getElementById("searchForm").onsubmit = function (event) {
    event.preventDefault();

    let search = document.getElementById("searchInput").value;
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "adminPanel.php?ajax=1&search=" + encodeURIComponent(search), true);

    xhr.onload = function () {
      if (xhr.status === 200) {
        document.getElementById("userTableBody").innerHTML = xhr.responseText;
      } else {
        alert("Failed to fetch data");
      }
    };

    xhr.send();
  };