const apiKey = "29f608cad39dc1b3b89b3df31040bb39";

function requestNotificationPermission() {
  if ("Notification" in window && Notification.permission === "default") {
    Notification.requestPermission();
  }
}

function showNotification(title, message) {
  if (Notification.permission === "granted") {
    new Notification(title, {
      body: message
    });
  }
}

function addAlertToInbox(title, message, severity) {
  const inbox = document.getElementById("alertInbox");
  const noAlerts = document.getElementById("noAlerts");
  if (noAlerts) noAlerts.style.display = "none";

  const alertDiv = document.createElement("div");
  alertDiv.className = "alertItem";
  if (severity === "high") alertDiv.classList.add("high");

  const timeStr = new Date().toLocaleString();
  alertDiv.innerHTML = `
    <div class="title">${title}</div>
    <div class="time">${timeStr}</div>
    <div class="message">${message}</div>
  `;

  inbox.insertBefore(alertDiv, inbox.firstChild);
}

function fetchWeatherAndTriggerAlerts(lat, lon) {
  const url = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`;

  fetch(url)
    .then(res => res.json())
    .then(data => {
      const temp = data.main.temp;
      const city = data.name;
      let title = "", message = "", severity = "normal";

      if (temp >= 35) {
        title = "⚠️ Extreme Heat Alert!";
        message = `It's ${temp}°C in ${city}. Do NOT go outside! Stay safe and hydrated.`;
        severity = "high";
      } else if (temp >= 25) {
        title = "🌞 Hot Weather Warning";
        message = `It's ${temp}°C in ${city}. Drink plenty of water and stay cool.`;
      } else {
        title = "🌤️ Weather Update";
        message = `It's a comfortable ${temp}°C in ${city}. Have a nice day!`;
      }

      addAlertToInbox(title, message, severity);
      showNotification(title, message);
    })
    .catch(() => {
      addAlertToInbox("Error", "Could not fetch weather data.", "high");
    });
}

function detectLocationAndAlert() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      pos => fetchWeatherAndTriggerAlerts(pos.coords.latitude, pos.coords.longitude),
      () => fetchWeatherAndTriggerAlerts(23.8103, 90.4125)
    );
  } else {
    fetchWeatherAndTriggerAlerts(23.8103, 90.4125);
  }
}

// 👇 These run directly — no need for onload
requestNotificationPermission();
detectLocationAndAlert();
