<?php
session_start();
include 'db.php'; // Database connection

// Ensure the student is logged in
if ($_SESSION['role'] != 'student') {
    header('Location: login.php');
    exit();
}

// Fetch resources from the database
$resources = mysqli_query($conn, "SELECT * FROM resources");
?>

<!-- Include common navigation bar -->
    <?php include('navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Resources</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<br>
<br>
<br>
<br>
<br>
    <h1>Available Resources</h1>

    <table border="1">
        <thead>
            <tr>
                <th>File Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resources)) { ?>
                <tr>
                    <td><?php echo $row['file_name']; ?></td>
                    <td><a href="<?php echo $row['file_path']; ?>" download>Download</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
