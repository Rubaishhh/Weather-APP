<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../user_authentication/login.php");
    exit();
}
require_once('../../model/db.php');
require_once('../../model/user_infomodel.php'); // include DB connection

$con = getConnection();

$search_term = '';

// If form submitted, get the search term safely
if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET['search'])) {
    $search_term = trim($_GET['search']);
    $search_term_esc = mysqli_real_escape_string($con, $search_term);
} else {
    $search_term_esc = '';
}

// Build SQL query: search uid or fullname (fname)
$sql = "SELECT uid, fname, email, phone, dob, gender, address, country FROM user_info";

if ($search_term_esc !== '') {
    // Check if search term is numeric for uid search
    if (is_numeric($search_term_esc)) {
        $sql .= " WHERE uid = $search_term_esc OR fname LIKE '%$search_term_esc%'";
    } else {
        $sql .= " WHERE fname LIKE '%$search_term_esc%'";
    }
}

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Management</title>
</head>
<body>
  <div id="container">
    <h2>User Management</h2>

    <!-- Search Form -->
    <form id="searchForm" method="GET" action="">
      <input type="text" name="search" placeholder="Search by UID or Fullname" value="<?php echo htmlspecialchars($search_term); ?>" />
      <button type="submit">Search</button>
      <a class="add-user-btn" href="add_user.php">Add User</a>
    </form>

    <!-- User Table -->
    <table>
      <thead>
        <tr>
          <th>uid</th>
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
      <tbody>
        <?php
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . $row['uid'] . "</td>";
              echo "<td>" . $row['fname'] . "</td>";
              echo "<td>" . $row['email'] . "</td>";
              echo "<td>" . $row['phone'] . "</td>";
              echo "<td>" . $row['dob'] . "</td>";
              echo "<td>" . $row['gender'] . "</td>";
              echo "<td>" . $row['address'] . "</td>";
              echo "<td>" . $row['country'] . "</td>";
              echo '<td>
                      <a class="action-btn edit-btn" href="edit.php?id=' . $row['uid'] . '">Edit</a>
                      <a class="action-btn delete-btn" href="delete.php?id=' . $row['uid'] . '" onclick="return confirm(\'Are you sure to delete this user?\');">Delete</a>
                    </td>';
              echo "</tr>";
            }
        
        ?>
      </tbody>
    </table>
  </div>
  <script></script>
</body>
</html>
