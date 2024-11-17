<?php
session_start();
include 'db.php'; // Database connection

// Check if admin is logged in
if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Handle file upload
if (isset($_POST['upload'])) {
    $file_name = $_FILES['resource_file']['name'];
    $file_tmp = $_FILES['resource_file']['tmp_name'];
    $upload_dir = 'uploads/'; // Directory to save uploaded files
    $file_path = $upload_dir . basename($file_name);

    // Move the uploaded file to the server
    if (move_uploaded_file($file_tmp, $file_path)) {
        // Insert file information into the database
        $query = "INSERT INTO resources (file_name, file_path) VALUES ('$file_name', '$file_path')";
        if (mysqli_query($conn, $query)) {
            echo "Resource uploaded successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Failed to upload file.";
    }
}

// Remove Resource
if (isset($_GET['remove_id'])) {
    $remove_id = $_GET['remove_id'];

    // Fetch the file path before deleting
    $result = mysqli_query($conn, "SELECT file_path FROM resources WHERE id = '$remove_id'");
    $file_data = mysqli_fetch_assoc($result);
    $file_path = $file_data['file_path'];

    // Delete from resources
    mysqli_query($conn, "DELETE FROM resources WHERE id = '$remove_id'");

    // Remove the file from the server
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    echo "Resource removed successfully!";
}

// Fetch existing resources
$resources = mysqli_query($conn, "SELECT * FROM resources");
?>

<!-- Include common navigation bar -->
    <?php include('navbar.php'); ?>
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<br>
<br>
<br>
<br>
<br>
<br>
    <h1>Resources Management</h1>

    <h2>Upload Resource</h2>
    <form action="resources_management.php" method="POST" enctype="multipart/form-data">
        <label for="resource_file">Select file:</label>
        <input type="file" id="resource_file" name="resource_file" accept=".pdf,.doc,.docx" required><br>

        <button type="submit" name="upload">Upload Resource</button>
    </form>

    <h2>Existing Resources</h2>
    <table border="1">
        <thead>
            <tr>
                <th>File Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resources)) { ?>
                <tr>
                    <td><?php echo $row['file_name']; ?></td>
                    <td>
                        <a href="<?php echo $row['file_path']; ?>" download>Download</a>
                        <a href="resources_management.php?remove_id=<?php echo $row['id']; ?>">Remove</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
