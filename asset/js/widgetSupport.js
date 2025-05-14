
    let selectedWidget = '';

    const widgetConfigs = {
        current: {
            name: "Current Weather",
            options: [
                { id: "showFeelsLike", label: "Show 'Feels Like' temperature", checked: true },
                { id: "showHumidity", label: "Show humidity", checked: false }
            ]
        },
        hourly: {
            name: "Hourly Forecast",
            options: [
                { id: "showPrecipitation", label: "Show precipitation chance", checked: true },
                { id: "hoursToShow", label: "Hours to display:", type: "select", options: [6, 12, 24], selected: 12 }
            ]
        },
        daily: {
            name: "Daily Forecast",
            options: [
                { id: "showHighTemp", label: "Show high temperature", checked: true },
                { id: "showConditions", label: "Show weather conditions", checked: true }
            ]
        },
        '5day': {
            name: "5-Day Forecast",
            options: [
                { id: "showHighLow", label: "Show high/low temps", checked: true },
                { id: "showPrecip", label: "Show precipitation chance", checked: false }
            ]
        }
    };

    function showCustomPanel(widgetType) {
        selectedWidget = widgetType;
        document.getElementById('galleryScreen').style.display = 'none';
        document.getElementById('customPanel').style.display = 'block';
        document.getElementById('panelTitle').textContent = "Customize " + widgetConfigs[widgetType].name;

        const optionsContainer = document.getElementById('customOptions');
        optionsContainer.innerHTML = '';

        widgetConfigs[widgetType].options.forEach(option => {
            if (option.type === "select") {
                let optionsHtml = '';
                for (let i = 0; i < option.options.length; i++) {
                    let opt = option.options[i];
                    if (opt === option.selected) {
                        optionsHtml += '<option value="' + opt + '" selected>' + opt + '</option>';
                    } else {
                        optionsHtml += '<option value="' + opt + '">' + opt + '</option>';
                    }
                }
                optionsContainer.innerHTML +=
                    '<label>' + option.label +
                    '<select id="' + option.id + '">' + optionsHtml + '</select>' +
                    '</label><br>';
            } else {
                let checked = '';
                if (option.checked) {
                    checked = 'checked';
                }
                optionsContainer.innerHTML +=
                    '<label><input type="checkbox" id="' + option.id + '" ' + checked + '>' +
                    option.label + '</label><br>';
            }
        });

        updatePreview();

        let allInputs = document.querySelectorAll('input, select');
        for (let i = 0; i < allInputs.length; i++) {
            allInputs[i].onclick = function () {
                updatePreview();
            };
        }
    }

    function hideCustomPanel() {
        document.getElementById('galleryScreen').style.display = 'block';
        document.getElementById('customPanel').style.display = 'none';
    }

    function updatePreview() {
        const size = document.querySelector('input[name="size"]:checked').value;
        const preview = document.getElementById('livePreview');

        let content = '';
        if (selectedWidget === 'current') {
            const showFeelsLike = document.getElementById('showFeelsLike').checked;
            const showHumidity = document.getElementById('showHumidity').checked;

            let feelsLikeText = '';
            if (showFeelsLike) {
                feelsLikeText = ' (Feels like 75°F)';
            }

            let humidityText = '';
            if (showHumidity) {
                humidityText = '<p>Humidity: 65%</p>';
            }

            content =
                '<h3>Current Weather (' + size + ')</h3>' +
                '<div style="padding: ' + getPadding(size) + ';' +
                'background: #e8f0fe; border-radius: 8px; text-align: center;">' +
                '<p>Sunny</p>' +
                '<p style="font-size: ' + getFontSize(size) + '">72°F' + feelsLikeText + '</p>' +
                '<p>New York, NY</p>' +
                humidityText +
                '</div>';
        }
        else if (selectedWidget === 'hourly') {
            const showPrecipitation = document.getElementById('showPrecipitation').checked;
            const hoursToShow = document.getElementById('hoursToShow').value;

            const allHours = [
                { time: "Now", icon: "☀️", temp: 72, precip: "10%" },
                { time: "1PM", icon: "☀️", temp: 74, precip: "10%" },
                { time: "2PM", icon: "⛅", temp: 73, precip: "20%" },
                { time: "3PM", icon: "🌧️", temp: 68, precip: "60%" },
                { time: "4PM", icon: "🌧️", temp: 67, precip: "40%" },
                { time: "5PM", icon: "⛅", temp: 69, precip: "30%" }
            ];

            const limit = parseInt(hoursToShow, 10) / 6;
            const hours = allHours.slice(0, limit);
            let hourlyItems = '';
            for (let i = 0; i < hours.length; i++) {
                let width = '90px';
                if (size === 'small') {
                    width = '50px';
                } else if (size === 'medium') {
                    width = '70px';
                }

                let precipHtml = '';
                if (showPrecipitation) {
                    precipHtml = '<div>' + hours[i].precip + '</div>';
                }

                hourlyItems +=
                    '<div class="hourly-item" style="min-width: ' + width + ';">' +
                    '<div>' + hours[i].time + '</div>' +
                    '<div>' + hours[i].icon + '</div>' +
                    '<div>' + hours[i].temp + '°</div>' +
                    precipHtml +
                    '</div>';
            }

            content =
                '<h3>Hourly Forecast (' + size + ')</h3>' +
                '<div style="padding: ' + getPadding(size) + '; background: #e8f0fe; border-radius: 8px;">' +
                '<div class="hourly-forecast">' + hourlyItems + '</div></div>';
        }
        else if (selectedWidget === 'daily') {
            const showHighTemp = document.getElementById('showHighTemp').checked;
            const showConditions = document.getElementById('showConditions').checked;

            const days = [
                { day: "Today", icon: "☀️", temp: 72 },
                { day: "Tue", icon: "⛅", temp: 68 },
                { day: "Wed", icon: "🌧️", temp: 65 },
                { day: "Thu", icon: "☀️", temp: 70 },
                { day: "Fri", icon: "⛅", temp: 69 }
            ];

            let dailyItems = '';
            for (let i = 0; i < days.length; i++) {
                let line = '';
                if (showConditions) {
                    line += days[i].icon + ' ';
                }
                if (showHighTemp) {
                    line += days[i].temp + '°';
                }
                dailyItems += '<div class="daily-row"><span>' + days[i].day + '</span><span>' + line + '</span></div>';
            }

            content =
                '<h3>Daily Forecast (' + size + ')</h3>' +
                '<div style="padding: ' + getPadding(size) + '; background: #e8f0fe; border-radius: 8px;">' +
                '<div class="daily-forecast">' + dailyItems + '</div></div>';
        }
        else if (selectedWidget === '5day') {
            const showHighLow = document.getElementById('showHighLow').checked;
            const showPrecip = document.getElementById('showPrecip').checked;

            const days = [
                { day: "Today", icon: "☀️", high: 72, low: 58, precip: "10%" },
                { day: "Tuesday", icon: "⛅", high: 68, low: 55, precip: "20%" },
                { day: "Wednesday", icon: "🌧️", high: 65, low: 52, precip: "60%" },
                { day: "Thursday", icon: "☀️", high: 70, low: 56, precip: "10%" },
                { day: "Friday", icon: "⛅", high: 69, low: 57, precip: "30%" }
            ];

            let dailyItems = '';
            for (let i = 0; i < days.length; i++) {
                let line = days[i].icon + ' ';
                if (showHighLow) {
                    line += days[i].high + '°/' + days[i].low + '°';
                } else {
                    line += days[i].high + '°';
                }
                if (showPrecip) {
                    line += ' | ' + days[i].precip;
                }
                dailyItems += '<div class="daily-row"><span>' + days[i].day + '</span><span>' + line + '</span></div>';
            }

            content =
                '<h3>5-Day Forecast (' + size + ')</h3>' +
                '<div style="padding: ' + getPadding(size) + '; background: #e8f0fe; border-radius: 8px;">' +
                '<div class="daily-forecast">' + dailyItems + '</div></div>';
        }

        preview.innerHTML = content;
    }

    function getPadding(size) {
        if (size === 'small') {
            return '10px';
        } else if (size === 'medium') {
            return '15px';
        } else {
            return '20px';
        }
    }

    function getFontSize(size) {
        if (size === 'small') {
            return '18px';
        } else if (size === 'medium') {
            return '22px';
        } else {
            return '26px';
        }
    }

    function saveWidget() {
        alert(widgetConfigs[selectedWidget].name + " widget saved!");
        hideCustomPanel();
    }

    function addWidget(type) {
        alert(widgetConfigs[type].name + " widget added with default settings!");
    }

