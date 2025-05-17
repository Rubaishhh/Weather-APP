const apiKey = "29f608cad39dc1b3b89b3df31040bb39";

function searchCity() {
  const city = document.getElementById("searchInput").value.trim();
  if (!city) 
      return;

  const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;

  fetch(url)
    .then(response => response.json())
    .then(data => {
      if (data.cod !== 200) { 
        //200 ok
        //404 not found
        //400 bad req
        //401 unauth(bad api)
        document.getElementById("result").innerHTML = "<p style='color:red;'>City not found!</p>";
        return;
      }

      const html = `
        <h2>${data.name}, ${data.sys.country}</h2>
        <p><strong>Temperature:</strong> ${data.main.temp}°C</p>
        <p><strong>Feels Like:</strong> ${data.main.feels_like}°C</p>
        <p><strong>Humidity:</strong> ${data.main.humidity}%</p>
        <p><strong>Wind Speed:</strong> ${(data.wind.speed * 3.6).toFixed(1)} km/h</p>
      `;

      document.getElementById("result").innerHTML = html;
    })
}

document.getElementById("searchInput").addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    searchCity();
  }
});
