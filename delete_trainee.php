<?php
$con = mysqli_connect("localhost", "root", "", "gikonko_tsss");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];

$delete_sql = "DELETE FROM trainees WHERE Trainee_Id='$id'";

if (mysqli_query($con, $delete_sql)) {
    echo "<script>alert('Trainee deleted successfully'); window.location.href='report.php';</script>";
} else {
    echo "Error deleting trainee: " . mysqli_error($con);
}

mysqli_close($con);
?>
