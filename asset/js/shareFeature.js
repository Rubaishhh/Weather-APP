function generateSnapshot() {
  var message = document.getElementById("customMessage").value;
  var xhr = new XMLHttpRequest();
  var apiKey = "29f608cad39dc1b3b89b3df31040bb39";
  var city = "Mirpur,BD";
  var url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${apiKey}`;

  xhr.open("GET", url, true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        var data = JSON.parse(xhr.responseText);
        var temp = data.main.temp + " °C";
        var condition = data.weather[0].description;
        var wind = data.wind.speed + " kph";
        var pressure = data.main.pressure + " mb";

        var snapshotContent = `Weather Update: ${temp}, ${condition.charAt(0).toUpperCase() + condition.slice(1)}\nWind: ${wind}\nPressure: ${pressure}`;
        if (message !== "") {
          snapshotContent += `\nNote: ${message}`;
        }

        document.getElementById("snapshot").innerText = snapshotContent;
      } else {
        document.getElementById("snapshot").innerText = "Failed to fetch weather data.";
      }
    }
  };
  xhr.send();
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
      .then(() => alert("Shared successfully!"))
      .catch(error => alert("Sharing failed: " + error));
  } else {
    alert("Sharing not supported. You can copy the text manually.");
  }
}