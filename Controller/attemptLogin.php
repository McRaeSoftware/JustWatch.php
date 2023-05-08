<?php
/*
    Description: Action for the login page.

    Author: David McRae
 */
session_start();

if(!isset($_POST["LoginSubmit"]))
{
  header('Location: ../View/index.php?msg=ACCESS DENIED');
}
else
{
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

  include 'UserController.php';
  $response = Login($username, $password);

  if (!$response->success)
  {
    header('location: ../View/login.php?msg='.$response->message);
  }
  else
  {
    header('location: ../View/movies.php?msg='.$response->message);
  }
}
?>
