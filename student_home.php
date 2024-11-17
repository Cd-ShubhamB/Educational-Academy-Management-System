<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
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
    <title>Student Home</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>

  
<br>
<br>
<br>
<br>
<br>
 <h1 style="text-align:center; color:black">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <h2 style="text-align:center; color:black">This is your homepage.</h2>
    <h3  style="text-align:center; color:black">Explore various services provided by <b style="color:#003366;display:inline;">Shilpkar Tutorials</b> using above navigation panel..👆 </h3>

</body>
</html>
