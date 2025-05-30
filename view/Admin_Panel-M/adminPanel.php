<?php
require_once('../../controller/adminController.php'); // include the controller
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    #container {
      width: 90%;
      margin: auto;
    }
    

    .nav-buttons {
      margin: 20px 0;
    }

    .nav-buttons button {
      padding: 10px 20px;
      margin-right: 10px;
      cursor: pointer;
    }

    .active {
      background-color: rgb(255, 255, 255);
      color: black;
    }

    .section {
      display: none;
    }

    .section.active {
      display: block;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 8px;
    }

    th {
      background-color: #f4f4f4;
    }

    .action-btn {
      margin-right: 5px;
      text-decoration: none;
      padding: 4px 8px;
      border-radius: 4px;
    }

    .edit-btn {
      background-color: rgb(60, 179, 113);
      color: white;
    }

    .delete-btn {
      background-color: rgb(220, 20, 60);
      color: white;
    }
  .top-buttons {
  position: absolute;
  top: 20px;
  right: 20px;
  display: flex;
  gap: 10px;
}

#logout, #dashboard {
  padding: 8px 16px;
  background-color: rgb(70, 130, 180);
  color: white;
  text-decoration: none;
  border-radius: 4px;
  font-weight: bold;
  cursor: pointer;
}

#logout {
  background-color: crimson;
}

    .add-user-btn {
      margin-left: 10px;
      background-color: rgb(70, 130, 180);
      color: white;
      padding: 6px 10px;
      border-radius: 4px;
      text-decoration: none;
    }
    .btnUser {
       background-color: rgb(70, 130, 180);
    }
    .btnContent {
       background-color: rgb(70, 130, 180);
    }
  </style>
</head>
<body>
<div id="container">
  <h2>Admin Panel</h2>

  <div class="nav-buttons">
    <button id="btnUser" class="active">User Management</button>
    <button id="btnContent">Content Moderation</button>
  </div>
 <div class="top-buttons">
  <a href="../Dashboard/dashboard.php" id="dashboard">Dashboard</a>
  <a href="../../controller/logout.php" id="logout">Logout</a>
</div>




  <div id="userSection" class="section active">
    <form id="searchForm">
      <input type="text" id="searchInput" placeholder="Search by UID or Fullname" />
      <button type="submit">Search</button>
      <a class="add-user-btn" href="addUser.php">Add User</a>
    </form>

    <table>
      <thead>
        <tr>
          <th>UID</th>
          <th>Fullname</th>
          <th>Email</th>
          <th>Phone</th>
          <th>DOB</th>
          <th>Gender</th>
          <th>Address</th>
          <th>Country</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="userTableBody">
        <?php
        while ($row = mysqli_fetch_assoc($users)) {
            echo "<tr>";
            echo "<td>{$row['uid']}</td>";
            echo "<td>{$row['fname']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['phone']}</td>";
            echo "<td>{$row['dob']}</td>";
            echo "<td>{$row['gender']}</td>";
            echo "<td>{$row['address']}</td>";
            echo "<td>{$row['country']}</td>";
            echo "<td>
                    <a class='action-btn edit-btn' href='edit.php?id={$row['uid']}'>Edit</a>
                    <a class='action-btn delete-btn' href='delete.php?id={$row['uid']}' onclick='return confirm(\"Are you sure to delete this user?\");'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <div id="contentSection" class="section">
    <h3>Contact Messages</h3>
    <table>
      <thead>
        <tr>
          <th>Full Name</th>
          <th>Email</th>
          <th>Subject</th>
          <th>Message</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($msg_row = mysqli_fetch_assoc($messages)) {
            echo "<tr>";
            echo "<td>{$msg_row['full_name']}</td>";
            echo "<td>{$msg_row['email']}</td>";
            echo "<td>{$msg_row['subject']}</td>";
            echo "<td>{$msg_row['message']}</td>";
            echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Corrected JavaScript: DO NOT place inline code inside src tag -->
<script src="../../asset/js/adminPanel.js"></script>
<script>
  let btnUser = document.getElementById("btnUser");
  let btnContent = document.getElementById("btnContent");
  let userSection = document.getElementById("userSection");
  let contentSection = document.getElementById("contentSection");

  btnUser.onclick = function () {
    btnUser.className = "active";
    btnContent.className = "";

    userSection.className = "section active";
    contentSection.className = "section";
  };

  btnContent.onclick = function () {
    btnContent.className = "active";
    btnUser.className = "";

    userSection.className = "section";
    contentSection.className = "section active";
  };

  document.getElementById("searchForm").onsubmit = function (event) {
    event.preventDefault();

    let search = document.getElementById("searchInput").value;
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "adminPanel.php?ajax=1&search=" + encodeURIComponent(search), true);

    xhr.onload = function () {
      if (xhr.status === 200) {
        document.getElementById("userTableBody").innerHTML = xhr.responseText;
      } else {
        alert("Failed to fetch data");
      }
    };

    xhr.send();
  };
</script>
</body>
</html>
