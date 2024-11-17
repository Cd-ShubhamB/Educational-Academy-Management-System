
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}
?>

    <!-- navigation bar -->
    <?php include('navbar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>

<br>
<br>
<br>
<br>
<br>
    <h1>Welcome, Admin!</h1>
    <h2 style="text-align:center;">This is your admin homepage<h2>

</body>
</html>
