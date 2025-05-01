const apiKey = "YOUR_API_KEY"; // Replace with your actual key
let city = localStorage.getItem("lastCity") || "Dhaka";

function fetchWeather(cityName) {}

function showCurrent(data) {
  const today = null;
  const cityName = null;
  const date = new Date();

  document.getElementById("city-name").innerText = cityName;
  document.getElementById("date-time").innerText = date.toLocaleString();
  document.getElementById("w-temp").innerText = '30°C';
  document.getElementById("w-humidity").innerText = '10%';
  document.getElementById("w-wind").innerText = '20km/h';

  const sunrise = 'demo sunrise'
  document.getElementById("w-sunrise").innerText = sunrise;
}

function showForecast(data) {
  const forecastCards = ["day1", "day2", "day3", "day4", "day5"];
  //will loop through these, and write the data with inner html after fetching
}

function searchCity() {
  const input = document.getElementById("searchInput").value.trim();
  if (input !== "") {
    fetchWeather(input);
  }
}


