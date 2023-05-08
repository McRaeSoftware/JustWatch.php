<?php
/*
    Description: Action for the update user page.

    Author: David McRae
*/
if(!isset($_POST["updateUserSubmit"]))
{
  header('Location: ../index.php?error=ACCESS DENIED');
}
else
{
  include 'UserController.php';

  session_start();
  UpdateUser($_SESSION['userid'], $_SESSION['username']);
}
?>
