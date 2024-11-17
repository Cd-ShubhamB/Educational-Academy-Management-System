<?php
session_start();
include('db.php'); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userType = $_POST['userType'];

    if ($userType === 'admin') {
        $adminCode = $_POST['admin_code'];

        // Validate the admin code
        if ($adminCode === 'admin123') { 
            $_SESSION['user_id'] = 'admin';
            $_SESSION['role'] = 'admin';
            header('Location: admin_home.php'); // Redirect to admin home page
            exit();
        } else {
           // Invalid admin code, set an error message
            $_SESSION['error_message'] = "Invalid Admin Code.";
            header('Location: login.php'); // Redirect back to login page
            exit();
        }
    } elseif ($userType === 'student') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Validate student credentials
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='student'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result); 
            $_SESSION['user_id'] = $row['id']; 
            $_SESSION['role'] = 'student';
            $_SESSION['username'] = $username; 
            header('Location: student_home.php'); // Redirect to student home page
            exit();
        } else {
            // Invalid student credentials, set an error message
            $_SESSION['error_message'] = "Invalid Username or Password.";
            header('Location: login.php'); // Redirect back to login page
            exit();
        }
    }
}
?>
