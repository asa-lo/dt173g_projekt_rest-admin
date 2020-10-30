<?php

include("config/config.php");

$login = new Login();

//Login 

if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($login->loginUser($username, $password)) {
        header("Location: admin.php");
    } else {
        $message = "<p class='error'>Wrong username / password - try again!</p>";
    }
}

//Error message

if (isset($_GET["message"])) {
    echo "<p class='error'>" . $_GET["message"] . "</p>";
}

if (isset($message)) {
    echo "<p class='error'>" . $message . "</p>";
}

?>


<!-- Start of Content / HTML -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Åsa Lodesjö │ Log in</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Mukta+Mahee:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cardo:wght@700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/favicon.png">
</head>

<body>
    <!-- Index-Container -->
    <div class="index-container">

        <!-- Login-Section -->
        <section class="log-in">
        <h1>Login</h1>

            <!-- Login-Form -->
            <form method="post" action="index.php">
                <label for="username">Username:</label><br>
                <input type="text" name="username" id="username" required><br>
                <label for="password">Password:</label><br>
                <input type="password" name="password" id="password" required><br>
                <input type="submit" value="Log in" class="btn">
            </form>
        </section>
    </div>
</body>

</html>

<!-- End of Content / HTML -->