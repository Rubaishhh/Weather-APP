let locations = JSON.parse(localStorage.getItem("locations")) || [];

function renderList() {
  const list = document.getElementById("loc_list");
  list.innerHTML = "";

  for (let i = 0; i < locations.length; i++) {
    const city = locations[i];
  
    const li = document.createElement("li");
    li.innerHTML = `
      <span class="city-name" onclick="viewWeather('${city}')">${i + 1}. ${city}</span>
      <div class="actions">
        <button onclick="moveUp(${i})">up</button>
        <button onclick="moveDown(${i})">down</button>
        <button onclick="deleteLocation(${i})">cross</button>
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

function deleteLocation(i) {
  locations.splice(i, 1);
  renderList();
}

function moveUp(i) {
  if (i > 0) {
    [locations[i - 1], locations[i]] = [locations[i], locations[i - 1]];
    renderList();
  }
}

function moveDown(i) {
  if (i < locations.length - 1) {
    [locations[i + 1], locations[i]] = [locations[i], locations[i + 1]];
    renderList();
  }
}

function viewWeather(city) {
  window.location.href = `dashboard.html?city=${encodeURIComponent(city)}`;
}

renderList();
