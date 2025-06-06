<?php

// Connect to DB
$con = new mysqli("localhost", "root", "", "gikonko_tsss");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$message = "";

// Get Trainee ID from session user

$getTrainee = $con->prepare("SELECT Trainee_Id FROM Trainees ");
if (!$getTrainee) {
    die("Prepare failed: " . $con->error);
}

$getTrainee->execute();
$getTrainee->bind_result($trainee_id);
if (!$getTrainee->fetch()) {
    die("Trainee not found.");
}
$getTrainee->close();

// Automatically assign a module (example: first one in table)
$moduleQuery = $con->query("SELECT Module_Id FROM Modules LIMIT 1");
if ($moduleQuery->num_rows === 0) {
    die("No module found.");
}
$moduleRow = $moduleQuery->fetch_assoc();
$module_id = $moduleRow['Module_Id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formative = intval($_POST['formative']);
    $summative = intval($_POST['summative']);

    if ($formative < 0 || $formative > 50 || $summative < 0 || $summative > 50) {
        $message = "<p style='color:red;'>Marks must be between 0 and 50.</p>";
    } else {
        $total = $formative + $summative;
        $stmt = $con->prepare("INSERT INTO Marks (Trainee_Id, Module_Id, Formative_Assessment, Summative_Assessment, Total_Marks) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiii", $trainee_id, $module_id, $formative, $summative, $total);

        if ($stmt->execute()) {
            $message = "<p style='color:green;'>Marks inserted successfully!</p>";
        } else {
            $message = "<p style='color:red;'>Error inserting marks: " . htmlspecialchars($stmt->error) . "</p>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Enter Marks</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f9f9f9;
        padding: 30px;
    }
    form {
        background: white;
        padding: 25px;
        max-width: 450px;
        margin: auto;
        border-radius: 8px;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
    }
    label {
        display: block;
        margin-top: 15px;
        font-weight: bold;
    }
    input[type=number] {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }
    button {
        margin-top: 20px;
        padding: 12px;
        background: #007BFF;
        color: white;
        border: none;
        width: 100%;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
    }
    button:hover {
        background: #0056b3;
    }
</style>
</head>
<body>

<h2 style="text-align:center;">Enter Marks</h2>
<?= $message ?>

<form method="post" action="">
    <label for="formative">Formative Assessment (0-50):</label>
    <input type="number" name="formative" id="formative" min="0" max="50" required>

    <label for="summative">Summative Assessment (0-50):</label>
    <input type="number" name="summative" id="summative" min="0" max="50" required>

    <button type="submit">Submit Marks</button>
</form>

</body>
</html>
