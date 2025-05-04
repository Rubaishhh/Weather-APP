function switchTab(tabId) {
    // Select all the tab buttons and content divs
    var dayNightTab = document.getElementById('day-night-tab');
    var goldenHourTab = document.getElementById('golden-hour-tab');
    var moonPhaseTab = document.getElementById('moon-phase-tab');
  
    var dayNightContent = document.getElementById('day-night');
    var goldenHourContent = document.getElementById('golden-hour');
    var moonPhaseContent = document.getElementById('moon-phase');
  
    // Remove the active class manually
    dayNightTab.className = dayNightTab.className.replace(' active', '');
    goldenHourTab.className = goldenHourTab.className.replace(' active', '');
    moonPhaseTab.className = moonPhaseTab.className.replace(' active', '');
  
    dayNightContent.className = dayNightContent.className.replace(' active', '');
    goldenHourContent.className = goldenHourContent.className.replace(' active', '');
    moonPhaseContent.className = moonPhaseContent.className.replace(' active', '');
  
    // Add the active class to the clicked tab and corresponding content
    if (tabId === 'day-night') {
      dayNightTab.className += ' active';
      dayNightContent.className += ' active';
    } else if (tabId === 'golden-hour') {
      goldenHourTab.className += ' active';
      goldenHourContent.className += ' active';
    } else if (tabId === 'moon-phase') {
      moonPhaseTab.className += ' active';
      moonPhaseContent.className += ' active';
    }
  }
  
  document.getElementById('day-night-tab').onclick = function () {
    switchTab('day-night');
  };
  document.getElementById('golden-hour-tab').onclick = function () {
    switchTab('golden-hour');
  };
  document.getElementById('moon-phase-tab').onclick = function () {
    switchTab('moon-phase');
  };
  