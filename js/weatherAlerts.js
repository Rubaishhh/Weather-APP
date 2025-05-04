
  const alertList = document.getElementById("alertList");
  const severityText = document.getElementById("severityText");
  const durationText = document.getElementById("durationText");
  const descText = document.getElementById("descText");
  const tipsList = document.getElementById("tipsList");

  const alert1 = {
    title: "⚠️ Thunderstorm Warning",
    severity: "High",
    duration: "Until 6 PM",
    description: "Strong winds, lightning, and heavy rain expected. Stay indoors and avoid travel.",
    type: "storm"
  };

  const alert2 = {
    title: "🌊 Flash Flood Advisory",
    severity: "Moderate",
    duration: "4 hours",
    description: "Heavy rainfall may cause flooding. Avoid low-lying areas and basements.",
    type: "flood"
  };

  const alert3 = {
    title: "🔥 High Heat Warning",
    severity: "Severe",
    duration: "12 PM – 8 PM",
    description: "Extreme heat conditions expected. Stay hydrated and indoors. Avoid outdoor work.",
    type: "heat"
  };

  function loadAlerts() {
    alertList.innerHTML = "";

    // Alert 1
    const div1 = document.createElement("div");
    div1.className = "alert-card";
    div1.innerText = alert1.title;
    div1.onclick = function () {
      showDetails(alert1);
    };
    alertList.appendChild(div1);

    // Alert 2
    const div2 = document.createElement("div");
    div2.className = "alert-card";
    div2.innerText = alert2.title;
    div2.onclick = function () {
      showDetails(alert2);
    };
    alertList.appendChild(div2);

    // Alert 3
    const div3 = document.createElement("div");
    div3.className = "alert-card heat";
    div3.innerText = alert3.title;
    div3.onclick = function () {
      showDetails(alert3);
    };
    alertList.appendChild(div3);
  }

  function showDetails(alert) {
    severityText.textContent = alert.severity;
    durationText.textContent = alert.duration;
    descText.textContent = alert.description;
    tipsList.innerHTML = "";

    if (alert.type === "storm") {
      const li1 = document.createElement("li");
      li1.textContent = "Stay indoors and away from windows.";
      tipsList.appendChild(li1);
      const li2 = document.createElement("li");
      li2.textContent = "Unplug electronics during lightning.";
      tipsList.appendChild(li2);
      const li3 = document.createElement("li");
      li3.textContent = "Avoid driving unless necessary.";
      tipsList.appendChild(li3);
    } else if (alert.type === "flood") {
      const li1 = document.createElement("li");
      li1.textContent = "Do not walk or drive through flooded areas.";
      tipsList.appendChild(li1);
      const li2 = document.createElement("li");
      li2.textContent = "Move to higher ground immediately.";
      tipsList.appendChild(li2);
      const li3 = document.createElement("li");
      li3.textContent = "Stay tuned to weather updates.";
      tipsList.appendChild(li3);
    } else if (alert.type === "heat") {
      const li1 = document.createElement("li");
      li1.textContent = "Drink plenty of water.";
      tipsList.appendChild(li1);
      const li2 = document.createElement("li");
      li2.textContent = "Avoid strenuous outdoor activities.";
      tipsList.appendChild(li2);
      const li3 = document.createElement("li");
      li3.textContent = "Use fans or air conditioning when possible.";
      tipsList.appendChild(li3);
    } else {
      const li = document.createElement("li");
      li.textContent = "Follow local weather authority instructions.";
      tipsList.appendChild(li);
    }
  }

  loadAlerts();

