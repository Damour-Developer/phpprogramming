<?php
$con = mysqli_connect("localhost", "root", "", "gikonko_tsss");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT m.Module_Id, m.Module_Name, t.Trade_Name 
        FROM modules m 
        JOIN trades t ON m.Trade_Id = t.Trade_Id";

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Modules</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7fbff;
            display: flex;
            justify-content: center;
            padding-top: 40px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            max-width: 800px;
            background: white;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        caption {
            font-size: 24px;
            margin-bottom: 15px;
            font-weight: bold;
            color: #333;
        }

        th, td {
            padding: 12px 16px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f9ff;
        }

        tr:hover {
            background-color: #eef6ff;
        }
    </style>
</head>
<body>

<table>
    <caption>Modules List</caption>
    <thead>
        <tr>
            <th>Module ID</th>
            <th>Module Name</th>
            <th>Trade Name</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['Module_Id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Module_Name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Trade_Name']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3' style='text-align:center;'>No modules found.</td></tr>";
        }

        mysqli_close($con);
        ?>
    </tbody>
</table>

</body>
</html>
