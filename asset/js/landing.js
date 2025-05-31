const apiKey = "29f608cad39dc1b3b89b3df31040bb39";

    function searchCity() {
      const city = document.getElementById("searchInput").value.trim();
      if (!city)
         return;

      const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;

      const xhttp = new XMLHttpRequest();
      xhttp.open("GET", url, true);
      xhttp.send();

      xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4) {
          if (xhttp.status === 200) {
            const data = JSON.parse(xhttp.responseText);
//DOM use kora jaite pare
            const html = `
              <h2>${data.name}, ${data.sys.country}</h2>
              <p>Temperature: ${data.main.temp}°C</p>
              <p>Feels Like: ${data.main.feels_like}°C</p>
              <p>Humidity: ${data.main.humidity}%</p>
              <p>Wind Speed: ${(data.wind.speed * 3.6).toFixed(1)} km/h</p>
            `;

            document.getElementById("result").innerHTML = html;
          } else {
            document.getElementById("result").innerHTML = `<p style="color:red;">City not found!</p>`;
          }
        }
      };
    }

    document.getElementById("searchInput").addEventListener("keydown", function (event) {
      if (event.key === "Enter") {
        searchCity();
      }
    });