let locations = JSON.parse(localStorage.getItem("locations")) || [];

function renderList() {
  const list = document.getElementById("loc_list");
  list.innerHTML = "";

  for (let index = 0; index < locations.length; index++) {
    const city = locations[index];
  
    const li = document.createElement("li");
    li.innerHTML = `
      <span class="city-name" onclick="viewWeather('${city}')">${index + 1}. ${city}</span>
      <div class="actions">
        <button onclick="moveUp(${index})">⬆</button>
        <button onclick="moveDown(${index})">⬇</button>
        <button onclick="deleteLocation(${index})">❌</button>
      </div>
    `;
    list.appendChild(li);
  }
  

  localStorage.setItem("locations", JSON.stringify(locations));
}

function addLocation() {
  const input = document.getElementById("loc_input");
  const city = input.value.trim();
  if (city && !locations.includes(city)) {
    locations.push(city);
    input.value = "";
    renderList();
  } else {
    alert("Enter a unique city name.");
  }
}

function deleteLocation(index) {
  locations.splice(index, 1);
  renderList();
}

function moveUp(index) {
  if (index > 0) {
    [locations[index - 1], locations[index]] = [locations[index], locations[index - 1]];
    renderList();
  }
}

function moveDown(index) {
  if (index < locations.length - 1) {
    [locations[index + 1], locations[index]] = [locations[index], locations[index + 1]];
    renderList();
  }
}

function viewWeather(city) {
  window.location.href = `dashboard.html?city=${encodeURIComponent(city)}`;
}

renderList();
