<?php
//Logout User
function AttemptLogOut()
{
  session_start(); // Start Session / Resume Current Session
  session_destroy(); // Destroy Session
  header("Location: ../index.php"); // Redirect to index page
}
?>
