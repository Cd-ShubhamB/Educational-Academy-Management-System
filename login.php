<?php
session_start();
include('db.php'); // Include your database connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <script>
        function toggleFields() {
            const userType = document.getElementById("userType").value;
            const adminCodeField = document.getElementById("adminCode");
            const usernameField = document.getElementById("username");
            const passwordField = document.getElementById("password");

            if (userType === "admin") {
                adminCodeField.style.display = "block",adminCodeField.required; // Show admin code field
                studentCredentials.style.display = "none"
            } else {
                adminCodeField.style.display = "none"; // Hide admin code field
                studentCredentials.style.display = "block"
            }
        } 
        toggleFields();
    </script>
</head>
<body>
    <div class="login-container">
    <h2>Welcome to Shilpkar Tutorials</h2>
        <h1>Login</h1>

        <!-- Error message display -->
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="error-message" style="color:'red'; ">
            <?php 
            echo $_SESSION['error_message'];
            unset($_SESSION['error_message']); // Clear the error message after showing
            ?>
        </div>
    <?php endif; ?>

        <form action="authenticate.php" method="POST" >
            <label for="userType">Select User Type:</label>
            <select id="userType" name="userType" onchange="toggleFields()" required>
                <option value="" disabled selected>Select User Type</option>
                <option value="admin">Admin</option>
                <option value="student">Student</option>
            </select>

            <div id="adminCode" style="display: none;">
                <label for="admin_code">Admin Code:</label>
                <input type="text" id="admin_code" name="admin_code" >
            </div>

            <div id="studentCredentials" style="display: none;">
                <div id="usernameField">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" >
                </div>

                <div id="passwordField">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" >
                </div>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>