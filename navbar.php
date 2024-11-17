<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<html>
<head>
<link rel="stylesheet" href="styles.css">

</head>
<body>
<nav>
<!-- Logo Section -->
        <div class="logo">
            <a href="about_us.php">
                <img src="images/logo.png" alt="Logo" >
            </a>
        
        </div>
    <ul>

        
       
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'student'): ?>
            <!-- Links for student -->
            <li><a href="student_home.php"> Home </a></li>
            <li><a href="student_details.php">Student Details </a></li>
            <li><a href="test_scores.php">Test Scores </a></li>
            <li><a href="books.php">Books </a></li>
            <li><a href="resources.php">Resources </a></li>

        <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <!-- Links for admin -->
            <li><a href="admin_home.php">Home</a></li>
            <li><a href="student_management.php">Student Management</a></li>
            <li><a href="scores_management.php">Scores Management</a></li>
            <li><a href="books_management.php">Books Management</a></li>
            <li><a href="resources_management.php">Resources Management</a></li>

        <?php endif; ?>

        <!-- Common links for all users -->
        <li><a href="about_us.php">About Us</a></li>

        <!-- Logout link for all users -->
        <li><a href="logout.php" >Logout</a></li>
    </ul>

     <div class="nav-toggle">&#9776;</div>
</nav>
 <script>
    document.querySelector('.nav-toggle').addEventListener('click', function() {
    document.querySelector('nav').classList.toggle('nav-open');
});
</script>
</body>
</html>