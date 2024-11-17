<?php
session_start();
include 'db.php'; // Database connection

// Check if admin is logged in
if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Add Book
if (isset($_POST['add_book'])) {
    $book_name = $_POST['book_name'];
    $availability = $_POST['availability'];

    // Insert into books table
    $query = "INSERT INTO books (book_name, availability) VALUES ('$book_name', '$availability')";
    if (mysqli_query($conn, $query)) {
        echo "Book added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Remove Book
if (isset($_GET['remove_id'])) {
    $remove_id = $_GET['remove_id'];

    // Delete from books
    mysqli_query($conn, "DELETE FROM books WHERE id = '$remove_id'");

    echo "Book removed successfully!";
}

// Fetch existing books
$books = mysqli_query($conn, "SELECT * FROM books");
?>

<!-- Include common navigation bar -->
    <?php include('navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<br>
<br>
<br>
<br>
<br>
<br>
    <h1>Books Management</h1>

    <h2>Add Book</h2>
    <form action="books_management.php" method="POST">
        <label for="book_name">Book Name:</label>
        <input type="text" id="book_name" name="book_name" required><br>

        <label for="availability">Availability:</label>
        <select id="availability" name="availability" required>
            <option value="available">Available</option>
            <option value="unavailable">Unavailable</option>
        </select><br>

        <button type="submit" name="add_book">Add Book</button>
    </form>

    <h2>Existing Books</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Book Name</th>
                <th>Availability</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($books)) { ?>
                <tr>
                    <td><?php echo $row['book_name']; ?></td>
                    <td><?php echo $row['availability']; ?></td>
                    <td><a href="books_management.php?remove_id=<?php echo $row['id']; ?>">Remove</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
