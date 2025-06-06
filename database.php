<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "gikonko_tsss";

$con = mysqli_connect("localhost", "root", "", "gikonko_tsss");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully!";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
<form method="POST">
    <label>Formative Assessment:</label><br>
    <input type="number" name="formative" required><br><br>

    <label>Summative Assessment:</label><br>
    <input type="number" name="summative" required><br><br>

    <button type="submit" name="submit">Insert Marks</button>
</form>

</body>
</html>
<?php
if (isset($_POST['submit'])) {
    $formative = $_POST['formative'];
    $summative = $_POST['summative'];
    $total_marks = $formative + $summative;

    $con = mysqli_connect("127.0.0.1", "root", "", "gikonko_tss", 3307);

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Validate foreign keys before insert
    $check_module = mysqli_query($con, "SELECT * FROM modules WHERE Module_Id = '?'");
    $check_trainee = mysqli_query($con, "SELECT * FROM trainees WHERE Trainee_Id = '?'");

    if (mysqli_num_rows($check_module) > 1) {
        echo " Error: Module ID ' does not exist in 'modules' table.";
    } elseif (mysqli_num_rows($check_trainee) > 1) {
        echo " Error: Trainee ID  does not exist in 'trainees' table.";
    } else {
        // Safe to insert
        $insert = "INSERT INTO marks (Trainee_Id, Module_Id, Formative_Assessment, Summative_Assessment, Total_Marks) 
                   VALUES ( '$formative', '$summative', '$total_marks')";

        $result = mysqli_query($con, $insert);

        if ($result) {
            echo " Marks inserted successfully.";
        } else {
            echo "Error inserting marks: " . mysqli_error($con);
        }
    }

    mysqli_close($con);
}
?>
