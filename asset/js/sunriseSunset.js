function showTab(tabId) {
  document.getElementById('day-night').style.display = 'none';
  document.getElementById('golden-hour').style.display = 'none';
  document.getElementById('moon').style.display = 'none';

  document.getElementById('dayNightTabBtn').style.backgroundColor = 'rgb(200, 200, 250)';
  document.getElementById('dayNightTabBtn').style.color = 'black';
  document.getElementById('goldenHourTabBtn').style.backgroundColor = 'rgb(200, 200, 250)';
  document.getElementById('goldenHourTabBtn').style.color = 'black';
  document.getElementById('moonTabBtn').style.backgroundColor = 'rgb(200, 200, 250)';
  document.getElementById('moonTabBtn').style.color = 'black';

  document.getElementById(tabId).style.display = 'block';

  if (tabId === 'day-night') {
    document.getElementById('dayNightTabBtn').style.backgroundColor = 'rgb(100, 150, 250)';
    document.getElementById('dayNightTabBtn').style.color = 'white';
  } else if (tabId === 'golden-hour') {
    document.getElementById('goldenHourTabBtn').style.backgroundColor = 'rgb(100, 150, 250)';
    document.getElementById('goldenHourTabBtn').style.color = 'white';
  } else if (tabId === 'moon') {
    document.getElementById('moonTabBtn').style.backgroundColor = 'rgb(100, 150, 250)';
    document.getElementById('moonTabBtn').style.color = 'white';
  }
}


document.getElementById('dayNightTabBtn').onclick = function () { showTab('day-night'); };
document.getElementById('goldenHourTabBtn').onclick = function () { showTab('golden-hour'); };
document.getElementById('moonTabBtn').onclick = function () { showTab('moon'); };


showTab('day-night');
