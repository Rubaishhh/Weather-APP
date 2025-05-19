const apiKey = "29f608cad39dc1b3b89b3df31040bb39";
let forecastData = [];

function getWeatherByCity() {
  const city = document.getElementById("cityInput").value.trim();
  if (!city) {
    alert("Please enter a city name.");
    return;
  }
  fetch(`https://api.openweathermap.org/data/2.5/forecast?q=${city}&appid=${apiKey}&units=metric`)
    .then(res => res.json())
    .then(data => handleForecast(data))
    .catch(() => alert("Failed to get city weather."));
}

function getWeatherByLocation() {
  if (!navigator.geolocation) {
    alert("Geolocation not supported.");
    return;
  }

  navigator.geolocation.getCurrentPosition(pos => {
    const lat = pos.coords.latitude;
    const lon = pos.coords.longitude;
    fetch(`https://api.openweathermap.org/data/2.5/forecast?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`)
      .then(res => res.json())
      .then(data => handleForecast(data))
      .catch(() => alert("Failed to get location weather."));
  }, () => {
    alert("Location access denied.");
  });
}

function handleForecast(data) {
  if (data.cod !== "200") {
    alert("No data found.");
    return;
  }

  forecastData = data.list.map(item => {
    return {
      date: item.dt_txt.split(" ")[0],
      time: item.dt_txt.split(" ")[1],
      temp: item.main.temp,
      weather: item.weather[0].description
    };
  });

  displayWeather(forecastData);
}

function displayWeather(data) {
  const container = document.getElementById("weatherData");
  container.innerHTML = "<h3>Forecast</h3>";
  data.forEach(item => {
    const div = document.createElement("div");
    div.className = "forecast-item";
    div.textContent = `${item.date} ${item.time} - ${item.temp}°C - ${item.weather}`;
    container.appendChild(div);
  });
}

async function downloadData() {
  const startDate = document.getElementById("startDate").value;
  const format = document.getElementById("format").value;

  if (!startDate) {
    alert("Please select a date.");
    return;
  }

  const filtered = forecastData.filter(item => item.date === startDate);
  if (filtered.length === 0) {
    alert("No forecast found for selected date. Forecast only available for next 5 days.");
    return;
  }

  if (format === "csv") {
    let csv = "Date,Time,Temperature,Weather\n";
    filtered.forEach(i => {
      csv += `${i.date},${i.time},${i.temp},${i.weather}\n`;
    });
    const blob = new Blob([csv], { type: "text/csv" });
    const a = document.createElement("a");
    a.href = URL.createObjectURL(blob);
    a.download = "forecast.csv";
    a.click();
  } else if (format === "pdf") {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    doc.setFontSize(12);
    doc.text("Weather Forecast Report", 10, 10);
    let y = 20;
    filtered.forEach(i => {
      doc.text(`${i.date} ${i.time} - ${i.temp}°C - ${i.weather}`, 10, y);
      y += 10;
    });
    doc.save("forecast.pdf");
  }
}
