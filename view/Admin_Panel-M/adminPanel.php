<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../user_authentication/login.php");
    exit();
}

require_once('../../model/db.php');

$con = getConnection();

// Check if this is an AJAX request for search results
if (isset($_GET['ajax']) && $_GET['ajax'] == "1") {
    $search_term = '';
    if (isset($_GET['search'])) {
        $search_term = trim($_GET['search']);
        $search_term_esc = mysqli_real_escape_string($con, $search_term);
    } else {
        $search_term_esc = '';
    }

    $sql = "SELECT uid, fname, email, phone, dob, gender, address, country FROM user_info";
    if ($search_term_esc !== '') {
        if (is_numeric($search_term_esc)) {
            $sql .= " WHERE uid = $search_term_esc OR fname LIKE '%$search_term_esc%'";
        } else {
            $sql .= " WHERE fname LIKE '%$search_term_esc%'";
        }
    }

    $result = mysqli_query($con, $sql);

    // Output only table rows
    while ($row = mysqli_fetch_assoc($result)) {
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
    exit(); // Important to stop further output
}

// If not AJAX, load page normally:

// Fetch all users for initial display
$sql = "SELECT uid, fname, email, phone, dob, gender, address, country FROM user_info";
$result = mysqli_query($con, $sql);

// Fetch contact messages for content moderation
$msg_sql = "SELECT full_name, email, subject, message FROM contact";
$msg_result = mysqli_query($con, $msg_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>weather App</title>
  <link rel="stylesheet" href="../../asset/css/adminPanel.css"></head>
<body>
 <div id="container">
  <h2>Admin Panel</h2>

  <div class="nav-buttons">
    <button id="btnUser" class="active">User Management</button>
    <button id="btnContent">Content Moderation</button>
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
        while ($row = mysqli_fetch_assoc($result)) {
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
        while ($msg_row = mysqli_fetch_assoc($msg_result)) {
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
 <script src="../../asset/js/adminPanel.js"></script>
</body>
</html>
