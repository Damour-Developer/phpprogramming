<?php
$con = mysqli_connect("localhost", "root", "", "gikonko_tsss");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trade_name = $_POST['trade_name'];

    if (!empty($trade_name)) {
        $sql = "INSERT INTO trades (Trade_Name) VALUES (?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $trade_name);

        if (mysqli_stmt_execute($stmt)) {
            $message = "<p class='success'>✅ Trade '$trade_name' added successfully!</p>";
        } else {
            $message = "<p class='error'>❌ Insert failed: " . mysqli_error($con) . "</p>";
        }

        mysqli_stmt_close($stmt);
    } else {
        $message = "<p class='error'>❗ Please select a trade.</p>";
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Trade</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef6ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            margin-top: 25px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .success {
            color: green;
            text-align: center;
        }

        .error {
            color: red;
            text-align: center;
        }
        .photo{
      width: 50px;
      height:50px;
      border-radius: 100%;
      margin-left: -400px;
      margin-top: -500px;

    }
    </style>
</head>
<body>
<a href="admindashboard.php"><img src="gikonko.png" alt=""class="photo" ></a>
<div class="form-container">
    <h2>Add a Trade</h2>
    <?= $message ?>
    <form method="POST" action="">
        <label for="trade_name">Select Trade</label>
        <select name="trade_name" id="trade_name" required>
            <option value="">-- Choose Trade --</option>
            <option value="Multimedia">ICT and Multimedia</option>
            <option value="Building Construction">Building Construction</option>
            <option value="Electrical Technology">Electrical Technology</option>
            <option value="Accounting">Accounting</option>
        </select>

        <input type="submit" value="Add Trade">
    </form>
</div>

</body>
</html>
