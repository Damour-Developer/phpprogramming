<?php
// Connect to DB
$con = mysqli_connect("localhost", "root", "", "gikonko_tsss");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch trades for dropdown
$trades = mysqli_query($con, "SELECT Trade_Id, Trade_Name FROM trades");

// Handle form submission
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstNames = trim($_POST['firstnames']);
    $lastName = trim($_POST['lastname']);
    $gender = $_POST['gender'];
    $tradeId = $_POST['trade_id'];

    // Basic validation
    if ($firstNames && $lastName && $gender && $tradeId) {
        // Check if Trade_Id exists to avoid foreign key error
        $checkTrade = mysqli_query($con, "SELECT * FROM trades WHERE Trade_Id = '$tradeId'");
        if (mysqli_num_rows($checkTrade) > 0) {
            $sql = "INSERT INTO trainees (FirstNames, LastName, Gender, Trade_Id) 
                    VALUES ('$firstNames', '$lastName', '$gender', '$tradeId')";

            if (mysqli_query($con, $sql)) {
              echo  $message = "<p style='color: green; text-align:center;'> Trainee inserted successfully!</p>";
            } else {
                $message = "<p style='color: red; text-align:center;'> Insert failed: " . mysqli_error($con) . "</p>";
            }
        } else {
            $message = "<p style='color: red; text-align:center;'> Selected trade does not exist.</p>";
        }
    } else {
        $message = "<p style='color: red; text-align:center;'>❗ All fields are required.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert New Trainee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 40px;
        }

        form {
            width: 40%;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            margin-top: 20px;
            width: 100%;
            border: none;
            border-radius: 5px;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
        }
         .photo{
      width: 50px;
      height:50px;
      border-radius: 100%;
    }
    </style>
</head>
<body>


<form method="POST" action="admindashboard.php">
    
    <h2>Register New Trainee</h2>

    <div class="message"><?php= $message ?></div>

    <label for="firstnames">First Name</label>
    <input type="text" name="firstnames" required>

    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" required>

    <label for="gender">Gender</label>
    <select name="gender" required>
        <option value="">-- Select Gender --</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>

    <label for="trade_id">Trade</label>
    <select name="trade_id" required>
        <option value="">-- Select Trade --</option>
        <option value="">ICT AND MULT MEDID</option>
        <option value="">-ELECTRICAL TECHNOLGY</option>
        <option value="">UILDING CONSTRUCTION</option>
        <option value="">Accoynting</option>
        <?php while ($trade = mysqli_fetch_assoc($trades)): ?>
            <option value="<?= $trade['Trade_Id'] ?>"><?= htmlspecialchars($trade['Trade_Name']) ?></option>
        <?php endwhile; ?>
    </select>

    <input type="submit" value="Insert Trainee">
</form>

</body>
</html>

<?php mysqli_close($con); ?>
