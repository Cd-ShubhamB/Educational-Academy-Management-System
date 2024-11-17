<?php
session_start();
include 'db.php';  // Database connection

// Ensure the student is logged in
if ($_SESSION['role'] != 'student') {
    header('Location: login.php');
    exit();
}

$student_id = $_SESSION['user_id'];

// Fetch student test scores from the database
$query = "SELECT test_name, test_score, max_score, test_date 
          FROM test_scores 
          WHERE student_id = '$student_id'";
$result = mysqli_query($conn, $query);
?>

<!-- Include common navigation bar -->
    <?php include('navbar.php'); ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> My Test Scores</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<br>
<br>
<br>
<br>
<br>
    <h1>Your Test Scores</h1>
 
    <table border="1">
        <thead>
            <tr>
                <th>Test Name</th>
                <th>Test Score</th>
                <th>Max Score</th>
                <th>Test Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['test_name']; ?></td>
                    <td><?php echo $row['test_score']; ?></td>
                    <td><?php echo $row['max_score']; ?></td>
                    <td><?php echo $row['test_date']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>


