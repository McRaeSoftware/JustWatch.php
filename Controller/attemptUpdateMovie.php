<?php
/*
    Description: Update existing movie details

    Author: David McRae
 */

if(!isset($_POST['updateMovieSubmit']))
{
  header('Location: ../View/index.php?error=ACCESS DENIED');
}
else
{
  include '../Model/updateMovie.php';

  session_start();

  AttemptUpdateMovie();
}
?>
