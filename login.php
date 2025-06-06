<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "gikonko_tsss");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['names']);
    $password = $_POST['password'];
    $role = trim($_POST['role']);

    $sql = "SELECT * FROM users WHERE Username = ? AND Role = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $role);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['Password'])) {
            $_SESSION['Username'] = $username;
            $_SESSION['Role'] = $role;

            // Redirect based on role
            if (strtolower($role) === 'admin') {
                header("Location: admindashboard.php");
            } elseif (strtolower($role) === 'student') {
                header("Location: marks_report.php");
                header("Location: admindashboard.php");
            } elseif (strtolower($role) === 'DOS') {
                header("Location: admindashboard.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        } else {
            $message = "<p class='error'>Incorrect password.</p>";
        }
    } else {
        $message = "<p class='error'>User not found or role mismatch.</p>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px #ccc;
            width: 300px;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            font-weight: bold;
        }

        button:hover {
            background: #45a049;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="form">
        <h3><i><b>Login Here</b></i></h3>
        <?= $message ?>
        <form action="" method="post">
            <label>Username</label>
            <input type="text" name="names" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Role</label>
            <input type="text" name="role" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
<script>
window.onpageshow = function(event) {
    if (event.persisted) {
        window.location.reload();
    }
};
</script>
