<?php

//db connection
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'W01210609';
$DATABASE_PASS = 'Matthewcs!';
$DATABASE_NAME = 'W01210609';

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno() ) {

// If there is an error with the connection, stop the script and display the error.
    die ('Failed to connect to database!');
}

// Template header
function template_header($title) {
    echo <<<EOT
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>$title</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/graph.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="js/main.js"></script>
</head>

<body>

EOT;
}

// Template navbar
function template_nav() {
    echo <<<EOT

<nav class="navbar is-light" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="index.php">
      <img src="img/BR-icon.png" alt="">
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">

    <div class="navbar-start">
     <a class="navbar-item" href="index.php">
        Home
      </a>
      <a class="navbar-item" href="about.php">
        About us
      </a>
    </div>
    
     <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a href="register.php"class="button is-primary">
            Register
          </a>
          <a href="login.php" class="button is-success">
            Login
          </a>
        </div>
      </div>
    </div>
    
  </div>
</nav>

EOT;
}

// Template footer
function template_footer() {
    echo <<<EOT
<footer class="footer">
  <div class="columns is-centered is-vcentered">
    <div class="column is-one-third has-text-centered">
        <img src="img/BR_small-icon.png" alt="">
    </div>
    <div class="column is-one-third has-text-centered">
      <a href="index.php">Home</a> |
      <a href="about.php">About Us</a> |
      <a href="login.php">Login</a> |
      <a href="register.php">Register</a>
      <br><p>&#169;&nbsp;2020 BudgetRite</p>
      <p><a href="#">Privacy Policy</a> and <a href="#">Terms of Use</a></p>
    </div>
    <div class="column social-media is-one-third has-text-centered">
      <div class="columns is-vcentered is-centered is-mobile">
        <div class="column is-narrow has-text-centered">
          <a href="#">
              <i class="fab fa-facebook fa-3x socialIcons"></i>
          </a>
        </div>
        <div class="column is-narrow has-text-centered">
          <a href="#">
              <i class="fab fa-twitter fa-3x socialIcons"></i>
          </a>
        </div>
        <div class="column is-narrow has-text-centered">
        <a href="#">
        <i class="fab fa-linkedin fa-3x socialIcons"></i>
        </a>
        </div>
      </div>
    </div>
  </div>
</footer>
    </body>
</html>
EOT;
}
