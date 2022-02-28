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
  include '../Model/JustWatchMethods.php';

  session_start();
  $userid = $_SESSION['userid'];
  $existingUsername = $_SESSION['username'];
  AttemptUpdateUser($existingUsername, $userid);
}
?>
