<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Weather App Admin Panel</title>
  <link rel="stylesheet" href="../../asset/css/adminPanel.css" />
</head>
<body>
  <div id="container">
    <div id="title">Weather App Admin Panel</div>

    <div>
      <button id="usermanagement" class="tabButton" style="background-color: rgb(180,180,250);">User Management</button>
      <button id="contentmoderation" class="tabButton">Content Moderation</button>
      <button id="settings" class="tabButton">System Settings</button>
    </div>

    <!-- User Management -->
    <div id="usermanagementContent" class="tabSection" style="display: block;">
      <input type="text" id="userSearch" placeholder="Search users..." />
      <button id="addUserBtn">Add User</button>
      <table>
        <tr>
          <th>Fullname</th><th>Email</th><th>Phone</th><th>DOB</th><th>Gender</th><th>Address</th><th>Country</th>
        </tr>
      </table>
    </div>

    <!-- Content Moderation -->
    <div id="contentmoderationContent" class="tabSection" style="display: none;">
      <input type="text" id="contentSearch" placeholder="Search by username..." />
      <table>
        <tr><th>Username</th><th>Password</th></tr>
      </table>
    </div>

    <!-- System Settings -->
    <div id="settingsContent" class="tabSection" style="display: none;">
      <label for="defaultLocation">Default Weather Location</label><br />
      <input type="text" id="defaultLocation" value="Dhaka" /><br />
      <button id="saveBtn">Save Settings</button>
    </div>
  </div>

  <script src="../../asset/js/adminPanel.js"></script>
</body>
</html>
