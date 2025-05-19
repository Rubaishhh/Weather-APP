function addWidget() {
  const cityInput = document.getElementById("cityInput").value.trim();
  if (cityInput === "") {
    alert("Please enter a city name.");
    return;
  }

  const apiKey = "29f608cad39dc1b3b89b3df31040bb39";
  const apiUrl =
    "https://api.openweathermap.org/data/2.5/weather?q=" +
    cityInput +
    "&appid=" +
    apiKey +
    "&units=metric";

  fetch(apiUrl)
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      if (data.cod !== 200) {
        alert("City not found.");
        return;
      }
      createWidget(data);
    })
    .catch(function () {
      alert("Error fetching weather data.");
    });
}

function createWidget(data) {
  let size = "small";
  if (document.getElementById("sizeMedium").checked) {
    size = "medium";
  } else if (document.getElementById("sizeLarge").checked) {
    size = "large";
  }

  const showTemp = document.getElementById("showTemp").checked;
  const showCond = document.getElementById("showCond").checked;
  const showHumid = document.getElementById("showHumid").checked;
  const showWind = document.getElementById("showWind").checked;

  let widgetHTML = '<div class="widget ' + size + '">';
  widgetHTML +=
    "<h3>" + data.name + ", " + data.sys.country + "</h3>";
  widgetHTML += '<div class="data">';

  if (showTemp) {
    widgetHTML +=
      "<div><strong>Temperature:</strong> " + data.main.temp + "°C</div>";
  }
  if (showCond) {
    widgetHTML +=
      "<div><strong>Condition:</strong> " + data.weather[0].main + "</div>";
  }
  if (showHumid) {
    widgetHTML +=
      "<div><strong>Humidity:</strong> " + data.main.humidity + "%</div>";
  }
  if (showWind) {
    widgetHTML +=
      "<div><strong>Wind Speed:</strong> " + data.wind.speed + " m/s</div>";
  }

  widgetHTML += "</div></div>";

  const gallery = document.getElementById("widgetGallery");
  gallery.innerHTML += widgetHTML;
}
