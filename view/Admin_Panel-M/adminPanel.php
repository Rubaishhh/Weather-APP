<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Weather App Admin Panel</title>
  <link rel="stylesheet" href="/css/adminPanel.css" />
</head>
<body>
  <div class="container">
    <h1>Weather App Admin Panel</h1>
    <div class="tabs">
      <button class="tab-btn active">User Management</button>
      <button class="tab-btn">Content Moderation</button>
      <button class="tab-btn">System Settings</button>
    </div>

    <div id="users" class="tab-content active">
      <div class="search-filter">
        <div class="search-box">
          <input type="text" placeholder="Search users..." />
        </div>
        <button class="btn btn-primary">Add User</button>
      </div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
          </tr>
        </thead>
      </table>
    </div>

    <div id="content" class="tab-content">
      <div class="search-filter">
        <div class="search-box">
          <input type="text" placeholder="Search content..." />
        </div>
      </div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Content</th>
            <th>Type</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
      </table>
    </div>

    <div id="settings" class="tab-content">
      <form id="settings-form">
        <div class="form-group">
          <label for="site-name">Site Name</label>
          <input type="text" id="site-name" value="WeatherNow" />
        </div>
        <div class="form-group">
          <label for="site-url">Site URL</label>
          <input type="text" id="site-url" value="https://weathernow.com" />
        </div>
        <div class="form-group">
          <label for="timezone">Timezone</label>
          <select id="timezone">
            <option value="UTC">UTC</option>
            <option value="EST">EST</option>
            <option value="PST">PST</option>
            <option value="Asia/Dhaka" selected>Asia/Dhaka</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Save Settings</button>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const tabButtons = document.querySelectorAll('.tab-btn');
      const tabContents = [
        document.getElementById('users'),
        document.getElementById('content'),
        document.getElementById('settings')
      ];

      tabButtons.forEach(function (btn, index) {
        btn.onclick = function () {
          // Deactivate all tabs
          tabButtons.forEach(function (b) {
            b.className = 'tab-btn';
          });
          tabContents.forEach(function (content) {
            content.className = 'tab-content';
          });

          // Activate current tab
          btn.className = 'tab-btn active';
          tabContents[index].className = 'tab-content active';
        };
      });

      const settingsForm = document.getElementById('settings-form');
      if (settingsForm) {
        settingsForm.onsubmit = function (e) {
          e.preventDefault();
          const siteName = document.getElementById('site-name').value;
          const siteUrl = document.getElementById('site-url').value;
          const timezone = document.getElementById('timezone').value;

          if (!siteName || !siteUrl) {
            alert('Please fill in all required fields');
            return;
          }

          if (!siteUrl.startsWith('http://') && !siteUrl.startsWith('https://')) {
            alert('Please enter a valid URL starting with http:// or https://');
            return;
          }

          alert('Settings saved successfully! (simulated)');
        };
      }

      const addUserBtn = document.querySelector('#users .btn-primary');
      if (addUserBtn) {
        addUserBtn.onclick = function () {
          alert('Add User functionality would open a form here');
        };
      }
    });
  </script>
</body>
</html>
