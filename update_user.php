<?php
$conn = mysqli_connect("localhost", "root", "", "gikonko_tsss");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Validate User_Id from URL
if (isset($_GET['User_Id']) || empty($_GET['User_Id'])) {
    die("User ID not provided.");
}

$user_id = intval($_GET['User_Id']);
$message = "";

// Fetch user data
$sql = "SELECT * FROM Users WHERE User_Id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) === 0) {
    die("User not found.");
}

$user = mysqli_fetch_assoc($result);

// Handle form submission securely
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['Username']);
    $password = trim($_POST['Password']);
    $role = trim($_POST['Role']);

    if (empty($username) || empty($password) || empty($role)) {
        $message = "<p style='color:red;'>All fields are required.</p>";
    } else {
        // Secure password hashing
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $update_sql = "UPDATE Users SET Username=?, Password=?, Role=? WHERE User_Id=?";
        $stmt = mysqli_prepare($conn, $update_sql);
        mysqli_stmt_bind_param($stmt, "sssi", $username, $hashed_password, $role, $user_id);

        if (mysqli_stmt_execute($stmt)) {
            $message = "<p style='color:green;'>User updated successfully.</p>";
            // Refresh user data
            $user = ['Username' => $username, 'Password' => $hashed_password, 'Role' => $role];
        } else {
            $message = "<p style='color:red;'>Error updating user: " . mysqli_error($conn) . "</p>";
        }
    }
}

mysqli_close($conn);
?>
