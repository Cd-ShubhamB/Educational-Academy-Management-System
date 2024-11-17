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
    <title>Student Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<br>
<br>
<br>
<br>
<br>
<?php
// Add Student
if (isset($_POST['add_student'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $standard = $_POST['standard'];
    $school_name = $_POST['school_name'];
    $contact = $_POST['contact_details'];

    // Insert into users table
    $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'student')";
    if (mysqli_query($conn, $query)) {
        $student_id = mysqli_insert_id($conn);

        // Insert into student_details table
        $query = "INSERT INTO student_details (student_id, name, standard, school_name, contact_details) 
                  VALUES ('$student_id', '$name', '$standard', '$school_name', '$contact')";
        mysqli_query($conn, $query);
        echo "Student added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Remove Student
if (isset($_GET['remove_id'])) {
    $remove_id = $_GET['remove_id'];

    // Delete from student_details and users
    mysqli_query($conn, "DELETE FROM student_details WHERE student_id = '$remove_id'");
    mysqli_query($conn, "DELETE FROM users WHERE id = '$remove_id'");

    echo "Student removed successfully!";
}

// Fetch existing students
$students = mysqli_query($conn, "SELECT users.id, student_details.name, student_details.standard, student_details.school_name 
                                 FROM users JOIN student_details ON users.id = student_details.student_id 
                                 WHERE users.role = 'student'");
                                 ?>

    <h1>Student Management</h1>

    <h2>Add Student</h2>
    <form action="student_management.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="name">Student Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="standard">Standard:</label>
        <input type="text" id="standard" name="standard" required><br>

        <label for="school_name">School Name:</label>
        <input type="text" id="school_name" name="school_name" required><br>

        <label for="contact_details">Contact Details:</label>
        <input type="text" id="contact_details" name="contact_details" required><br>

        <button type="submit" name="add_student">Add Student</button>
    </form>

    <h2>Remove Student</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Standard</th>
                <th>School Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($students)) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['standard']; ?></td>
                    <td><?php echo $row['school_name']; ?></td>
                    <td><a href="student_management.php?remove_id=<?php echo $row['id']; ?>">Remove</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
