let currentData = [
    { date: "2025-05-01", temp: 29, weather: "Clear sky" },
    { date: "2025-05-02", temp: 28, weather: "Light rain" },
    { date: "2025-05-03", temp: 27, weather: "Cloudy" },
    { date: "2025-05-04", temp: 30, weather: "Sunny" },
    { date: "2025-05-05", temp: 26, weather: "Thunderstorm" }
  ];
  
  function getWeather() {
    const city = document.getElementById("cityInput").value;
    if (!city) {
      alert("Please enter a city.");
      return;
    }
    alert("Weather data fetched for " + city + " (mock data shown).");
  }
  
  function getWeatherByLocation() {
    alert("Current location weather (mock data shown).");
  }
  
  function exportData() {
    const format = document.getElementById("format").value;
    const start = document.getElementById("startDate").value;
    const end = document.getElementById("endDate").value;
  
    let filtered = [];
  
    if (start && !end) {
      filtered = currentData.filter(function(d) {
        return d.date === start;
      });
    } else if (start && end) {
      filtered = currentData.filter(function(d) {
        return d.date >= start && d.date <= end;
      });
    } else if (!start && end) {
      alert("Please select a start date when selecting an end date.");
      return;
    } else {
      alert("Please select at least a start date.");
      return;
    }
  
    if (filtered.length === 0) {
      alert("No data found in the selected date(s).");
      return;
    }
  
    if (format === "csv") {
      let csv = "Date,Temperature,Weather\n";
      filtered.forEach(function(d) {
        csv += d.date + "," + d.temp + "," + d.weather + "\n";
      });
      const blob = new Blob([csv], { type: "text/csv" });
      const link = document.createElement("a");
      link.href = URL.createObjectURL(blob);
      link.download = "weather_report.csv";
      link.click();
    } else if (format === "pdf") {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();
      doc.setFontSize(12);
      doc.text("Weather Report", 10, 10);
      let y = 20;
      filtered.forEach(function(d) {
        doc.text(d.date + " - " + d.temp + "°C - " + d.weather, 10, y);
        y += 10;
      });
      doc.save("weather_report.pdf");
    }
  }
  