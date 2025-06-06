<?php
$con = new mysqli("localhost", "root", "", "gikonko_tsss");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Fixed SQL (renaming "mod" alias)
$sql = "SELECT 
            m.Mark_Id,
            m.Trainee_Id,
            m.Module_Id,
            modules.Module_Name,
            m.Formative_Assessment,
            m.Summative_Assessment,
            m.Total_Marks,
            CASE 
                WHEN m.Total_Marks >= 70 THEN 'Competent'
                ELSE 'Not Yet Competent'
            END AS Classification
        FROM Marks m
        JOIN Trainees t ON m.Trainee_Id = t.Trainee_Id
        JOIN Modules modules ON m.Module_Id = modules.Module_Id
        ORDER BY m.Mark_Id DESC";

$result = $con->query($sql);

if (!$result) {
    die("Query failed: " . $con->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Marks Report</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f8f8; padding: 30px; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0px 0px 10px #ccc; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #4CAF50; color: white; }
        .competent { color: green; font-weight: bold; }
        .nyc { color: red; font-weight: bold; }
        h2 { color: #333; }
    </style>
</head>
<body>

<h2>Marks Report</h2>

<table>
    <thead>
        <tr>
            <th>Mark ID</th>
            <th>Trainee ID</th>
           
            <th>Module ID</th>
            
            <th>Formative (/50)</th>
            <th>Summative (/50)</th>
            <th>Total Marks (/100)</th>
            <th>Classification</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['Mark_Id'] ?></td>
                    <td><?= $row['Trainee_Id'] ?></td>
                    <td><?= $row['Module_Id'] ?></td>
                   
                    <td><?= $row['Formative_Assessment'] ?></td>
                    <td><?= $row['Summative_Assessment'] ?></td>
                    <td><?= $row['Total_Marks'] ?></td>
                    <td class="<?= $row['Classification'] === 'Competent' ? 'competent' : 'nyc' ?>">
                        <?= $row['Classification'] ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="9">No marks available.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
