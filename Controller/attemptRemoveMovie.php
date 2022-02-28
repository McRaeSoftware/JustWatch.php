<?php
/*
    Description: Action for the delete button located in the remove movies file.

    Author: David McRae
 */
session_start();
$movieid = $_GET['id'];
if(isset($movieid) && $_SESSION['username'])
{

  include '../Model/JustWatchMethods.php';
  RemoveMovieByID($movieid);
}
else
{
  header("Location: ../View/index.php?error=ACCESS DENIED");
}
?>
