function fetchWeather(url) {
      const xhr = new XMLHttpRequest();
      xhr.open("GET", url, true);

      xhr.onload = function () {
        if (xhr.status === 200) {
          const data = JSON.parse(xhr.responseText);
          const sunrise = new Date(data.sys.sunrise * 1000).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
          const sunset = new Date(data.sys.sunset * 1000).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

          document.getElementById("sunriseTime").textContent = sunrise;
          document.getElementById("sunsetTime").textContent = sunset;
          document.getElementById("cityError").textContent = "";
        } else {
          document.getElementById("cityError").textContent = "Weather not found!";
        }
      };

      xhr.onerror = function () {
        document.getElementById("cityError").textContent = "Request failed.";
      };

      xhr.send();
    }

    function getCoordinates(city, apiKey) {
      const geoUrl = `https://api.openweathermap.org/geo/1.0/direct?q=${encodeURIComponent(city)}&limit=1&appid=${apiKey}`;
      const xhr = new XMLHttpRequest();
      xhr.open("GET", geoUrl, true);

      xhr.onload = function () {
        const data = JSON.parse(xhr.responseText);
        if (data.length === 0) {
          document.getElementById("cityError").textContent = "City not found.";
          return;
        }
        const lat = data[0].lat;
        const lon = data[0].lon;
        const weatherUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}`;
        fetchWeather(weatherUrl);
      };

      xhr.onerror = function () {
        document.getElementById("cityError").textContent = "Request failed.";
      };

      xhr.send();
    }

    function getWeatherByCoords(lat, lon, apiKey) {
      const weatherUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}`;
      fetchWeather(weatherUrl);
    }

    document.getElementById("weatherForm").addEventListener("submit", function (e) {
      e.preventDefault();
      const city = document.getElementById("cityName").value.trim();
      const apiKey = "29f608cad39dc1b3b89b3df31040bb39";

      if (city === "") {
        getLocationAndFetchWeather();
      } else {
        getCoordinates(city, apiKey);
      }
    });

    function getLocationAndFetchWeather() {
      const apiKey = "29f608cad39dc1b3b89b3df31040bb39";

      if (!navigator.geolocation) {
        document.getElementById("cityError").textContent = "Geolocation not supported.";
        return;
      }

      navigator.geolocation.getCurrentPosition(function(position) {
        getWeatherByCoords(position.coords.latitude, position.coords.longitude, apiKey);
      }, function() {
        document.getElementById("cityError").textContent = "Could not get location.";
      });
    }

    window.onload = function() {
      const city = document.getElementById("cityName").value.trim();
      const apiKey = "29f608cad39dc1b3b89b3df31040bb39";

      if (city === "") {
        getLocationAndFetchWeather();
      } else {
        getCoordinates(city, apiKey);
      }
    };