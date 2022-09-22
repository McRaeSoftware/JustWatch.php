<!DOCTYPE html>
<html lang="en">
<?php
/*
Authors:Oliver Dickens
*/
include '../Controller/session.php';
include 'header.php';
?>
<head>
  <title>User Not Found 401 - JustWatch</title>
</head>
<body>
  <main>
    <div class="container">

      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1>401</h1>
        <h2> User doesn't exist.</h2>
        <a class="btn" href="login.php">Back to Login</a>
        <img src="Images/not-found.svg" class="img-fluid py-5" alt="Page Not Found">
      </section>

    </div>
  </main><!-- End #main -->
</body>
</html>
