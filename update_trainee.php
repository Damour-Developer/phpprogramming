<?php
$con = mysqli_connect("localhost", "root", "", "gikonko_tsss");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get selected trainee for editing
$selected_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$trainee = null;

if ($selected_id) {
    $result = mysqli_query($con, "SELECT * FROM trainees WHERE Trainee_Id = $selected_id");
    if ($result && mysqli_num_rows($result) > 0) {
        $trainee = mysqli_fetch_assoc($result);
    }
}

// Handle Update Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trainee_id = intval($_POST['Trainee_Id']);
    $first_name = mysqli_real_escape_string($con, $_POST['FirstNames']);
    $last_name = mysqli_real_escape_string($con, $_POST['LastName']);
    $gender = mysqli_real_escape_string($con, $_POST['Gender']);
    $trade_id = intval($_POST['Trade_Id']);

    $update_query = "UPDATE trainees SET FirstNames='$first_name', LastName='$last_name', Gender='$gender', Trade_Id=$trade_id WHERE Trainee_Id=$trainee_id";

    if (mysqli_query($con, $update_query)) {
        header("Location: report.php"); // Redirect to list
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Trainee</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; padding: 30px; }
        form { max-width: 400px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 8px rgba(0, 0, 0, 0.1); }
        label { font-weight: bold; display: block; margin-top: 10px; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; }
        .btn { padding: 8px 16px; font-size: 16px; border: none; cursor: pointer; margin-top: 15px; width: 100%; }
        .btn-update { background-color: #0275d8; color: white; }
        .btn-update:hover { background-color: #025aa5; }
    </style>
</head>
<body>

<h2>Update Trainee</h2>

<!-- Trainee Selection -->
<form method="get" style="margin-bottom: 20px;">
    <label>Select Trainee to Edit:</label>
    <select name="id" onchange="this.form.submit()" required>
        <option value="">-- Select Trainee --</option>
        <?php
        $res = mysqli_query($con, "SELECT Trainee_Id, FirstNames, LastName FROM trainees");
        while ($row = mysqli_fetch_assoc($res)) {
            $selected = ($row['Trainee_Id'] == $selected_id) ? 'selected' : '';
            echo "<option value='{$row['Trainee_Id']}' $selected>{$row['Trainee_Id']} - {$row['FirstNames']} {$row['LastName']}</option>";
        }
        ?>
    </select>
</form>

<!-- Update Form -->
<?php if ($trainee): ?>
<form method="post">
    <input type="hidden" name="Trainee_Id" value="<?= $trainee['Trainee_Id'] ?>">

    <label>First Name:</label>
    <input type="text" name="FirstNames" value="<?= htmlspecialchars($trainee['FirstNames']) ?>" required>

    <label>Last Name:</label>
    <input type="text" name="LastName" value="<?= htmlspecialchars($trainee['LastName']) ?>" required>

    <label>Gender:</label>
    <select name="Gender" required>
        <option value="Male" <?= $trainee['Gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= $trainee['Gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
    </select>

    <label>Trade ID:</label>
    <input type="number" name="Trade_Id" value="<?= htmlspecialchars($trainee['Trade_Id']) ?>" required>

    <button type="submit" class="btn btn-update">Update Trainee</button>
</form>
<?php elseif ($selected_id): ?>
<p style="color: red;">Trainee not found.</p>
<?php endif; ?>

</body>
</html>

<?php mysqli_close($con); ?>
