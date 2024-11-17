<?php
session_start();
include 'db.php'; // Database connection

// Check if admin is logged in
if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}


?>
<!-- Include common navigation bar -->
    <?php include('navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scores Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<br>
<br>
<br>
<br>
<br>
<?php
// Add Test
if (isset($_POST['add_test'])) {
    $student_id = $_POST['student_id'];
    $test_name = $_POST['test_name'];
    $test_score = $_POST['test_score'];
    $max_score = $_POST['max_score'];
    $test_date = $_POST['test_date'];

    // Insert into test_scores table
    $query = "INSERT INTO test_scores (student_id, test_name, test_score, max_score, test_date) 
              VALUES ('$student_id', '$test_name', '$test_score', '$max_score', '$test_date')";
    if (mysqli_query($conn, $query)) {
        echo "Test added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Remove Test
if (isset($_GET['remove_id'])) {
    $remove_id = $_GET['remove_id'];

    // Delete from test_scores
    mysqli_query($conn, "DELETE FROM test_scores WHERE id = '$remove_id'");

    echo "Test removed successfully!";
}

// Fetch existing tests
$tests = mysqli_query($conn, "SELECT test_scores.id, test_scores.test_name, test_scores.test_score, 
                                    test_scores.max_score, test_scores.test_date, 
                                    student_details.name AS student_name 
                                FROM test_scores 
                                JOIN users ON test_scores.student_id = users.id 
                                JOIN student_details ON users.id = student_details.student_id");
                                ?>

    <h1>Scores Management</h1>

    <h2>Add Test</h2>
    <form action="scores_management.php" method="POST">
        <label for="student_id">Student:</label>
        <select id="student_id" name="student_id" required>
            <?php
            // Fetch students for the dropdown
            $students = mysqli_query($conn, "SELECT id, username FROM users WHERE role = 'student'");
            while ($student = mysqli_fetch_assoc($students)) {
                echo "<option value='{$student['id']}'>{$student['username']}</option>";
            }
            ?>
        </select>

        <label for="test_name">Test Name:</label>
        <input type="text" id="test_name" name="test_name" required><br>

        <label for="test_score">Test Score:</label>
        <input type="number" id="test_score" name="test_score" required><br>

        <label for="max_score">Max Score:</label>
        <input type="number" id="max_score" name="max_score" required><br>

        <label for="test_date">Test Date:</label>
        <input type="date" id="test_date" name="test_date" required><br>

        <button type="submit" name="add_test">Add Test</button>
    </form>

    <h2>Existing Tests</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Test Name</th>
                <th>Test Score</th>
                <th>Max Score</th>
                <th>Test Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($tests)) { ?>
                <tr>
                    <td><?php echo $row['student_name']; ?></td>
                    <td><?php echo $row['test_name']; ?></td>
                    <td><?php echo $row['test_score']; ?></td>
                    <td><?php echo $row['max_score']; ?></td>
                    <td><?php echo $row['test_date']; ?></td>
                    <td><a href="scores_management.php?remove_id=<?php echo $row['id']; ?>">Remove</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>


