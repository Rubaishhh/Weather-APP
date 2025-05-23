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
}
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
  console.log("Sending to DB:", JSON.stringify(payload));

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
