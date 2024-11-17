<?php
// Start the session (if needed)
session_start();
?>

<!-- Include common navigation bar -->
    <?php include('navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- Link to CSS styles -->
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Styles for the About Us page */
        body {
            font-family: Arial, sans-serif;
            margin-top: 0px;
            padding: 0;
            background-color: #f4f4f9;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            text-align: center;
        }

        .container img {
            width: 70%;
            max-width: 300px;
            height: auto;
            border-radius: 50%;
            margin-top:100px;
        }

        .description {
            margin-top: 20px;
            font-size: 18px;
            line-height: 1.6;
            color: #333;
            text-align: justify;
            padding: 10px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            margin-top: 20px;
            padding: 10px;
            background-color: #004080;
            color: white;
            text-align: center;
            margin-bottom:0px;
        }
    </style>
</head>
<body>


    <!-- Main Content: About Us Section -->
    <div class="container">
        <img src="images/logo.png" alt="Academy logo" style="box-shadow: 0 2px 10px rgba(0, 0, 0, 1);">  
        <div class="description">
            <h2>About Our Academy</h2>
            <p>
                Welcome to the <b style="display:inline;">Shilpkar Tutorials</b>! We are a modern educational institute 
                committed to providing quality education and fostering academic excellence since 2022.
                Our academy offers a wide range of courses tailored to equip students with the knowledge and 
                skills needed to succeed in today’s competitive world.
            </p>
            <p>
                Our mission is to create an engaging and supportive environment that promotes learning, 
                encourages critical thinking, and helps students realize their full potential. With a team of 
                experienced educators, advanced infrastructure, and innovative teaching methodologies, 
                we are dedicated to shaping the leaders of tomorrow.
            </p>
            <em>
            @contact us on  | <a href="mailto:shilpkartutorials@gmail.com"> Mail </a> | <a href="https://youtube.com/@shilpkartutorials?si=GfcaSxx9CmkB0a6P"> Youtube</a> 
            </em>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        © 2024 Shilpkar Tutorials. All Rights Reserved.
    </footer>

</body>
</html>
