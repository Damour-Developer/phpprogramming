<!DOCTYPE html>
<html>
<head>
    <title>Show Trainees</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin: 50px auto;
            font-size: 16px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        caption {
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 20px;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-update {
            background-color: #0275d8;
            color: white;
        }

        .btn-update:hover {
            background-color: #025aa5;
        }

        .btn-delete {
            background-color: #d9534f;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>

<table>
    <caption>Trainee Information</caption>
    <thead>
        <tr>
            <th>Trainee ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Trade ID</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

<?php
$con = mysqli_connect("localhost", "root", "", "gikonko_tsss");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM trainees";
$result = mysqli_query($con, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Trainee_Id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['FirstNames']) . "</td>";
            echo "<td>" . htmlspecialchars($row['LastName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Gender']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Trade_Id']) . "</td>";
            echo "<td>";
            echo "<a class='btn btn-update' href='update_trainee.php?id=" . $row['Trainee_Id'] . "'>Update</a> ";
            echo "<a class='btn btn-delete' href='delete_trainee.php?id=" . $row['Trainee_Id'] . "' onclick=\"return confirm('Are you sure you want to delete this trainee?');\">Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No trainees found</td></tr>";
    }
} else {
    echo "<tr><td colspan='6'>Query failed: " . mysqli_error($con) . "</td></tr>";
}

mysqli_close($con);
?>

    </tbody>
</table>

</body>
</html>
