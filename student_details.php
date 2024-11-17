

<?php
session_start();
include('db.php');
include('navbar.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="styles.css"> <!-- Ensure the correct path to the CSS file -->
</head>
<body>

<?php
// Check if user_id is set in the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch student details from the database
    $sql = "SELECT * FROM student_details WHERE id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful and rows were returned
    if ($result && mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);

        // Display student details in a tabular format
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<h1>Student Details</h1>";
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr><th>Field</th><th>Details</th></tr>"; // Header row
        echo "<tr><td>Name</td><td>" . htmlspecialchars($student['name']) . "</td></tr>";
        echo "<tr><td>Class</td><td>" . htmlspecialchars($student['standard']) . "</td></tr>";
        echo "<tr><td>School Name</td><td>" . htmlspecialchars($student['school_name']) . "</td></tr>";
        echo "<tr><td>Contact</td><td>" . htmlspecialchars($student['contact_details']) . "</td></tr>";
        echo "</table>";
    } else {
        echo "No student details found for the specified user ID.";
    }
} else {
    echo "User ID not found. Please log in.";
    exit();
}
?>




