const bell = document.getElementById("bell");
    const badge = document.getElementById("badge");
    const panel = document.getElementById("panel");

    let notifications = [];

    const apiKey = "29f608cad39dc1b3b89b3df31040bb39"; 
    const city = "Dhaka";

    function checkTemperature(temp) {
      if (temp <= 25) return null; 
      if (temp > 35) return " Too Much Hot! (" + temp + "°C)";
      return " It's Hot (" + temp + "°C)";
    }

    function fetchTemperature() {
      const xhr = new XMLHttpRequest();
      const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${apiKey}`;

      xhr.open("GET", url, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            try {
              const data = JSON.parse(xhr.responseText);
              const temp = data.main.temp;
              const message = checkTemperature(temp);
              if (message) {
                notifications.push(message);
                badge.textContent = notifications.length;
              }
            } catch (e) {
              console.error("Error parsing response:", e);
            }
          } else {
            console.error("API request failed with status:", xhr.status);
          }
        }
      };
      xhr.send();
    }

    bell.onclick = function () {
      if (panel.style.display === "block") {
        panel.style.display = "none";
      } else {
        panel.innerHTML = "";
        if (notifications.length === 0) {
          panel.innerHTML = "<div class='notif-item'>No notifications</div>";
        } else {
          notifications.forEach(msg => {
            const div = document.createElement("div");
            div.className = "notif-item";
            div.textContent = msg;
            panel.appendChild(div);
          });
        }
        panel.style.display = "block";
        badge.textContent = 0;
        notifications = [];
      }
    };

    // Fetch immediately on load
    fetchTemperature();

    // Then fetch every 15 seconds
    setInterval(fetchTemperature, 15000);
