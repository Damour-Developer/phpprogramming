<?php
$conn = mysqli_connect("localhost", "root", "", "gikonko_tsss");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM Users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Users</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
      padding: 40px;
    }

    h2 {
      text-align: center;
      color: #333;
    }

    table {
      width: 90%;
      margin: 0 auto;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 10px;
      overflow: hidden;
    }

    th, td {
      padding: 12px 15px;
      border-bottom: 1px solid #ddd;
      text-align: center;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    tr:hover {
      background-color: #f9f9f9;
    }

    a.button {
      padding: 6px 12px;
      background-color: #2196F3;
      color: white;
      text-decoration: none;
      border-radius: 4px;
      margin: 2px;
      display: inline-block;
    }

    a.button.delete {
      background-color: #f44336;
    }

    a.button:hover {
      opacity: 0.9;
    }
  </style>
</head>
<body>

<h2>All Registered Users</h2>

<table>
  <thead>
    <tr>
      <th>User_Id</th>
      <th>Username</th>
      <th>Password</th>
      <th>Role</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php if (mysqli_num_rows($result) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= htmlspecialchars($row['User_Id']) ?></td>
          <td><?= htmlspecialchars($row['Username']) ?></td>
          <td><?= htmlspecialchars($row['Password']) ?></td>
          <td><?= htmlspecialchars($row['Role']) ?></td>
          <td>
            <a class="button" href="update_user.php?User_Id=<?= $row['User_Id'] ?>">Update</a>
            <a class="button delete" href="delete_user.php?User_Id=<?= $row['User_Id'] ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="5">No users found.</td></tr>
    <?php endif; ?>
  </tbody>
</table>

</body>
</html>

<?php
mysqli_close($conn);
?>
