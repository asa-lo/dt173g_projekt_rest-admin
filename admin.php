<?php

include("config/config.php");

//Control if user is logged in with the error message

if (!isset($_SESSION["username"])) {
    header("Location: index.php?message=You need to be logged in!");
}

?>

<!-- Start of Content / HTML -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Åsa Lodesjö │ Logged in</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Mukta+Mahee:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cardo:wght@700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/favicon.png">
</head>

<body>

    <!-- Header-Section -->
    <header>
        <a class="logout-btn" href="logout.php">― &nbsp; Log out</a>
        <a class="homepage-btn" href="http://studenter.miun.se/~aslo1900/dt173g_projekt_client/" target="_blank">― &nbsp; Homepage</a>
    </header>

    <!-- Contatiner-Section -->
    <div class="container">

        <!-- CV-Section -->
        <section id="CV">
            <h2>CV</h2>
            <p>Workplace</p>
            <p>Title</p>
            <p>Date</p>
            <p>Delete</p>
            <p>Update</p>

            <!-- Print from DB -->
            <div id="printCV"></div>

            <!-- CV-Form -->
            <form id="CVForm">
                <h3>Add to CV:</h3>

                <input type="text" name="id" id="CVId"><br>
                <label for="CVName">Workplace</label><br>
                <input type="text" name="CVName" id="CVName"><br>
                <label for="CVTitle">Title:</label><br>
                <input type="text" name="CVTitle" id="CVTitle"><br>
                <label for="CVDate">Date:</label><br>
                <input type="text" name="CVDate" id="CVDate"><br>
                <input type="submit" value="Add" id="addCV">
            </form>
        </section>

        <!-- Portfolio-Section -->
        <section id="portfolio">

            <h2>Portfolio</h2>
            <p>Title</p>
            <p>Website</p>
            <p>Description</p>
            <p>Delete</p>
            <p>Update</p>

            <!-- Print from DB -->
            <div id="printPortfolio"></div>

            <!-- Portfolio-Form -->
            <form id="portfolioForm">
                <h3>Add to Portfolio:</h3>

                <input type="text" name="id" id="portfolioId"><br>
                <label for="title">Title:</label><br>
                <input type="text" name="title" id="title"><br>
                <label for="url">Website:</label><br>
                <input type="text" name="url" id="url"><br>
                <label for="description">Description:</label><br>
                <input type="text" name="description" id="description"><br>
                <input type="submit" value="Add" id="addPortfolio">
            </form>
        </section>

        <!-- Courses-Section -->
        <section id="courses">

            <h2>Courses</h2>
            <p>School</p>
            <p>Coursename</p>
            <p>Date</p>
            <p>Delete</p>
            <p>Update</p>

            <!-- Print from DB -->
            <div id="printCourses"></div>

            <!-- Courses-Form -->
            <form id="coursesForm">
                <h3>Add to Courses:</h3>

                <input type="text" name="id" id="coursesId"><br>
                <label for="school">School:</label><br>
                <input type="text" name="school" id="school"><br>
                <label for="courseName">Coursename:</label><br>
                <input type="text" name="courseName" id="courseName"><br>
                <label for="date">Date:</label><br>
                <input type="text" name="date" id="date"><br>
                <input type="submit" value="Add" id="addCourses">
            </form>
        </section>
    </div>

    <!-- JS -->
    <script src="js/portfolio.js"></script>
    <script src="js/courses.js"></script>
    <script src="js/CV.js"></script>

</body>

</html>

<!-- End of Content / HTML -->