<?php
/*
    Description: Action for the login page.

    Author: David McRae
 */
session_start();

if(!isset($_POST["LoginSubmit"]))
{
  header('Location: ../View/index.php?error=ACCESS DENIED');
}
else
{
  include '../Model/login.php';
  AttemptLogIn();
}
?>
