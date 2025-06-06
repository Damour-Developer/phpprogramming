<?php
$con = mysqli_connect("localhost", "root", "", "gikonko_tsss");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

// Fetch trade options
$trades = [];
$trade_result = mysqli_query($con, "SELECT Trade_Id, Trade_Name FROM trades");
if ($trade_result) {
    while ($row = mysqli_fetch_assoc($trade_result)) {
        $trades[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $module_name = trim($_POST['module_name']);
    $trade_id = $_POST['trade_id'];

    if (!empty($module_name) && !empty($trade_id)) {
        $sql = "INSERT INTO modules (Module_Name, Trade_Id) VALUES (?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "si", $module_name, $trade_id);

        if (mysqli_stmt_execute($stmt)) {
            $message = "<p class='success'>✅ Module inserted successfully!</p>";
        } else {
            $message = "<p class='error'>❌ Insert failed: " . mysqli_error($con) . "</p>";
        }

        mysqli_stmt_close($stmt);
    } else {
        $message = "<p class='error'>❗ All fields are required.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Module</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4faff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        input[type="text"], select {
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
        
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add Module</h2>
    <?= $message ?>
    <form method="POST" action="">
        <label for="module_name">Module Name</label>
        <input type="text" name="module_name" id="module_name" required>

        <label for="trade_id">Select Trade</label>
        <select name="trade_id" id="trade_id" required>
            <option value="">-- Choose Trade --</option>
            <?php foreach ($trades as $trade): ?>
                <option value="<?= $trade['Trade_Id'] ?>"><?= htmlspecialchars($trade['Trade_Name']) ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Add Module">
    </form>
</div>

</body>
</html>
