<?php
/*
    Description: Action for the delete button located in the delete movies file.

    Author: David McRae
 */
session_start();
$movieid = $_GET['id'];
if(isset($movieid) && $_SESSION['username'])
{

  include '../Model/deleteMovie.php';
  DeleteMovieByID($movieid);
}
else
{
  header("Location: ../View/index.php?error=ACCESS DENIED");
}
?>
