
  function generateSnapshot() {
    var message = document.getElementById("customMessage").value;
    var snapshotContent = "Weather Update: 25 °C, Clear Skies\nWind: 15 kph\nPressure: 1013 mb";
    if (message !== "") {
      snapshotContent += "\nNote: " + message;
    }
    document.getElementById("snapshot").innerText = snapshotContent;
  }

  function shareContent() {
    var content = document.getElementById("snapshot").innerText;
    if (content.trim() === "") {
      alert("Please generate a snapshot first.");
      return;
    }

    if (navigator.share) {
      var shareData = {
        title: "Weather Snapshot",
        text: content
      };
      navigator.share(shareData)
        .then(function () {
          alert("Shared successfully!");
        })
        .catch(function (error) {
          alert("Sharing failed: " + error);
        });
    } else {
      alert("Sharing is not supported on this browser. You can copy the text manually.");
    }
  }

