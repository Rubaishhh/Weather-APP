function fetchCoordinates(city, callback) {
  const url = `https://geocoding-api.open-meteo.com/v1/search?name=${encodeURIComponent(city)}&count=1`;
  const xhr = new XMLHttpRequest();
  xhr.open("GET", url);
  xhr.onload = function () {
    if (xhr.status === 200) {
      const result = JSON.parse(xhr.responseText);
      if (result.results && result.results.length > 0) {
        const { latitude, longitude } = result.results[0];
        callback(latitude, longitude);
      } else {
        document.getElementById("error").textContent = "City not found.";
      }
    }
  };
  xhr.send();
}

function fetchWeatherData(lat, lon, start, end) {
  const url = `https://archive-api.open-meteo.com/v1/archive?latitude=${lat}&longitude=${lon}&start_date=${start}&end_date=${end}&daily=temperature_2m_max,temperature_2m_min,precipitation_sum&timezone=auto`;
  const xhr = new XMLHttpRequest();
  xhr.open("GET", url);
  xhr.onload = function () {
    if (xhr.status === 200) {
      const data = JSON.parse(xhr.responseText);
      displayWeather(data);
    } else {
      document.getElementById("error").textContent = "Data not available.";
    }
  };
  xhr.send();
}

function displayWeather(data) {
  const tbody = document.getElementById("weatherBody");
  tbody.innerHTML = "";
  const time = data.daily.time;
  const max = data.daily.temperature_2m_max;
  const min = data.daily.temperature_2m_min;

  for (let i = 0; i < time.length; i++) {
    const row = `<tr>
      <td>${time[i]}</td>
      <td>${max[i]}</td>
      <td>${min[i]}</td>
    </tr>`;
    tbody.innerHTML += row;
  }
  document.getElementById("weatherTable").style.display = "table";
  document.getElementById("error").textContent = "";

  calculateSeasonalAverage(data);
}

function calculateSeasonalAverage(data) {
  const maxTemps = data.daily.temperature_2m_max;
  const minTemps = data.daily.temperature_2m_min;
  let maxTotal = 0, minTotal = 0, rainTotal = 0;
  const count = maxTemps.length;

  for (let i = 0; i < count; i++) {
    maxTotal += maxTemps[i];
    minTotal += minTemps[i];
  }

  const avgMax = (maxTotal / count).toFixed(2);
  const avgMin = (minTotal / count).toFixed(2);

  document.getElementById("seasonalSummary").innerHTML = `
    <h3>Seasonal Averages</h3>
    <ul>
      <li>Avg Max Temperature: ${avgMax} °C</li>
      <li>Avg Min Temperature: ${avgMin} °C</li>
 
    </ul>
  `;
}

function lookupWeather() {
  const city = document.getElementById("cityInput").value.trim();
  const start = document.getElementById("startDate").value;
  const end = document.getElementById("endDate").value;
  if (!city || !start || !end) {
    document.getElementById("error").textContent = "All fields are required.";
    return;
  }
  fetchCoordinates(city, (lat, lon) => fetchWeatherData(lat, lon, start, end));
}