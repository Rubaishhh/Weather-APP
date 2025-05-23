const apiKey = "29f608cad39dc1b3b89b3df31040bb39";

let tempCelsius = null;
let windSpeedKph = null;
let pressureMb = null;

/*default gula*/
let isCelsius = true;
let isKph = true;
let isMb = true;



function fetchWeather(cityName) {
  alert("in fetchWeather");
  const url = `https://api.openweathermap.org/data/2.5/weather?q=${cityName}&appid=${apiKey}&units=metric`;

  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", url, true); //jehetu kichu pathachi na just getting the data, so get and true for asynch
  xhttp.send();

  xhttp.onreadystatechange = function () {
    if(xhttp.readyState === 4 && xhttp.status === 200){
      const data = JSON.parse(xhttp.responseText);
      alert("done parsing");
      saveToDatabase(xhttp.responseText);
      showCurrent(data);
      
      
  }     
  else {
        document.getElementById("city_name").innerText = "City not found!";
        document.getElementById("temperature").innerText = "";
        document.getElementById("humidity").innerText = "";
        document.getElementById("wind").innerText = "";
        document.getElementById("weather-description").innerText = "";
        document.getElementById("w-temp").innerText = "";
        document.getElementById("w-wind").innerText = "";
        document.getElementById("w-humidity").innerText = "";
        document.getElementById("w-pressure").innerText = "";
        document.getElementById("feels-like").innerText = "";
        document.getElementById("weather-icon").src = "";
      }
};
// Add 5-day forecast fetch
    const forecastUrl = `https://api.openweathermap.org/data/2.5/forecast?q=${cityName}&appid=${apiKey}&units=metric`;
    const forecastXhttp = new XMLHttpRequest();
    forecastXhttp.open("GET", forecastUrl, true);
    forecastXhttp.send();
    forecastXhttp.onreadystatechange = function () {
        if (forecastXhttp.readyState === 4 && forecastXhttp.status === 200) {
            const data = JSON.parse(forecastXhttp.responseText);
            displayForecast(data);
        }
    };
}

let forecastData = []; // Store forecast data globally for modal

function displayForecast(data) {
    forecastData = [];
    // console.log("Forecast API response:", data);
    const dailyData = data.list.filter(item => item.dt_txt.includes("12:00:00")).slice(0, 5);
    // console.log("Filtered daily data:", dailyData);

    dailyData.forEach((item, index) => {
        const date = new Date(item.dt * 1000);
        if (isNaN(date)) {
            console.error("Invalid date for item:", item);
            return;
        }
        const temp = item.main.temp;
        const description = item.weather[0].description;
        const icon = item.weather[0].icon;
        const humidity = item.main.humidity;
        const wind = item.wind.speed * 3.6;
        const pressure = item.main.pressure;

        forecastData[index] = { date, temp, description, icon, humidity, wind, pressure };

        const card = document.getElementById(`day${index + 1}`);
        if (card) {
            card.innerHTML = `
                <h4>${date.toDateString()}</h4>
                <img src="https://openweathermap.org/img/wn/${icon}@2x.png" alt="icon">
                <p>${temp.toFixed(1)}°C</p>
                <p>${description}</p>
            `;
        }
    });
}
document.getElementById("forecast-modal").addEventListener("click", function (event) {
    if (event.target === this) {
        this.style.display = "none";
    }
});

function showForecastModal(index) {
    const modal = document.getElementById("forecast-modal");
    const data = forecastData[index];
if (!data || !(data.date instanceof Date) || isNaN(data.date)) {
        console.error("Invalid or missing forecast data for index:", index);
        alert("Forecast data not available for this day.");
        return;
    }    document.getElementById("modal-date").innerText = data.date.toDateString();
    document.getElementById("modal-icon").src = `https://openweathermap.org/img/wn/${data.icon}@2x.png`;
    document.getElementById("modal-temp").innerText = `Temperature: ${data.temp.toFixed(1)}°C`;
    document.getElementById("modal-description").innerText = `Description: ${data.description}`;
    document.getElementById("modal-humidity").innerText = `Humidity: ${data.humidity}%`;
    document.getElementById("modal-wind").innerText = `Wind: ${data.wind.toFixed(1)} km/h`;
    document.getElementById("modal-pressure").innerText = `Pressure: ${data.pressure} mb`;
    modal.style.display = "flex";
}

function showCurrent(data) {
  const cityName = data.name;
  const date = new Date();

 tempCelsius = data.main.temp;
  const feelsLike = data.main.feels_like;
  const humidity = data.main.humidity;
 pressureMb = data.main.pressure;
 windSpeedKph = data.wind.speed * 3.6;
  const sunrise = new Date(data.sys.sunrise * 1000).toLocaleTimeString();
  const description = data.weather[0].description;
  const iconCode = data.weather[0].icon;


  document.getElementById("city_name").innerText = cityName;
  document.getElementById("date_time").innerText = date.toLocaleString();
  document.getElementById("w-temp").innerText = `${tempCelsius.toFixed(1)}°C`;
 
  document.getElementById("temperature").innerText = `${tempCelsius.toFixed(1)}°C`;
  // console.log(`Temparature: ${tempCelsius.toFixed(1)}°C`);
  document.getElementById("humidity").innerText = `Humidity: ${humidity}%`;
  document.getElementById("w-humidity").innerText = `${humidity}%`;
  document.getElementById("wind").innerText = `Wind Speed: ${windSpeedKph.toFixed(1)} km/h`;
  document.getElementById("w-wind").innerText = `${windSpeedKph.toFixed(1)} km/h`;
  document.getElementById("weather-description").innerText = description;
  document.getElementById("weather-icon").src = `https://openweathermap.org/img/wn/${iconCode}@2x.png`;
  document.getElementById("feels-like").innerText = `Feels Like: ${feelsLike}°C`;
  document.getElementById("w-pressure").innerText = `${pressureMb} mb`;
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~DB SAVING~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function saveToDatabase(data) {
  alert("Saving to DB");
  const parsed = JSON.parse(data);

  const payload = {
    city: parsed.name,
    temp: parsed.main.temp,
    humidity: parsed.main.humidity,
    pressure: parsed.main.pressure,
    wind: parsed.wind.speed * 3.6 // convert m/s to km/h
  };
  //console.log("Sending to DB:", JSON.stringify(payload));
   alert(JSON.stringify(payload));

  const xhttp = new XMLHttpRequest();
  xhttp.open("POST", "../../model/currentWeatherModel.php", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhttp.send("json=" + encodeURIComponent(JSON.stringify(payload)));
}


function toggleTemp(){
  if(tempCelsius===null)
      return;
    if(isCelsius){
      const f = ((tempCelsius*9)/5)+32;
      document.getElementById("w-temp").innerText = `${f.toFixed(1)}°F`;
    }else {
    document.getElementById("w-temp").innerText = `${tempCelsius.toFixed(1)}°C`;
  }
    isCelsius = !isCelsius;
}

function toggleWind(){
if(windSpeedKph===null)
  return;

if(isKph){

  const mph = windSpeedKph* 0.621;
  document.getElementById("w-wind").innerText = `${mph.toFixed(1)} mile/h`;

}else{

     document.getElementById("w-wind").innerText = `${windSpeedKph.toFixed(1)} Km/h`;
}
  isKph = !isKph;

}

function togglePressure() {
  if (pressureMb === null) return;

  if (isMb) {

    const inHg = pressureMb * 0.0295;
    document.getElementById("w-pressure").innerText = `${inHg.toFixed(2)} inHg`;

  } else {

    document.getElementById("w-pressure").innerText = `${pressureMb} mb`;

  }
  isMb = !isMb;
}

function searchCity() {
  const input = document.getElementById("searchInput").value.trim();
  if (input !== "") {
    fetchWeather(input);
  }
}
/*Keydown : listnes for any key being pressed down
  then if i press enter it will go run searchCity()
  */ 
document.getElementById("searchInput").addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    searchCity(); 
  }
});

let city = "Mirpur";
fetchWeather(city);
