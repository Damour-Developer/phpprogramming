<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New User</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .form-container {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 400px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .message {
      text-align: center;
      margin-top: 15px;
      color: green;
    }
  </style>
</head>
<body>
  

<div class="form-container">
  <h2>Register New User</h2>

  <form action=" " method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <label for="role">Role:</label>
    <select name="role" id="role" required>
      <option value="">--Select Role--</option>
      <option value="DOS">DOS</option>
      <option value="Admin">Admin</option>
      <option value="Teacher">student</option>
    </select>

    <input type="submit" value="Create User">
  </form>
</div>

</body>
</html>
<?php
$conn = mysqli_connect("localhost", "root", "", "gikonko_tsss");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

// Hash the password securely
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert into database
if ($username && $password && $role) {
    $sql = "INSERT INTO Users (Username, Password, Role) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $username, $hashed_password, $role);

    if (mysqli_stmt_execute($stmt)) {
        echo "<p class='message'>User registered successfully!</p>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "All fields are required.";
}

mysqli_close($conn);
?>
