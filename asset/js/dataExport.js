const apiKey = "29f608cad39dc1b3b89b3df31040bb39";
let exportData = null;

function getWeatherByCity() {
  const city = document.getElementById("cityInput").value.trim();
  if (!city) {
    alert("Please enter a city name.");
    return;
  }
  const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;
  fetchWeather(url);
}

function getWeatherByLocation() {
  if (!navigator.geolocation) {
    alert("Geolocation not supported.");
    return;
  }
  navigator.geolocation.getCurrentPosition(position => {
    const lat = position.coords.latitude;
    const lon = position.coords.longitude;
    const url = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`;
    fetchWeather(url);
  }, () => {
    alert("Location access denied.");
  });
}

function fetchWeather(url) {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", url, true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      const data = JSON.parse(xhr.responseText);
      const temp = data.main.temp;
      const humidity = data.main.humidity;
      const condition = data.weather[0].description;
      const windSpeed = data.wind.speed;
      exportData = { temp, humidity, condition, windSpeed };
      displayWeather(exportData);
    } else {
      document.getElementById("weatherData").textContent = "Weather not found!";
    }
  };
  xhr.send();
}

function displayWeather(data) {
  document.getElementById("weatherData").innerHTML = `
    🌡️ <b>Temperature:</b> ${data.temp}°C<br>
    💧 <b>Humidity:</b> ${data.humidity}%<br>
    🌥️ <b>Condition:</b> ${data.condition}<br>
    💨 <b>Wind Speed:</b> ${data.windSpeed} m/s
  `;
}

function downloadData() {
  if (!exportData) {
    alert("No weather data to download.");
    return;
  }

  const format = document.getElementById("format").value;

  if (format === "csv") {
    const csv = `Temperature,Humidity,Condition,Wind Speed\n${exportData.temp},${exportData.humidity},${exportData.condition},${exportData.windSpeed}`;
    const blob = new Blob([csv], { type: "text/csv" });
    const a = document.createElement("a");
    a.href = URL.createObjectURL(blob);
    a.download = "weather.csv";
    a.click();
  } else if (format === "pdf") {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    doc.setFontSize(14);
    doc.text("Weather Report", 10, 10);
    doc.text(`Temperature: ${exportData.temp}°C`, 10, 20);
    doc.text(`Humidity: ${exportData.humidity}%`, 10, 30);
    doc.text(`Condition: ${exportData.condition}`, 10, 40);
    doc.text(`Wind Speed: ${exportData.windSpeed} m/s`, 10, 50);
    doc.save("weather.pdf");
  }
}